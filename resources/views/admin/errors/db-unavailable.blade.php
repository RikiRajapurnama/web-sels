<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Belum Tersedia — {{ site_setting('site_name', 'XL SATU WiFi') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 px-4 antialiased">
    <div class="w-full max-w-md rounded-3xl bg-white/95 p-8 text-center shadow-2xl backdrop-blur">
        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-lg shadow-orange-500/30">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </span>
        <h1 class="font-display mt-4 text-2xl font-extrabold text-slate-900">Database Belum Tersedia</h1>
        <p class="mt-2 text-sm text-slate-500">
            Halaman admin membutuhkan database. Konfigurasikan database pada dashboard Vercel
            (Environment Variables), lalu lakukan deploy ulang. Website customer tetap bisa diakses.
        </p>
        <div class="mt-6 flex flex-col gap-3">
            <a href="{{ route('home') }}" class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-emerald-500 py-3 text-sm font-bold text-white shadow-lg transition hover:opacity-90">
                Kembali ke Website
            </a>
            <a href="{{ route('admin.login') }}" class="w-full rounded-xl border border-slate-200 py-3 text-sm font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-700">
                Halaman Login
            </a>
        </div>
    </div>
</body>
</html>
