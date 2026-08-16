@extends('layouts.admin')

@section('title', 'Kelola Promo')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-xl font-extrabold text-slate-900">Data Promo</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola promo yang tampil di halaman Customer.</p>
        </div>
        <a href="{{ route('admin.promos.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Promo
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-100 bg-slate-50/50 text-xs uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold">Gambar</th>
                        <th class="px-5 py-3.5 font-semibold">Judul</th>
                        <th class="px-5 py-3.5 font-semibold">Harga</th>
                        <th class="px-5 py-3.5 font-semibold">Periode</th>
                        <th class="px-5 py-3.5 font-semibold">Urutan</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($promos as $promo)
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-5 py-3">
                                @if ($promo->image)
                                    <img src="{{ asset('storage/' . $promo->image) }}" alt="" class="h-12 w-20 rounded-lg object-cover">
                                @else
                                    <span class="flex h-12 w-20 items-center justify-center rounded-lg bg-slate-100 text-slate-300">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <p class="font-semibold text-slate-800">{{ $promo->title }}</p>
                                @if ($promo->subtitle)<p class="text-xs text-slate-400">{{ $promo->subtitle }}</p>@endif
                            </td>
                            <td class="px-5 py-3 font-semibold text-slate-700">{{ $promo->price ? 'Rp' . number_format($promo->price, 0, ',', '.') : '—' }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $promo->period ?? '—' }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $promo->sort_order }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.promos.toggle', $promo) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $promo->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $promo->status ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.promos.edit', $promo) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.promos.destroy', $promo) }}" data-confirm-delete="Yakin ingin menghapus promo ini?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-slate-400">
                                <p class="text-sm">Belum ada promo. Klik <span class="font-semibold text-blue-600">Tambah Promo</span> untuk membuatnya.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
