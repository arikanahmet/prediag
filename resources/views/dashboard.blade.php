<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md p-4 hidden md:block">
        <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                Home
            </a>
            <a href="{{ route('symptoms.index') }}" class="px-3 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('symptoms.*') ? 'bg-gray-200 font-semibold' : '' }}">
                Symptoms
            </a>
            <a href="#" class="px-3 py-2 rounded hover:bg-gray-200">
                Users
            </a>
            <a href="#" class="px-3 py-2 rounded hover:bg-gray-200">
                Reports
            </a>
            <a href="#" class="px-3 py-2 rounded hover:bg-gray-200">
                Settings
            </a>
        </nav>
    </aside>

    <!-- Mobile Sidebar Toggle -->
    <div class="md:hidden p-4">
        <button id="menu-toggle" class="bg-brand text-white px-3 py-2 rounded">
            Menu
        </button>
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-semibold mb-4">Welcome to the Dashboard</h1>
        <p class="text-gray-700">Burada özet bilgiler, istatistikler veya işlemler gösterilebilir.</p>

        <!-- Örnek kartlar -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-bold">Total Symptoms</h3>
                <p class="text-2xl mt-2">{{ \App\Models\Symptom::count() }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-bold">Total Users</h3>
                <p class="text-2xl mt-2">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-bold">Other Info</h3>
                <p class="text-2xl mt-2">...</p>
            </div>
        </div>
    </main>

</div>

<!-- Sidebar Toggle Script -->
<script>
    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('aside');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
</script>
@endsection
