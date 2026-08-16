@extends('layouts.admin')

@section('title', 'Kontak')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div>
                <h2 class="font-display text-xl font-extrabold text-slate-900">Kontak</h2>
                <p class="text-sm text-slate-500">Nomor WhatsApp yang diganti di sini otomatis dipakai semua tombol WhatsApp di website Customer.</p>
            </div>
        </div>

        <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
            <form method="POST" action="{{ route('admin.contact.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="whatsapp" class="mb-1.5 block text-sm font-semibold text-slate-700">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}" required placeholder="0831-7752-2021" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
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
                        <input type="text" id="operational_hours" name="operational_hours" value="{{ old('operational_hours', $profile->operational_hours) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="whatsapp_message" class="mb-1.5 block text-sm font-semibold text-slate-700">Pesan WhatsApp</label>
                        <textarea id="whatsapp_message" name="whatsapp_message" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('whatsapp_message', $whatsappMessage) }}</textarea>
                        <p class="mt-1 text-xs text-slate-400">Pesan ini otomatis terisi saat customer mengklik tombol Chat WhatsApp.</p>
                    </div>
                </div>

                <div class="rounded-xl bg-blue-50 px-4 py-3 text-sm text-blue-700 ring-1 ring-blue-100">
                    Nomor WhatsApp aktif saat ini: <span class="font-bold">{{ $profile->whatsapp }}</span>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
