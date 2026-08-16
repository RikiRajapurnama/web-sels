@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
            </div>
            <div>
                <h2 class="font-display text-xl font-extrabold text-slate-900">Pengaturan Website</h2>
                <p class="text-sm text-slate-500">Atur identitas website yang tampil untuk Customer.</p>
            </div>
        </div>

        <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="site_name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Website <span class="text-red-500">*</span></label>
                        <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('site_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="site_title" class="mb-1.5 block text-sm font-semibold text-slate-700">Judul Website (Browser Tab)</label>
                        <input type="text" id="site_title" name="site_title" value="{{ old('site_title', $settings['site_title']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="meta_description" class="mb-1.5 block text-sm font-semibold text-slate-700">Meta Description (SEO)</label>
                        <textarea id="meta_description" name="meta_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('meta_description', $settings['meta_description']) }}</textarea>
                    </div>
                    <div>
                        <label for="site_logo" class="mb-1.5 block text-sm font-semibold text-slate-700">Logo</label>
                        <input type="file" id="site_logo" name="site_logo" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-blue-600 focus:border-blue-500">
                        @if ($settings['site_logo'])
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="" class="mt-2 h-10 w-auto">
                        @endif
                    </div>
                    <div>
                        <label for="favicon" class="mb-1.5 block text-sm font-semibold text-slate-700">Favicon</label>
                        <input type="file" id="favicon" name="favicon" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-blue-600 focus:border-blue-500">
                        @if ($settings['favicon'])
                            <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="" class="mt-2 h-8 w-8 rounded">
                        @endif
                    </div>
                    <div>
                        <label for="footer_text" class="mb-1.5 block text-sm font-semibold text-slate-700">Teks Footer</label>
                        <input type="text" id="footer_text" name="footer_text" value="{{ old('footer_text', $settings['footer_text']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="copyright" class="mb-1.5 block text-sm font-semibold text-slate-700">Copyright</label>
                        <input type="text" id="copyright" name="copyright" value="{{ old('copyright', $settings['copyright']) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="primary_color" class="mb-1.5 block text-sm font-semibold text-slate-700">Warna Utama</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="primary_color" name="primary_color" value="{{ old('primary_color', $settings['primary_color']) }}" class="h-11 w-14 cursor-pointer rounded-lg border border-slate-200">
                            <input type="text" value="{{ $settings['primary_color'] }}" class="w-32 rounded-xl border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-blue-500" disabled>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-5">
                    <h3 class="font-display text-sm font-bold uppercase tracking-wide text-slate-500">Social Media</h3>
                    <div class="mt-4 grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="social_facebook" class="mb-1.5 block text-sm font-semibold text-slate-700">Facebook</label>
                            <input type="url" id="social_facebook" name="social_facebook" value="{{ old('social_facebook', $settings['facebook']) }}" placeholder="https://facebook.com/..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        </div>
                        <div>
                            <label for="social_instagram" class="mb-1.5 block text-sm font-semibold text-slate-700">Instagram</label>
                            <input type="url" id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $settings['instagram']) }}" placeholder="https://instagram.com/..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        </div>
                        <div>
                            <label for="social_twitter" class="mb-1.5 block text-sm font-semibold text-slate-700">Twitter / X</label>
                            <input type="url" id="social_twitter" name="social_twitter" value="{{ old('social_twitter', $settings['twitter']) }}" placeholder="https://twitter.com/..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        </div>
                        <div>
                            <label for="social_tiktok" class="mb-1.5 block text-sm font-semibold text-slate-700">TikTok</label>
                            <input type="url" id="social_tiktok" name="social_tiktok" value="{{ old('social_tiktok', $settings['tiktok']) }}" placeholder="https://tiktok.com/..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
