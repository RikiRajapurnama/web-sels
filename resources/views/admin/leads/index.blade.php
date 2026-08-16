@extends('layouts.admin')

@section('title', 'Calon Pelanggan')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-xl font-extrabold text-slate-900">Data Calon Pelanggan</h2>
            <p class="mt-1 text-sm text-slate-500">Data pendaftaran dari formulir website Customer.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <span class="inline-flex items-center gap-2 rounded-xl bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Total: {{ $leads->count() }}
            </span>
        </div>
    </div>

    <div class="mt-6 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-100">
        <form method="GET" action="{{ route('admin.leads.index') }}" class="flex flex-wrap items-center gap-3">
            <div class="min-w-[220px] flex-1">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari nama, WhatsApp, alamat, paket..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            </div>
            <select name="status" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                <option value="all">Semua Status</option>
                @foreach ($statuses as $key => $label)
                    <option value="{{ $key }}" {{ ($filters['status'] ?? 'all') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Cari
            </button>
            @if (!empty($filters['search']) || !empty($filters['status']))
                <a href="{{ route('admin.leads.index') }}" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">Reset</a>
            @endif
        </form>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-100 bg-slate-50/50 text-xs uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold">Nama</th>
                        <th class="px-5 py-3.5 font-semibold">WhatsApp</th>
                        <th class="px-5 py-3.5 font-semibold">Alamat</th>
                        <th class="px-5 py-3.5 font-semibold">Paket</th>
                        <th class="px-5 py-3.5 font-semibold">Tanggal</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($leads as $lead)
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-5 py-3 font-semibold text-slate-800">
                                {{ $lead->name }}
                                @if ($lead->status === 'baru')<span class="ml-1.5 rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700">BARU</span>@endif
                            </td>
                            <td class="px-5 py-3 text-slate-500">{{ $lead->whatsapp }}</td>
                            <td class="max-w-[200px] truncate px-5 py-3 text-slate-500">{{ $lead->address }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $lead->package ?? '—' }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $lead->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-5 py-3">
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ ['baru' => 'bg-blue-100 text-blue-700', 'dihubungi' => 'bg-violet-100 text-violet-700', 'diproses' => 'bg-amber-100 text-amber-700', 'survey' => 'bg-cyan-100 text-cyan-700', 'pemasangan' => 'bg-pink-100 text-pink-700', 'selesai' => 'bg-emerald-100 text-emerald-700', 'ditolak' => 'bg-red-100 text-red-700'][$lead->status] ?? 'bg-slate-100 text-slate-600' }}">{{ $statuses[$lead->status] ?? $lead->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.leads.show', $lead) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">Detail</a>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->whatsapp) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-600 transition hover:bg-emerald-100">Chat</a>
                                    <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" data-confirm-delete="Yakin ingin menghapus data {{ $lead->name }}?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-slate-400">
                                <p class="text-sm">Belum ada calon pelanggan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
