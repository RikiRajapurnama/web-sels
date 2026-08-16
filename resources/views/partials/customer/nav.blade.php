@php
    $wa = $sales->waLink($settings['wa_message'] ?? 'Hallo Kak Riki, saya ingin bertanya tentang paket XL SATU WiFi. Mohon infonya ya.');
    $siteName = $settings['site_name'] ?? 'XL SATU WiFi';
    $logo = $settings['site_logo'] ?? null;
@endphp
<header class="sticky top-0 z-50 border-b border-slate-100 bg-white/90 backdrop-blur-md">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <a href="#beranda" class="flex items-center gap-2">
            @if ($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" class="h-10 w-auto">
            @else
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 text-white shadow-md">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13a10 10 0 0 1 14 0" />
                        <path d="M8.5 16.5a5 5 0 0 1 7 0" />
                        <path d="M2 9.5a15 15 0 0 1 20 0" />
                        <circle cx="12" cy="19" r="1" fill="currentColor" stroke="none" />
                    </svg>
                </span>
            @endif
            <span class="font-display text-lg font-extrabold tracking-tight text-slate-900">
                XL <span class="text-blue-700">SATU</span> WiFi
            </span>
        </a>

        <div class="hidden items-center gap-1 lg:flex">
            @php
                $links = [
                    ['Beranda', '#beranda'],
                    ['Paket XL WiFi', '#paket'],
                    ['Promo', '#promo'],
                    ['Keunggulan', '#keunggulan'],
                    ['Cara Order', '#cara-order'],
                    ['Area Layanan', '#area'],
                    ['Tentang Saya', '#tentang-saya'],
                    ['Kontak', '#kontak'],
                ];
            @endphp
            @foreach ($links as [$label, $href])
                <a href="{{ $href }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">{{ $label }}</a>
            @endforeach
            <a href="{{ route('admin.login') }}" class="flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium text-slate-400 transition hover:bg-blue-50 hover:text-blue-700">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Admin
            </a>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.login') }}" title="Login Admin" class="hidden h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 sm:inline-flex lg:hidden">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </a>
            <a href="{{ $wa }}" target="_blank" rel="noopener" class="hidden items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-emerald-500/30 transition hover:bg-emerald-600 sm:inline-flex">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                </svg>
                Chat WhatsApp
            </a>

            <button type="button" data-mobile-menu-toggle aria-expanded="false" aria-label="Buka menu" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-slate-700 lg:hidden">
                <svg data-icon-open class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="4" y1="7" x2="20" y2="7" /><line x1="4" y1="12" x2="20" y2="12" /><line x1="4" y1="17" x2="20" y2="17" />
                </svg>
                <svg data-icon-close class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="6" y1="6" x2="18" y2="18" /><line x1="18" y1="6" x2="6" y2="18" />
                </svg>
            </button>
        </div>
    </nav>

    <div data-mobile-menu class="hidden border-t border-slate-100 bg-white px-4 pb-4 lg:hidden">
        @foreach ($links as [$label, $href])
            <a href="{{ $href }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50">{{ $label }}</a>
        @endforeach
        <a href="{{ route('admin.login') }}" class="flex items-center gap-1.5 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-400 hover:bg-blue-50">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Admin
        </a>
        <a href="{{ $wa }}" target="_blank" rel="noopener" class="mt-2 flex items-center justify-center gap-2 rounded-full bg-emerald-500 px-4 py-2.5 text-sm font-semibold text-white">
            Chat WhatsApp
        </a>
    </div>
</header>
