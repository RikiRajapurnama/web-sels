@extends('layouts.admin')

@section('title', $banner->exists ? 'Edit Banner' : 'Tambah Banner')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.banners.index') }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-display text-xl font-extrabold text-slate-900">{{ $banner->exists ? 'Edit Banner' : 'Tambah Banner Baru' }}</h2>
        </div>

        <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
            <form method="POST" action="{{ $banner->exists ? route('admin.banners.update', $banner) : route('admin.banners.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @if ($banner->exists)
                    @method('PUT')
                @endif

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="title" class="mb-1.5 block text-sm font-semibold text-slate-700">Judul Banner</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $banner->title) }}" placeholder="Internet Stabil, Hidup Makin Lancar!" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="sort_order" class="mb-1.5 block text-sm font-semibold text-slate-700">Urutan</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="subtitle" class="mb-1.5 block text-sm font-semibold text-slate-700">Subtitle</label>
                        <textarea id="subtitle" name="subtitle" rows="2" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('subtitle', $banner->subtitle) }}</textarea>
                    </div>
                    <div>
                        <label for="button_text" class="mb-1.5 block text-sm font-semibold text-slate-700">Teks Tombol</label>
                        <input type="text" id="button_text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" placeholder="Chat WhatsApp" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="button_link" class="mb-1.5 block text-sm font-semibold text-slate-700">Link Tombol</label>
                        <input type="text" id="button_link" name="button_link" value="{{ old('button_link', $banner->button_link) }}" placeholder="https://wa.me/6283177522021" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="image" class="mb-1.5 block text-sm font-semibold text-slate-700">Gambar Banner <span class="font-normal text-slate-400">(disarankan lebar 1600px)</span></label>
                        <input type="file" id="image" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-blue-600 focus:border-blue-500">
                        @error('image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        @if ($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="mt-2 h-24 w-40 rounded-lg object-cover">
                        @endif
                    </div>
                </div>

                <label class="flex cursor-pointer items-center gap-2.5 rounded-xl border border-slate-200 px-4 py-3">
                    <input type="checkbox" name="status" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('status', $banner->status ?? true) ? 'checked' : '' }}>
                    <span class="text-sm font-semibold text-slate-700">Aktifkan banner</span>
                </label>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <a href="{{ route('admin.banners.index') }}" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
