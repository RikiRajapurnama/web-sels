@extends('layouts.admin')

@section('title', $benefit->exists ? 'Edit Keunggulan' : 'Tambah Keunggulan')

@section('content')
    <div class="max-w-2xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.benefits.index') }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-display text-xl font-extrabold text-slate-900">{{ $benefit->exists ? 'Edit Keunggulan' : 'Tambah Keunggulan Baru' }}</h2>
        </div>

        <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
            <form method="POST" action="{{ $benefit->exists ? route('admin.benefits.update', $benefit) : route('admin.benefits.store') }}" class="space-y-5">
                @csrf
                @if ($benefit->exists)
                    @method('PUT')
                @endif

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="icon" class="mb-1.5 block text-sm font-semibold text-slate-700">Icon</label>
                        <select id="icon" name="icon" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            @php
                                $iconOptions = ['bolt' => '⚡ Petir', 'home' => '🏠 Rumah', 'infinity' => '∞ Tanpa Batas', 'shield' => '🛡️ Perisai', 'wallet' => '👛 Dompet', 'rocket' => '🚀 Roket', 'zap' => '⚡ Zap', 'speed' => '⏱️ Kecepatan'];
                            @endphp
                            @foreach ($iconOptions as $val => $label)
                                <option value="{{ $val }}" {{ old('icon', $benefit->icon) === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sort_order" class="mb-1.5 block text-sm font-semibold text-slate-700">Urutan</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $benefit->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="title" class="mb-1.5 block text-sm font-semibold text-slate-700">Judul <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $benefit->title) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="mb-1.5 block text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $benefit->description) }}</textarea>
                    </div>
                </div>

                <label class="flex cursor-pointer items-center gap-2.5 rounded-xl border border-slate-200 px-4 py-3">
                    <input type="checkbox" name="status" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('status', $benefit->status ?? true) ? 'checked' : '' }}>
                    <span class="text-sm font-semibold text-slate-700">Aktifkan keunggulan</span>
                </label>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <a href="{{ route('admin.benefits.index') }}" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
