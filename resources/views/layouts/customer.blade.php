<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['meta_description'] ?? 'XL SATU WiFi — Internet cepat dan stabil' }}">
    <title>{{ $settings['site_title'] ?? 'XL SATU WiFi' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if ($settings['favicon'] ?? null)
        <link rel="icon" href="{{ asset('storage/' . $settings['favicon']) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php $primary = $settings['primary_color'] ?? '#2563eb'; @endphp
    <style>
        :root { --color-primary: {{ $primary }}; }
        .text-primary-c { color: var(--color-primary); }
        .bg-primary-c { background-color: var(--color-primary); }
        .border-primary-c { border-color: var(--color-primary); }
        .hover-bg-primary-c:hover { background-color: var(--color-primary); }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased">
    @include('partials.customer.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.customer.footer')

    @if (session('success'))
        <div data-toast class="toast-enter fixed top-20 left-1/2 z-[100] -translate-x-1/2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-medium text-white shadow-xl">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div data-toast class="toast-enter fixed top-20 left-1/2 z-[100] -translate-x-1/2 rounded-xl bg-red-600 px-5 py-3 text-sm font-medium text-white shadow-xl">
            {{ $errors->first() }}
        </div>
    @endif
</body>
</html>
