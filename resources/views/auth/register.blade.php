<x-app-layout>
    <form method="POST" action="{{ route('register.post') }}" class="flex flex-col gap-4">
        @csrf
        <input type="text" name="name" placeholder="Ad" class="p-2 border rounded text-black" required>
        <input type="text" name="surname" placeholder="Soyad" class="p-2 border rounded text-black" required>
        <input type="text" name="tc" placeholder="TC Kimlik No" class="p-2 border rounded text-black" required>
        <input type="email" name="email" placeholder="E-mail" class="p-2 border rounded text-black" required>
        <input type="text" name="phone" placeholder="Telefon No" class="p-2 border rounded text-black" required>
        <input type="date" name="birthdate" class="p-2 border rounded text-black" required>
        <input type="password" name="password" placeholder="Şifre" class="p-2 border rounded text-black" required>
        <button type="submit" class="bg-brand text-white py-2 rounded hover:bg-brand-dark">Kayıt Ol</button>
        <a href="{{ route('login') }}" class="text-center text-sm mt-2 text-brand-dark underline">Giriş Yap</a>
    </form>
</x-app-layout>
