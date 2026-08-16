@extends('layouts.admin')

@section('title', 'Kelola Banner')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-xl font-extrabold text-slate-900">Data Banner</h2>
            <p class="mt-1 text-sm text-slate-500">Banner aktif otomatis tampil di hero halaman Customer.</p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Banner
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-100 bg-slate-50/50 text-xs uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold">Gambar</th>
                        <th class="px-5 py-3.5 font-semibold">Judul</th>
                        <th class="px-5 py-3.5 font-semibold">Subtitle</th>
                        <th class="px-5 py-3.5 font-semibold">Tombol</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($banners as $banner)
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-5 py-3">
                                @if ($banner->image)
                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="h-12 w-24 rounded-lg object-cover">
                                @else
                                    <span class="flex h-12 w-24 items-center justify-center rounded-lg bg-slate-100 text-slate-300">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $banner->title ?? '—' }}</td>
                            <td class="max-w-[220px] truncate px-5 py-3 text-slate-500">{{ $banner->subtitle ?? '—' }}</td>
                            <td class="px-5 py-3">
                                @if ($banner->button_text)
                                    <span class="text-slate-600">{{ $banner->button_text }}</span>
                                @else
                                    <span class="text-slate-300">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.banners.toggle', $banner) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $banner->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $banner->status ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.banners.edit', $banner) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" data-confirm-delete="Yakin ingin menghapus banner ini?">
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
                            <td colspan="6" class="px-5 py-12 text-center text-slate-400">
                                <p class="text-sm">Belum ada banner. Klik <span class="font-semibold text-blue-600">Tambah Banner</span> untuk membuatnya.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
