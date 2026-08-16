<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — {{ site_setting('site_name', 'XL SATU WiFi') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 px-4 antialiased">
    <div class="pointer-events-none fixed inset-0 opacity-10" style="background-image: radial-gradient(circle at 25% 30%, rgba(255,255,255,.6) 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="relative w-full max-w-md">
        @if (session('success'))
            <div data-alert class="toast-enter mb-4 flex items-center justify-between rounded-xl bg-emerald-500/15 px-4 py-3 text-sm font-medium text-emerald-300 ring-1 ring-emerald-400/30 backdrop-blur">
                <span>{{ session('success') }}</span>
                <button type="button" data-close-alert aria-label="Tutup" class="text-emerald-300"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg></button>
            </div>
        @endif

        <div class="rounded-3xl bg-white/95 p-8 shadow-2xl backdrop-blur">
            <div class="flex flex-col items-center text-center">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-emerald-500 text-white shadow-lg shadow-blue-500/30">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13a10 10 0 0 1 14 0"/><path d="M8.5 16.5a5 5 0 0 1 7 0"/><path d="M2 9.5a15 15 0 0 1 20 0"/><circle cx="12" cy="19" r="1" fill="currentColor" stroke="none"/></svg>
                </span>
                <h1 class="font-display mt-4 text-2xl font-extrabold text-slate-900">Login Admin Sales</h1>
                <p class="mt-1 text-sm text-slate-500">{{ site_setting('site_name', 'XL SATU WiFi') }} — Kelola isi website Customer</p>
            </div>

            <form method="POST" action="{{ route('admin.login.submit') }}" class="mt-8 space-y-4">
                @csrf
                <div>
                    <label for="login" class="mb-1.5 block text-sm font-semibold text-slate-700">Username / Email</label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus autocomplete="username" placeholder="Masukkan username atau email" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Masukkan password" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>

                @error('login')
                    <p class="rounded-lg bg-red-50 px-3 py-2 text-xs font-medium text-red-600 ring-1 ring-red-100">{{ $message }}</p>
                @enderror

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Ingat saya
                </label>

                <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-emerald-500 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-blue-500/30 transition hover:opacity-90">
                    Login
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-slate-400">
                Kembali ke website — <a href="{{ route('home') }}" class="font-semibold text-blue-600 hover:underline">{{ site_setting('site_name', 'XL SATU WiFi') }}</a>
            </p>
        </div>
    </div>
</body>
</html>
