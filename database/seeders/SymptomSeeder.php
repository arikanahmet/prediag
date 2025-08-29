<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Symptom;
use Illuminate\Support\Facades\DB;

class SymptomSeeder extends Seeder
{
    public function run(): void
    {
        $symptoms = [
            ['name'=>'Göğüs ağrısı','category'=>'Kardiyoloji','icd10_code'=>'R07'],
            ['name'=>'Çarpıntı','category'=>'Kardiyoloji','icd10_code'=>'R00.2'],
            ['name'=>'Yüksek tansiyon','category'=>'Kardiyoloji','icd10_code'=>'I10'],
            ['name'=>'Ayak şişliği','category'=>'Kardiyoloji','icd10_code'=>'R60.0'],
            ['name'=>'Göğüs sıkışması','category'=>'Kardiyoloji','icd10_code'=>'R07.1'],
            ['name'=>'Baş ağrısı','category'=>'Nöroloji','icd10_code'=>'R51'],
            ['name'=>'Bayılma','category'=>'Nöroloji','icd10_code'=>'R55'],
            ['name'=>'Baş dönmesi','category'=>'Nöroloji','icd10_code'=>'R42'],
            ['name'=>'Uyuşma','category'=>'Nöroloji','icd10_code'=>'R20.0'],
            ['name'=>'Ateş','category'=>'Dahiliye','icd10_code'=>'R50'],
            ['name'=>'Halsizlik','category'=>'Dahiliye','icd10_code'=>'R53'],
            ['name'=>'Mide ağrısı','category'=>'Dahiliye','icd10_code'=>'R10'],
            ['name'=>'Boğaz ağrısı','category'=>'Enfeksiyon','icd10_code'=>'J02'],
            ['name'=>'Öksürük','category'=>'Göğüs Hastalıkları','icd10_code'=>'R05'],
            ['name'=>'Nefes darlığı','category'=>'Göğüs Hastalıkları','icd10_code'=>'R06.0'],
            ['name'=>'Karın ağrısı','category'=>'Gastroenteroloji','icd10_code'=>'R10'],
            ['name'=>'İshal','category'=>'Gastroenteroloji','icd10_code'=>'A09'],
            ['name'=>'Kusma','category'=>'Gastroenteroloji','icd10_code'=>'R11'],
            ['name'=>'Diz ağrısı','category'=>'Ortopedi','icd10_code'=>'M25.5'],
            ['name'=>'Bel ağrısı','category'=>'Ortopedi','icd10_code'=>'M54'],
        ];

        // Var olan şikayet isimlerini çek
        $existingNames = Symptom::pluck('name')->toArray();

        // Sadece olmayanları ekle
        $newSymptoms = array_filter($symptoms, function($s) use ($existingNames) {
            return !in_array($s['name'], $existingNames);
        });

        if(!empty($newSymptoms)){
            DB::table('symptoms')->insert($newSymptoms);
        }
        foreach($symptoms as $symptom) 
        {
            Symptom::firstOrCreate(
                ['name' => $symptom['name']], // kontrol alanı
                [
                    'category' => $symptom['category'],
                    'icd10_code' => $symptom['icd10_code']
                ]
            );
        }
    }
}
