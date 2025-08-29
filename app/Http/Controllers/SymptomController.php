<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SymptomController extends Controller
{
    // Şikayet seçim ekranı
    public function index()
    {
        $symptoms = Symptom::all();
        return view('symptoms.index', compact('symptoms'));
    }

    // Kullanıcının seçtiği şikayetleri kaydet ve AI önerisi al
    public function store(Request $request)
    {
        $data = $request->validate([
            'symptoms' => 'required|array',
            'notes'    => 'nullable|string'
        ]);

        $user = Auth::user();
        $user->symptoms()->sync([]); // Eski şikayetleri temizle

        foreach ($data['symptoms'] as $symptom_id) {
            $user->symptoms()->attach($symptom_id, ['notes' => $data['notes'] ?? null]);
        }

        // Şikayet isimlerini al
        $symptomNames = $user->symptoms()->pluck('name')->toArray();
        $symptomsText = implode(", ", $symptomNames);

        // AI önerisi
        $recommendation = $this->getGeminiRecommendation($symptomsText);

        return view('symptoms.recommendation', [
            'symptomNames' => $symptomNames,
            'recommendation' => $recommendation
        ]);
    }

    // Kural tabanlı değerlendirme (isteğe bağlı)
    public function evaluate()
    {
        $user = Auth::user();
        $symptomNames = $user->symptoms()->pluck('name')->toArray();
        $recommendation = '';

        if(in_array('Göğüs ağrısı',$symptomNames) && in_array('Çarpıntı',$symptomNames)) {
            $recommendation = '1 hafta boyunca tansiyon ve nabızını ölç, sonra tekrar yükle. Acil durum yoksa doktor yönlendirmesi yapılacak.';
        } elseif(in_array('Yüksek tansiyon',$symptomNames)) {
            $recommendation = 'Evde tansiyon ölçümü yap. Düzenli takip et ve verileri sisteme yükle.';
        } elseif(in_array('Baş ağrısı',$symptomNames) && in_array('Bayılma',$symptomNames)) {
            $recommendation = 'Baş ağrısı ve bayılma devam ederse Nöroloji\'ye yönlendir.';
        } elseif(in_array('Diz ağrısı',$symptomNames) && in_array('Bel ağrısı',$symptomNames)) {
            $recommendation = 'Ortopedi branşı önerilir. Evde egzersiz ve gözlem yap.';
        } else {
            $recommendation = 'Seçilen şikayetler için ön değerlendirme tamamlandı. Gerekirse doktor yönlendirmesi yapılacak.';
        }

        return view('symptoms.recommendation', [
            'symptomNames' => $symptomNames,
            'recommendation' => $recommendation
        ]);
    }

    // AI önerisi al ve şikayetleri kaydet
    public function getAiRecommendation(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'symptoms' => 'required|array',
            'notes' => 'nullable|string'
        ]);

        $user->symptoms()->sync($data['symptoms']);

        $symptomNames = $user->symptoms()->pluck('name')->toArray();
        $symptomsText = implode(", ", $symptomNames);

        $recommendation = $this->getGeminiRecommendation($symptomsText);

        $symptoms = Symptom::all(); // Tüm şikayetleri tekrar getir
        return view('symptoms.index', compact('symptoms','symptomNames','recommendation'));
    }

    /**
     * Gemini API'den kısa ve net öneri al
     */
    private function getGeminiRecommendation($symptomsText)
    {
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            Log::error('GEMINI_API_KEY environment variable is not set');
            return 'Gemini API anahtarı yok.';
        }

        $payload = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => "Kullanıcının şikayetleri: $symptomsText. Tek bir paragraf hâlinde, kısa ve net evde yapılabilecek önerileri ve gerekirse doktora başvuru tavsiyesini yaz. Maddeler hâlinde veya her şikayeti tek tek sayma. Türkçe yanıtla."]
                    ]
                ]
            ],
            "generationConfig" => [
                "temperature" => 0.3,
                "topP" => 0.8,
                "maxOutputTokens" => 150
            ]
        ];


        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $apiKey,
            ])->timeout(30)->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', $payload);

            $json = $response->json();
            Log::info('Gemini API response', ['response' => $json]);

            if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                return trim($json['candidates'][0]['content']['parts'][0]['text']);
            } elseif (isset($json['candidates'][0]['content']['parts'])) {
                $textParts = [];
                foreach ($json['candidates'][0]['content']['parts'] as $part) {
                    if (is_array($part) && isset($part['text'])) {
                        $textParts[] = $part['text'];
                    } elseif (is_string($part)) {
                        $textParts[] = $part;
                    }
                }
                return trim(implode(' ', $textParts));
            } else {
                return 'Gemini’den beklenmeyen yanıt formatı.';
            }

        } catch (\Exception $e) {
            Log::error('Gemini API exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 'Gemini API’ye bağlanırken hata oluştu: ' . $e->getMessage();
        }
    }
}
