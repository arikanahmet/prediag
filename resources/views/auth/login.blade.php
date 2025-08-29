<x-app-layout>
    <form method="POST" action="{{ route('login.post') }}" class="flex flex-col gap-4">
        @csrf
        <input type="text" name="tc" placeholder="TC Kimlik No" class="p-2 border rounded text-black" required>
        <input type="email" name="email" placeholder="E-mail" class="p-2 border rounded text-black" required>
        <input type="password" name="password" placeholder="Şifre" class="p-2 border rounded text-black" required>
        <button type="submit" class="bg-brand text-white py-2 rounded hover:bg-brand-dark">Giriş Yap</button>
        <a href="{{ route('register') }}" class="text-center text-sm mt-2 text-brand-dark underline">Kayıt Ol</a>
    </form>
</x-app-layout>
