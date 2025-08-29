@extends('layouts.app')

@section('content')
<div class="p-4">

    <h2 class="text-xl font-bold mb-4">Şikayet Seçimi</h2>

    <form method="POST" action="{{ route('symptoms.store') }}">
        @csrf

        {{-- Grid ile şikayet kutuları --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-6">
            @foreach($symptoms as $symptom)
                <label class="relative cursor-pointer">
                    <input type="checkbox" name="symptoms[]" value="{{ $symptom->id }}" 
                           class="peer hidden"
                           @if(isset($symptomNames) && in_array($symptom->name, $symptomNames)) checked @endif>
                    
                    <div class="p-6 min-h-[120px] flex items-center justify-center text-center 
                                bg-white border border-gray-300 rounded-2xl shadow-sm 
                                peer-checked:bg-brand peer-checked:text-white 
                                transition transform active:scale-95">
                        {{ $symptom->name }}
                    </div>
                </label>
            @endforeach
        </div>

        {{-- Ek not --}}
        <div class="mb-6">
            <label for="notes" class="block mb-2 font-semibold">Ek Not (opsiyonel)</label>
            <textarea name="notes" id="notes" rows="3" 
                      class="w-full p-3 border border-gray-300 rounded-lg text-black focus:ring-2 focus:ring-brand"></textarea>
        </div>

        {{-- Gönder Butonu --}}
        <button type="submit" 
                class="w-full bg-brand text-white font-semibold py-3 rounded-2xl shadow-md hover:bg-brand-dark transition">
            Gönder ve AI Önerisi Al
        </button>
    </form>

    {{-- Sonuç --}}
    @isset($recommendation)
        <div class="mt-8 p-6 bg-gray-100 text-black rounded-2xl shadow">
            <h3 class="text-lg font-bold mb-4">Ön Değerlendirme Sonucu</h3>

            <div class="mb-4">
                <h4 class="font-semibold mb-1">Seçilen Şikayetler:</h4>
                <ul class="list-disc ml-5">
                    @foreach($symptomNames as $name)
                        <li>{{ $name }}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-1">Öneri:</h4>
                <p>{{ $recommendation }}</p>
            </div>

            <p class="text-sm mt-6 opacity-70">
                * Bu öneri, yapay zeka tarafından sağlanmıştır ve kesin bir teşhis değildir. 
                Lütfen bir sağlık profesyoneline danışın.
            </p>
        </div>
    @endisset

</div>
@endsection
