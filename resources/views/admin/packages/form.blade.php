@extends('layouts.admin')

@section('title', $package->exists ? 'Edit Paket' : 'Tambah Paket')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.packages.index') }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-display text-xl font-extrabold text-slate-900">{{ $package->exists ? 'Edit Paket' : 'Tambah Paket Baru' }}</h2>
        </div>

        <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
            <form method="POST" action="{{ $package->exists ? route('admin.packages.update', $package) : route('admin.packages.store') }}" class="space-y-5">
                @csrf
                @if ($package->exists)
                    @method('PUT')
                @endif

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Paket <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $package->name) }}" required placeholder="350 Mbps" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="speed" class="mb-1.5 block text-sm font-semibold text-slate-700">Kecepatan (Mbps)</label>
                        <input type="number" id="speed" name="speed" min="0" value="{{ old('speed', $package->speed) }}" placeholder="350" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="price" class="mb-1.5 block text-sm font-semibold text-slate-700">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $package->price) }}" required placeholder="279000" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('price')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="period" class="mb-1.5 block text-sm font-semibold text-slate-700">Periode</label>
                        <input type="text" id="period" name="period" value="{{ old('period', $package->period ?? 'bulan') }}" placeholder="bulan" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="mb-1.5 block text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $package->description) }}</textarea>
                    </div>
                    <div>
                        <label for="label" class="mb-1.5 block text-sm font-semibold text-slate-700">Label</label>
                        <input type="text" id="label" name="label" value="{{ old('label', $package->label) }}" placeholder="BEST SELLER" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="sort_order" class="mb-1.5 block text-sm font-semibold text-slate-700">Urutan</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $package->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    <label class="flex cursor-pointer items-center gap-2.5 rounded-xl border border-slate-200 px-4 py-3">
                        <input type="checkbox" name="is_popular" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('is_popular', $package->is_popular) ? 'checked' : '' }}>
                        <span class="text-sm font-semibold text-slate-700">Tandai sebagai populer (best seller)</span>
                    </label>
                    <label class="flex cursor-pointer items-center gap-2.5 rounded-xl border border-slate-200 px-4 py-3">
                        <input type="checkbox" name="status" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('status', $package->status ?? true) ? 'checked' : '' }}>
                        <span class="text-sm font-semibold text-slate-700">Aktifkan paket</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <a href="{{ route('admin.packages.index') }}" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
