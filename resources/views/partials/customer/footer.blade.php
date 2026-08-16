@php
    $wa = $sales->waLink($settings['wa_message'] ?? 'Hallo Kak Riki, saya ingin bertanya tentang paket XL SATU WiFi. Mohon infonya ya.');
    $siteName = $settings['site_name'] ?? 'XL SATU WiFi';
    $logo = $settings['site_logo'] ?? null;
    $socials = [
        'facebook' => site_setting('social_facebook'),
        'instagram' => site_setting('social_instagram'),
        'twitter' => site_setting('social_twitter'),
        'tiktok' => site_setting('social_tiktok'),
    ];
@endphp
<footer class="bg-slate-950 text-slate-300">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-3">
            <div>
                <div class="flex items-center gap-2">
                    @if ($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" class="h-10 w-auto">
                    @else
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 13a10 10 0 0 1 14 0" /><path d="M8.5 16.5a5 5 0 0 1 7 0" /><path d="M2 9.5a15 15 0 0 1 20 0" /><circle cx="12" cy="19" r="1" fill="currentColor" stroke="none" />
                            </svg>
                        </span>
                    @endif
                    <span class="font-display text-lg font-extrabold tracking-tight text-white">XL <span class="text-blue-500">SATU</span> WiFi</span>
                </div>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-400">{{ $settings['footer_text'] ?? 'XL SATU WiFi — Internet cepat, stabil dan terjangkau.' }}</p>
                <div class="mt-5 flex gap-3">
                    @if ($socials['facebook'])
                        <a href="{{ $socials['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/5 ring-1 ring-white/10 transition hover:bg-blue-600 hover:text-white">f</a>
                    @endif
                    @if ($socials['instagram'])
                        <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/5 ring-1 ring-white/10 transition hover:bg-pink-600 hover:text-white">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                        </a>
                    @endif
                    @if ($socials['tiktok'])
                        <a href="{{ $socials['tiktok'] }}" target="_blank" rel="noopener" aria-label="TikTok" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/5 ring-1 ring-white/10 transition hover:bg-slate-700 hover:text-white">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <h4 class="font-display text-sm font-bold uppercase tracking-widest text-white">Menu Website</h4>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="#beranda" class="transition hover:text-blue-400">Beranda</a></li>
                    <li><a href="#paket" class="transition hover:text-blue-400">Paket XL WiFi</a></li>
                    <li><a href="#promo" class="transition hover:text-blue-400">Promo</a></li>
                    <li><a href="#keunggulan" class="transition hover:text-blue-400">Keunggulan</a></li>
                    <li><a href="#cara-order" class="transition hover:text-blue-400">Cara Order</a></li>
                    <li><a href="#area" class="transition hover:text-blue-400">Area Layanan</a></li>
                    <li><a href="#tentang-saya" class="transition hover:text-blue-400">Tentang Saya</a></li>
                    <li><a href="#kontak" class="transition hover:text-blue-400">Kontak</a></li>
                </ul>
                <h4 class="mt-6 font-display text-sm font-bold uppercase tracking-widest text-white">Halaman Admin</h4>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('admin.login') }}" class="transition hover:text-blue-400">Login Admin</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-display text-sm font-bold uppercase tracking-widest text-white">Kontak</h4>
                <ul class="mt-4 space-y-3 text-sm">
                    <li>
                        <p class="text-slate-500">Sales</p>
                        <p class="font-semibold text-white">{{ $sales->name }}</p>
                    </li>
                    <li>
                        <p class="text-slate-500">WhatsApp</p>
                        <a href="{{ $wa }}" target="_blank" rel="noopener" class="font-semibold text-emerald-400 transition hover:text-emerald-300">{{ $sales->whatsapp }}</a>
                    </li>
                    @if ($sales->email)
                        <li>
                            <p class="text-slate-500">Email</p>
                            <p class="font-semibold text-white">{{ $sales->email }}</p>
                        </li>
                    @endif
                    @if ($sales->operational_hours)
                        <li>
                            <p class="text-slate-500">Jam Operasional</p>
                            <p class="font-semibold text-white">{{ $sales->operational_hours }}</p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-white/10 pt-6 text-center text-xs text-slate-500">
            {{ $settings['copyright'] ?? ('© ' . date('Y') . ' XL SATU WiFi') }} — Website resmi Sales {{ $sales->name }}
        </div>
    </div>
</footer>

<a href="{{ $wa }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp" class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500 text-white shadow-2xl shadow-emerald-500/40 transition hover:scale-110 hover:bg-emerald-600">
    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
    <span class="absolute -top-0.5 -right-0.5 flex h-3.5 w-3.5">
        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
        <span class="relative inline-flex h-3.5 w-3.5 rounded-full bg-emerald-400"></span>
    </span>
</a>
