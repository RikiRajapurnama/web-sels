@extends('layouts.admin')

@section('title', 'Kelola Area Layanan')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-xl font-extrabold text-slate-900">Data Area Layanan</h2>
            <p class="mt-1 text-sm text-slate-500">Area layanan yang tampil di halaman Customer.</p>
        </div>
        <a href="{{ route('admin.service-areas.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Area
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-100 bg-slate-50/50 text-xs uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold">Nama Area</th>
                        <th class="px-5 py-3.5 font-semibold">Kabupaten/Kota</th>
                        <th class="px-5 py-3.5 font-semibold">Urutan</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($areas as $area)
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $area->name }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $area->city ?? '—' }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $area->sort_order }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.service-areas.toggle', $area) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $area->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $area->status ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.service-areas.edit', $area) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">Edit</a>
                                    <form method="POST" action="{{ route('admin.service-areas.destroy', $area) }}" data-confirm-delete="Yakin ingin menghapus area ini?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-slate-400">
                                <p class="text-sm">Belum ada data area layanan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
