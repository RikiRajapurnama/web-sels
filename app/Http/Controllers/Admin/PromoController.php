<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\UploadsImages;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    use UploadsImages;

    public function index()
    {
        $promos = Promo::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.form', ['promo' => new Promo()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['image'] = $this->storeImage($request->file('image'), 'uploads/promos');

        Promo::create($data);

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.form', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $data = $this->validateData($request);
        $data['image'] = $this->storeImage($request->file('image'), 'uploads/promos', $promo->image);

        $promo->update($data);

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        $this->deleteImage($promo->image);
        $promo->delete();

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil dihapus.');
    }

    public function toggle(Promo $promo)
    {
        $promo->update(['status' => !$promo->status]);

        return redirect()->back()->with('success', 'Status promo diperbarui.');
    }

    protected function validateData(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'period' => 'nullable|string|max:255',
            'bonus' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);
        $data['price'] = $request->input('price') !== null && $request->input('price') !== ''
            ? $request->input('price')
            : null;

        return $data;
    }
}
