@extends('layouts.app')

@section('content')
<div class="p-4">

    <h2 class="text-xl font-bold mb-4">Ön Değerlendirme Sonucu</h2>

    <div class="mb-4">
        <h3 class="font-semibold">Seçilen Şikayetler:</h3>
        @if(!empty($symptomNames) && is_array($symptomNames))
            <ul class="list-disc ml-5 mb-2">
                @foreach($symptomNames as $name)
                    <li>{{ $name }}</li>
                @endforeach
            </ul>
        @else
            <p>Henüz şikayet seçilmedi.</p>
        @endif
    </div>

    <div class="mb-4">
        <h3 class="font-semibold">Öneri:</h3>
        <p>{{ $recommendation ?? 'Öneri henüz alınmadı.' }}</p>
    </div>

    <p class="text-sm mt-4 opacity-70">
        * Bu öneri, yapay zeka tarafından sağlanmıştır ve kesin bir teşhis değildir. Lütfen bir sağlık profesyoneline danışın.
    </p>

    <a href="{{ route('symptoms.index') }}" class="mt-4 inline-block bg-brand text-white px-4 py-2 rounded hover:bg-brand-dark">
        Yeni Şikayet Ekle
    </a>

</div>
@endsection
