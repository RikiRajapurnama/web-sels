@extends('layouts.admin')

@section('title', 'Profil Sales')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0zm4 14v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg>
            </div>
            <div>
                <h2 class="font-display text-xl font-extrabold text-slate-900">Profil Sales</h2>
                <p class="text-sm text-slate-500">Data ini tampil di bagian "Tentang Saya" website Customer.</p>
            </div>
        </div>

        <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
            <form method="POST" action="{{ route('admin.sales-profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="flex flex-wrap items-center gap-5">
                    <div class="relative">
                        @if ($profile->photo)
                            <img src="{{ asset('storage/' . $profile->photo) }}" alt="" class="h-24 w-24 rounded-2xl object-cover ring-1 ring-slate-200">
                        @else
                            <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 text-white">
                                <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <label for="photo" class="mb-1.5 block text-sm font-semibold text-slate-700">Foto Sales</label>
                        <input type="file" id="photo" name="photo" accept="image/*" class="w-full max-w-sm rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-blue-600 focus:border-blue-500">
                        @error('photo')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $profile->name) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="title" class="mb-1.5 block text-sm font-semibold text-slate-700">Jabatan <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $profile->title) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="whatsapp" class="mb-1.5 block text-sm font-semibold text-slate-700">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}" required placeholder="0831-7752-2021" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <p class="mt-1 text-xs text-slate-400">Semua tombol WhatsApp di website Customer otomatis memakai nomor ini.</p>
                        @error('whatsapp')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="mb-1.5 block text-sm font-semibold text-slate-700">Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="operational_hours" class="mb-1.5 block text-sm font-semibold text-slate-700">Jam Operasional</label>
                        <input type="text" id="operational_hours" name="operational_hours" value="{{ old('operational_hours', $profile->operational_hours) }}" placeholder="Senin - Minggu, 08.00 - 21.00 WIB" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="mb-1.5 block text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $profile->description) }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
