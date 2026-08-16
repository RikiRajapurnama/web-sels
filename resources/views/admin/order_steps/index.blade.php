@extends('layouts.admin')

@section('title', 'Kelola Cara Order')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-xl font-extrabold text-slate-900">Data Cara Order</h2>
            <p class="mt-1 text-sm text-slate-500">Langkah-langkah cara order yang tampil di halaman Customer.</p>
        </div>
        <a href="{{ route('admin.order-steps.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Langkah
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-100 bg-slate-50/50 text-xs uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold">#</th>
                        <th class="px-5 py-3.5 font-semibold">Icon</th>
                        <th class="px-5 py-3.5 font-semibold">Judul</th>
                        <th class="px-5 py-3.5 font-semibold">Deskripsi</th>
                        <th class="px-5 py-3.5 font-semibold">Urutan</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($steps as $step)
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-5 py-3 font-bold text-blue-700">{{ $step->step_number }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                </span>
                            </td>
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $step->title }}</td>
                            <td class="max-w-[260px] truncate px-5 py-3 text-slate-500">{{ $step->description ?? '—' }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $step->sort_order }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.order-steps.toggle', $step) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $step->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $step->status ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.order-steps.edit', $step) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">Edit</a>
                                    <form method="POST" action="{{ route('admin.order-steps.destroy', $step) }}" data-confirm-delete="Yakin ingin menghapus langkah ini?">
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
                                <p class="text-sm">Belum ada langkah cara order.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
