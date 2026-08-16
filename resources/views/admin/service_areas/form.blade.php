@extends('layouts.admin')

@section('title', $area->exists ? 'Edit Area' : 'Tambah Area')

@section('content')
    <div class="max-w-2xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.service-areas.index') }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-display text-xl font-extrabold text-slate-900">{{ $area->exists ? 'Edit Area' : 'Tambah Area Baru' }}</h2>
        </div>

        <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
            <form method="POST" action="{{ $area->exists ? route('admin.service-areas.update', $area) : route('admin.service-areas.store') }}" class="space-y-5">
                @csrf
                @if ($area->exists)
                    @method('PUT')
                @endif

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Area <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $area->name) }}" required placeholder="Kota Bandung" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="city" class="mb-1.5 block text-sm font-semibold text-slate-700">Kabupaten/Kota</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $area->city) }}" placeholder="Bandung" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="sort_order" class="mb-1.5 block text-sm font-semibold text-slate-700">Urutan</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $area->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>

                <label class="flex cursor-pointer items-center gap-2.5 rounded-xl border border-slate-200 px-4 py-3">
                    <input type="checkbox" name="status" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('status', $area->status ?? true) ? 'checked' : '' }}>
                    <span class="text-sm font-semibold text-slate-700">Aktifkan area</span>
                </label>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <a href="{{ route('admin.service-areas.index') }}" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
