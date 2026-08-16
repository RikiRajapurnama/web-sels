@extends('layouts.customer')

@section('content')
    @php
        $wa = $sales->waLink($settings['wa_message'] ?? 'Hallo Kak Riki, saya ingin bertanya tentang paket XL SATU WiFi. Mohon infonya ya.');
        $siteName = $settings['site_name'] ?? 'XL SATU WiFi';
    @endphp

    {{-- ============ HERO ============ --}}
    <section id="beranda" class="relative overflow-hidden bg-gradient-to-br from-blue-800 via-blue-700 to-blue-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 30%, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 28px 28px;"></div>
        <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-32 left-1/3 h-96 w-96 rounded-full bg-emerald-400/20 blur-3xl"></div>

        @if (count($banners) > 0 && $banners->first()->image)
            <img src="{{ asset('storage/' . $banners->first()->image) }}" alt="{{ $banners->first()->title }}" class="pointer-events-none absolute inset-0 h-full w-full object-cover">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-blue-900/95 via-blue-800/85 to-blue-600/70"></div>
        @endif

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div class="animate-slide-up">
                @if (count($banners) > 0)
                    @php $banner = $banners->first(); @endphp
                    @if ($banner->title)
                        <h1 class="font-display text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                            {{ $banner->title }}
                        </h1>
                    @else
                        <h1 class="font-display text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">Internet Stabil, Hidup Makin Lancar!</h1>
                    @endif
                    @if ($banner->subtitle)
                        <p class="mt-5 max-w-xl text-lg text-blue-100">{{ $banner->subtitle }}</p>
                    @else
                        <p class="mt-5 max-w-xl text-lg text-blue-100">XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau untuk rumah, kerja, belajar, dan hiburan.</p>
                    @endif
                @else
                    <h1 class="font-display text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">Internet Stabil, Hidup Makin Lancar!</h1>
                    <p class="mt-5 max-w-xl text-lg text-blue-100">XL SATU WiFi hadir untuk koneksi cepat, stabil dan terjangkau untuk rumah, kerja, belajar, dan hiburan.</p>
                @endif

                <ul class="mt-7 grid max-w-xl grid-cols-1 gap-3 sm:grid-cols-2">
                    @php
                        $heroFeatures = [
                            ['Kecepatan Konsisten', 'M7 16V4m0 0L3 8m4-4l4 4'],
                            ['Koneksi Kuat di Seluruh Rumah', 'M3 10v4a1 1 0 001 1h4l3 3V6L8 9H4a1 1 0 00-1 1z'],
                            ['Tanpa Batas Kuota', 'M13 10V3L4 14h7v7l9-11h-7z'],
                            ['Pasti Terpercaya', 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'],
                        ];
                    @endphp
                    @foreach ($heroFeatures as [$text, $path])
                        <li class="flex items-center gap-3 rounded-xl bg-white/10 px-4 py-3 backdrop-blur-sm">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-400 text-blue-900">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $path }}"/></svg>
                            </span>
                            <span class="text-sm font-semibold">{{ $text }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ $wa }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/40 transition hover:-translate-y-0.5 hover:bg-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        Chat WhatsApp
                    </a>
                    <a href="#kontak" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3.5 text-sm font-bold text-blue-700 shadow-lg shadow-blue-900/30 transition hover:-translate-y-0.5 hover:bg-blue-50">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Hubungi Saya
                    </a>
                    <span class="flex items-center gap-2 text-sm font-semibold text-blue-100">
                        <svg class="h-4 w-4 text-emerald-300" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        {{ $sales->whatsapp }}
                    </span>
                </div>
            </div>

            <div class="relative hidden justify-center lg:flex">
                <div class="animate-float relative">
                    <div class="relative rounded-3xl bg-white/10 p-6 backdrop-blur-md ring-1 ring-white/20">
                        <div class="rounded-2xl bg-white p-8 text-slate-800 shadow-2xl">
                            <div class="flex items-center justify-between">
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">ONLINE</span>
                                <span class="text-xs font-medium text-slate-400">XL SATU WiFi</span>
                            </div>
                            <div class="mt-6 flex justify-center">
                                <div class="relative">
                                    <div class="absolute inset-0 animate-pulse rounded-full bg-blue-100 blur-lg"></div>
                                    <div class="relative flex h-40 w-40 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-blue-800 text-white shadow-xl">
                                        <svg class="h-20 w-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 13a10 10 0 0 1 14 0" />
                                            <path d="M8.5 16.5a5 5 0 0 1 7 0" />
                                            <path d="M2 9.5a15 15 0 0 1 20 0" />
                                            <circle cx="12" cy="19" r="1" fill="currentColor" stroke="none" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                                @foreach ([['350','Mbps'],['250','Mbps'],['400','Mbps']] as [$val, $unit])
                                    <div class="rounded-xl bg-slate-50 py-3">
                                        <p class="font-display text-xl font-extrabold text-blue-700">{{ $val }}</p>
                                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">{{ $unit }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-5 text-center text-sm font-semibold text-slate-500">Koneksi cepat & stabil di setiap sudut rumah</p>
                        </div>
                    </div>
                </div>
                <div class="animate-float-slow absolute -left-10 bottom-8 rounded-2xl bg-white p-4 shadow-xl">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Tanpa Batas Kuota</p>
                            <p class="text-xs text-slate-400">Internet tanpa khawatir</p>
                        </div>
                    </div>
                </div>
                <div class="animate-float absolute -right-8 top-10 rounded-2xl bg-white p-4 shadow-xl" style="animation-delay: 1s;">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Pasti Terpercaya</p>
                            <p class="text-xs text-slate-400">Provider tepercaya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ PROMO ============ --}}
    @if (count($promos) > 0)
        <section id="promo" class="bg-gradient-to-b from-blue-50/70 to-white py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M9.5 15.5L3 9l1.5-1.5L9.5 12l8-8L19 5.5l-9.5 9.5zM20 16.5v3.5a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h5v2H4v10h14v-1.5h2z" transform="rotate(15 12 12)"/></svg>
                        Promo Terbaru
                    </span>
                    <h2 class="font-display mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Promo XL SATU Terbaru</h2>
                    <p class="mt-3 text-slate-500">Jangan lewatkan penawaran spesial untuk Anda.</p>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-2">
                    @foreach ($promos as $promo)
                        <div class="group overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-slate-100 transition hover:shadow-xl">
                            <div class="flex flex-col sm:flex-row">
                                @if ($promo->image)
                                    <div class="h-48 w-full shrink-0 sm:h-auto sm:w-56">
                                        <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->title }}" class="h-full w-full object-cover">
                                    </div>
                                @else
                                    <div class="flex h-48 w-full shrink-0 items-center justify-center bg-gradient-to-br from-blue-700 to-blue-900 text-white sm:h-auto sm:w-56">
                                        <svg class="h-20 w-20 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 3v3m0 12v3m9-9h-3M6 12H3m13.5-6.5L15 7M9 17l-1.5 1.5m9 0L15 17M9 7L7.5 5.5"/>
                                            <circle cx="12" cy="12" r="4" fill="currentColor" stroke="none" opacity=".35"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1 p-6">
                                    @if ($promo->subtitle)
                                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-600">{{ $promo->subtitle }}</p>
                                    @endif
                                    <h3 class="font-display mt-1 text-xl font-bold text-slate-900">{{ $promo->title }}</h3>
                                    @if ($promo->description)
                                        <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $promo->description }}</p>
                                    @endif
                                    @if ($promo->price || $promo->period)
                                        <div class="mt-3 flex items-baseline gap-2">
                                            @if ($promo->price)
                                                <span class="font-display text-2xl font-extrabold text-blue-700">Rp{{ number_format($promo->price, 0, ',', '.') }}</span>
                                            @endif
                                            @if ($promo->period)
                                                <span class="text-sm font-semibold text-slate-400">/ {{ $promo->period }}</span>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($promo->bonus)
                                        <div class="mt-4">
                                            <p class="text-xs font-bold uppercase tracking-wide text-slate-400">Bonus:</p>
                                            <ul class="mt-2 space-y-1.5">
                                                @foreach (explode("\n", $promo->bonus) as $b)
                                                    @if (trim($b) !== '')
                                                        <li class="flex items-center gap-2 text-sm font-medium text-slate-600">
                                                            <svg class="h-4 w-4 shrink-0 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                            {{ $b }}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="mt-8 text-center text-xs text-slate-400">Promo dan ketersediaan paket dapat berbeda berdasarkan area dan periode promosi.</p>
            </div>
        </section>
    @endif

    {{-- ============ PAKET ============ --}}
    <section id="paket" class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-blue-700">Paket Internet</span>
                <h2 class="font-display mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Pilihan Paket XL SATU WiFi</h2>
                <p class="mt-3 text-slate-500">Pilih paket yang sesuai dengan kebutuhan Anda. Harga sudah termasuk biaya berlangganan bulanan.</p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ($packages as $package)
                    @php
                        $isPopular = $package->is_popular;
                        $waPackage = $sales->waLink('Hallo Kak Riki, saya tertarik dengan paket XL SATU WiFi ' . $package->name . '. Mohon informasi lengkapnya.');
                    @endphp
                    <div class="relative flex flex-col rounded-3xl p-[2px] {{ $isPopular ? 'bg-gradient-to-b from-blue-600 to-emerald-500 shadow-2xl shadow-blue-500/20' : 'bg-slate-100' }}">
                        @if ($package->label)
                            <span class="absolute -top-3 left-1/2 z-10 -translate-x-1/2 rounded-full bg-gradient-to-r from-blue-600 to-emerald-500 px-4 py-1 text-xs font-extrabold uppercase tracking-wide text-white shadow-lg">{{ $package->label }}</span>
                        @endif
                        <div class="flex flex-1 flex-col rounded-[calc(1.5rem-2px)] bg-white p-8">
                            <div class="flex items-center justify-between">
                                <h3 class="font-display text-xl font-bold text-slate-900">{{ $package->name }}</h3>
                                @if ($package->speed)
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">{{ $package->speed }} Mbps</span>
                                @endif
                            </div>
                            @if ($package->description)
                                <p class="mt-3 text-sm leading-relaxed text-slate-500">{{ $package->description }}</p>
                            @endif
                            <div class="mt-6 flex items-baseline gap-1">
                                <span class="text-sm font-semibold text-slate-400">Rp</span>
                                <span class="font-display text-4xl font-extrabold text-blue-700">{{ number_format($package->price, 0, ',', '.') }}</span>
                                <span class="text-sm font-medium text-slate-400">/ {{ $package->period }}</span>
                            </div>
                            <div class="mt-8 flex-1"></div>
                            <a href="{{ $waPackage }}" target="_blank" rel="noopener" class="inline-flex w-full items-center justify-center gap-2 rounded-full py-3 text-sm font-bold transition {{ $isPopular ? 'bg-gradient-to-r from-blue-600 to-emerald-500 text-white shadow-lg shadow-blue-500/30 hover:opacity-90' : 'bg-slate-900 text-white hover:bg-blue-700' }}">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                                Pilih Paket
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="mt-8 text-center text-xs text-slate-400">Harga dan ketersediaan dapat berubah sewaktu-waktu. Hubungi Sales untuk penawaran terbaik.</p>
        </div>
    </section>

    {{-- ============ KEUNGGULAN ============ --}}
    <section id="keunggulan" class="bg-gradient-to-b from-slate-50 to-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-emerald-700">Keunggulan</span>
                <h2 class="font-display mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Mengapa Harus Pilih XL SATU?</h2>
                <p class="mt-3 text-slate-500">Kami hadir untuk memberikan pengalaman internet terbaik bagi keluarga Anda.</p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($benefits as $benefit)
                    @php
                        $icons = [
                            'bolt' => 'M13 10V3L4 14h7v7l9-11h-7z',
                            'home' => 'M3 10.5L12 3l9 7.5V21h-5.5v-6h-7v6H3v-10.5z',
                            'infinity' => 'M18.178 8c5.096 0 5.096 8 0 8-5.095 0-7.133-8-12.739-8-4.585 0-4.585 8 0 8 5.606 0 7.644-8 12.74-8z',
                            'shield' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
                            'wallet' => 'M20 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM16 13h4m-2-6V5a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v2',
                            'rocket' => 'M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09zM12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2zM9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5',
                            'zap' => 'M13 2L3 14h9l-1 8 10-12h-9l1-8z',
                            'speed' => 'M12 13V5m0 8l-4-2m4 2l4-2M7 5h10M6 21l1-4M18 21l-1-4M12 21v-4',
                        ];
                    @endphp
                    <div class="group rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-xl">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 text-white shadow-lg shadow-blue-600/25 transition group-hover:scale-110">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icons[$benefit->icon] ?? $icons['zap'] }}"/></svg>
                        </span>
                        <h3 class="font-display mt-5 text-lg font-bold text-slate-900">{{ $benefit->title }}</h3>
                        @if ($benefit->description)
                            <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $benefit->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ CARA ORDER ============ --}}
    <section id="cara-order" class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-blue-700">Cara Order</span>
                <h2 class="font-display mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Mudah! Hanya 4 Langkah</h2>
                <p class="mt-3 text-slate-500">Proses pemasangan cepat dan praktis, Anda tinggal menunggu internet aktif.</p>
            </div>

            <div class="relative mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="absolute inset-x-0 top-8 hidden h-0.5 bg-gradient-to-r from-blue-200 via-emerald-200 to-blue-200 lg:block"></div>
                @php
                    $stepIcons = [
                        'chat' => 'M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z',
                        'package' => 'M16.5 9.4l-9-5.19M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12',
                        'wrench' => 'M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z',
                        'wifi' => 'M5 13a10 10 0 0 1 14 0M8.5 16.5a5 5 0 0 1 7 0M2 9.5a15 15 0 0 1 20 0M12 20h.01',
                        'phone' => 'M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z',
                    ];
                @endphp
                @foreach ($steps as $step)
                    <div class="relative text-center">
                        <div class="relative z-10 mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 text-white shadow-xl shadow-blue-600/25 ring-4 ring-white">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $stepIcons[$step->icon] ?? $stepIcons['chat'] }}"/></svg>
                        </div>
                        <span class="absolute left-1/2 top-16 z-0 -translate-x-1/2 text-5xl font-extrabold text-blue-100">{{ $step->step_number }}</span>
                        <h3 class="font-display relative mt-4 text-lg font-bold text-slate-900">{{ $step->title }}</h3>
                        @if ($step->description)
                            <p class="relative mx-auto mt-2 max-w-xs text-sm leading-relaxed text-slate-500">{{ $step->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ AREA LAYANAN ============ --}}
    <section id="area" class="bg-gradient-to-b from-blue-800 to-blue-900 py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-blue-200">Area Layanan</span>
                <h2 class="font-display mt-4 text-3xl font-extrabold tracking-tight sm:text-4xl">Area Layanan Kami</h2>
                <p class="mt-3 text-blue-200">Kami melayani pemasangan di berbagai area berikut.</p>
            </div>

            <div class="mt-12 flex flex-wrap justify-center gap-3">
                @foreach ($areas as $area)
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-5 py-2.5 text-sm font-semibold ring-1 ring-white/20 backdrop-blur-sm transition hover:bg-emerald-500/20 hover:ring-emerald-400/40">
                        <svg class="h-4 w-4 text-emerald-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $area->name }}
                    </span>
                @endforeach
            </div>

            <p class="mt-10 text-center text-sm text-blue-200">
                Ketersediaan jaringan dapat berbeda berdasarkan lokasi. Hubungi Sales untuk pengecekan alamat.
            </p>
        </div>
    </section>

    {{-- ============ PROFIL SALES ============ --}}
    <section id="tentang-saya" class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-emerald-700">Tentang Saya</span>
                <h2 class="font-display mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Sales XL SATU WiFi</h2>
            </div>

            <div class="mx-auto mt-12 max-w-3xl overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-100">
                <div class="h-24 bg-gradient-to-r from-blue-700 via-blue-600 to-emerald-500"></div>
                <div class="px-6 pb-8 sm:px-10">
                    <div class="-mt-16 flex flex-col items-center gap-6 sm:flex-row sm:items-end">
                        @if ($sales->photo)
                            <img src="{{ asset('storage/' . $sales->photo) }}" alt="{{ $sales->name }}" class="h-32 w-32 rounded-2xl border-4 border-white object-cover shadow-xl">
                        @else
                            <div class="flex h-32 w-32 items-center justify-center rounded-2xl border-4 border-white bg-gradient-to-br from-blue-600 to-blue-800 text-white shadow-xl">
                                <svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                        @endif
                        <div class="pb-1 text-center sm:text-left">
                            <h3 class="font-display text-2xl font-extrabold text-slate-900">{{ $sales->name }}</h3>
                            <p class="mt-1 font-semibold text-blue-700">{{ $sales->title }}</p>
                        </div>
                    </div>

                    @if ($sales->description)
                        <p class="mt-6 text-center text-slate-600 sm:text-left">"{{ $sales->description }}"</p>
                    @endif

                    <div class="mt-6 flex flex-wrap items-center justify-center gap-4 sm:justify-between">
                        <a href="{{ $wa }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-emerald-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            WhatsApp: {{ $sales->whatsapp }}
                        </a>
                        <div class="flex gap-3">
                            <a href="{{ $wa }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-emerald-500/30 transition hover:bg-emerald-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                Chat WhatsApp
                            </a>
                            <a href="#kontak" class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-blue-600/30 transition hover:bg-blue-700">
                                Hubungi Saya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ FORM DAFTAR ============ --}}
    <section id="kontak" class="bg-gradient-to-b from-slate-50 to-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto grid max-w-5xl items-center gap-10 lg:grid-cols-2">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-blue-700">Daftar Sekarang</span>
                    <h2 class="font-display mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Daftar Sekarang & Nikmati Internet Cepat</h2>
                    <p class="mt-4 text-slate-500">Isi formulir di samping, tim kami akan segera menghubungi Anda untuk konfirmasi paket dan jadwal pemasangan.</p>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">WhatsApp</p>
                                <p class="font-semibold text-slate-800">{{ $sales->whatsapp }}</p>
                            </div>
                        </div>
                        @if ($sales->phone)
                            <div class="flex items-center gap-4">
                                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Telepon</p>
                                    <p class="font-semibold text-slate-800">{{ $sales->phone }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($sales->email)
                            <div class="flex items-center gap-4">
                                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm0 4l8 5 8-5"/></svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Email</p>
                                    <p class="font-semibold text-slate-800">{{ $sales->email }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($sales->operational_hours)
                            <div class="flex items-center gap-4">
                                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jam Operasional</p>
                                    <p class="font-semibold text-slate-800">{{ $sales->operational_hours }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-100">
                    <h3 class="font-display text-xl font-bold text-slate-900">Formulir Pendaftaran</h3>
                    <p class="mt-1 text-sm text-slate-500">Isi data Anda, kami akan segera menghubungi.</p>

                    <form action="{{ route('leads.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="whatsapp" class="mb-1.5 block text-sm font-semibold text-slate-700">Nomor WhatsApp</label>
                            <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" required placeholder="Contoh: 081234567890" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            @error('whatsapp') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="address" class="mb-1.5 block text-sm font-semibold text-slate-700">Alamat</label>
                            <textarea id="address" name="address" required rows="2" placeholder="Alamat lengkap (kecamatan, kota)" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('address') }}</textarea>
                            @error('address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="package" class="mb-1.5 block text-sm font-semibold text-slate-700">Paket yang diminati</label>
                            <select id="package" name="package" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                                <option value="">-- Pilih paket --</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->name }}" {{ old('package') === $package->name ? 'selected' : '' }}>{{ $package->name }} — Rp{{ number_format($package->price, 0, ',', '.') }}/{{ $package->period }}</option>
                                @endforeach
                            </select>
                            @error('package') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="notes" class="mb-1.5 block text-sm font-semibold text-slate-700">Catatan</label>
                            <textarea id="notes" name="notes" rows="2" placeholder="Catatan tambahan (opsional)" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('notes') }}</textarea>
                            @error('notes') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full rounded-full bg-gradient-to-r from-blue-600 to-emerald-500 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-blue-500/30 transition hover:opacity-90">
                            Daftar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
