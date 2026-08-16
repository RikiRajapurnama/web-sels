@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h2 class="font-display text-2xl font-extrabold text-slate-900">Selamat datang, {{ auth()->user()->name }}!</h2>
        <p class="mt-1 text-sm text-slate-500">Ringkasan aktivitas website XL SATU WiFi Anda.</p>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
        @php
            $stats = [
                ['Total Calon Pelanggan', $totalLeads, 'M3 17l6-6 4 4 8-8M21 7v6h-6', 'bg-blue-50 text-blue-600'],
                ['Pelanggan Baru', $newLeads, 'M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 6v6m0 0l-3-3m3 3l3-3', 'bg-emerald-50 text-emerald-600'],
                ['Paket Aktif', $activePackages, 'M20 7h-4V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM10 5h4v2h-4V5z', 'bg-violet-50 text-violet-600'],
                ['Promo Aktif', $activePromos, 'M12 2l2.4 7.4H22l-6 4.4 2.3 7.2L12 16.6 5.7 21l2.3-7.2-6-4.4h7.6L12 2z', 'bg-amber-50 text-amber-600'],
                ['Jumlah Banner', $totalBanners, 'M4 15l4-4 3 3 5-5 4 4V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v10zM8 9h.01', 'bg-pink-50 text-pink-600'],
                ['Klik WhatsApp', $waClicks, 'M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z', 'bg-cyan-50 text-cyan-600'],
            ];
        @endphp
        @foreach ($stats as [$label, $value, $icon, $color])
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition hover:shadow-md">
                <div class="flex items-center justify-between">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $color }}">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                    </span>
                </div>
                <p class="font-display mt-4 text-3xl font-extrabold text-slate-900">{{ $value }}</p>
                <p class="mt-1 text-xs font-medium text-slate-500">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        {{-- RECENT LEADS --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 lg:col-span-2">
            <div class="flex items-center justify-between">
                <h3 class="font-display text-lg font-bold text-slate-900">Calon Pelanggan Terbaru</h3>
                <a href="{{ route('admin.leads.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">Lihat semua</a>
            </div>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 text-xs uppercase tracking-wide text-slate-400">
                            <th class="pb-3 pr-4 font-semibold">Nama</th>
                            <th class="pb-3 pr-4 font-semibold">WhatsApp</th>
                            <th class="pb-3 pr-4 font-semibold">Paket</th>
                            <th class="pb-3 pr-4 font-semibold">Tanggal</th>
                            <th class="pb-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentLeads as $lead)
                            <tr class="border-b border-slate-50 last:border-0">
                                <td class="py-3 pr-4 font-semibold text-slate-800">{{ $lead->name }}</td>
                                <td class="py-3 pr-4 text-slate-500">{{ $lead->whatsapp }}</td>
                                <td class="py-3 pr-4 text-slate-500">{{ $lead->package ?? '—' }}</td>
                                <td class="py-3 pr-4 text-slate-500">{{ $lead->created_at->format('d M Y') }}</td>
                                <td class="py-3">
                                    @php
                                        $colors = ['baru' => 'bg-blue-100 text-blue-700', 'dihubungi' => 'bg-violet-100 text-violet-700', 'diproses' => 'bg-amber-100 text-amber-700', 'survey' => 'bg-cyan-100 text-cyan-700', 'pemasangan' => 'bg-pink-100 text-pink-700', 'selesai' => 'bg-emerald-100 text-emerald-700', 'ditolak' => 'bg-red-100 text-red-700'];
                                    @endphp
                                    <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $colors[$lead->status] ?? 'bg-slate-100 text-slate-600' }}">{{ \App\Models\Lead::STATUS[$lead->status] ?? $lead->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-8 text-center text-slate-400">Belum ada calon pelanggan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- LEAD STATUS CHART --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
            <h3 class="font-display text-lg font-bold text-slate-900">Status Calon Pelanggan</h3>
            <div class="mt-6 space-y-4">
                @php
                    $statusColors = ['baru' => '#2563eb', 'dihubungi' => '#8b5cf6', 'diproses' => '#f59e0b', 'survey' => '#06b6d4', 'pemasangan' => '#ec4899', 'selesai' => '#10b981', 'ditolak' => '#ef4444'];
                @endphp
                @foreach (\App\Models\Lead::STATUS as $key => $label)
                    @php
                        $count = $leadsByStatus[$key] ?? 0;
                        $percent = $totalLeads > 0 ? round(($count / $totalLeads) * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-semibold text-slate-600">{{ $label }}</span>
                            <span class="font-bold text-slate-800">{{ $count }}</span>
                        </div>
                        <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full transition-all" style="width: {{ $percent }}%; background-color: {{ $statusColors[$key] ?? '#94a3b8' }};"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="mt-6 text-xs text-slate-400">Lead bulan ini: <span class="font-bold text-slate-600">{{ $leadsThisMonth }}</span></p>
        </div>
    </div>
@endsection
