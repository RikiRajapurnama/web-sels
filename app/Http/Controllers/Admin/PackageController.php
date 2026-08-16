<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.form', ['package' => new Package()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.form', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $this->validateData($request);
        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
    }

    public function toggle(Package $package)
    {
        $package->update(['status' => !$package->status]);

        return redirect()->back()->with('success', 'Status paket diperbarui.');
    }

    protected function validateData(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'speed' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'period' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'label' => 'nullable|string|max:255',
            'is_popular' => 'nullable',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->boolean('status');
        $data['is_popular'] = $request->boolean('is_popular');
        $data['sort_order'] = $request->input('sort_order', 0);
        $data['period'] = $request->input('period', 'bulan');

        return $data;
    }
}
