@extends('layouts.admin')

@section('title', 'Detail Calon Pelanggan')

@section('content')
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.leads.index') }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:bg-slate-50">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="font-display text-xl font-extrabold text-slate-900">Detail {{ $lead->name }}</h2>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                <h3 class="font-display text-lg font-bold text-slate-900">Data Pendaftar</h3>
                <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Lengkap</dt>
                        <dd class="mt-1 font-semibold text-slate-800">{{ $lead->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nomor WhatsApp</dt>
                        <dd class="mt-1 font-semibold text-slate-800">{{ $lead->whatsapp }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Alamat</dt>
                        <dd class="mt-1 text-slate-700">{{ $lead->address }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Paket Diminati</dt>
                        <dd class="mt-1 font-semibold text-blue-700">{{ $lead->package ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Daftar Pada</dt>
                        <dd class="mt-1 text-slate-700">{{ $lead->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                    @if ($lead->notes)
                        <div class="sm:col-span-2">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">Catatan</dt>
                            <dd class="mt-1 rounded-xl bg-slate-50 px-4 py-3 text-slate-700">{{ $lead->notes }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                <h3 class="font-display text-lg font-bold text-slate-900">Ubah Status</h3>
                <form method="POST" action="{{ route('admin.leads.status', $lead) }}" class="mt-4 flex flex-wrap items-center gap-3">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @foreach ($statuses as $key => $label)
                            <option value="{{ $key }}" {{ $lead->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">Perbarui Status</button>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                <h3 class="font-display text-lg font-bold text-slate-900">Tindakan</h3>
                <div class="mt-4 space-y-3">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->whatsapp) }}?text={{ rawurlencode('Hallo ' . $lead->name . ', saya Riki Raja Purnama Sales XL SATU WiFi. Terima kasih sudah mendaftar. Mohon infonya terkait paket yang Anda minati.') }}" target="_blank" rel="noopener" class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-500 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        Chat WhatsApp
                    </a>
                    <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" data-confirm-delete="Yakin ingin menghapus data {{ $lead->name }}?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-50 px-4 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
