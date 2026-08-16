<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;
use Illuminate\Http\Request;

class ServiceAreaController extends Controller
{
    public function index()
    {
        $areas = ServiceArea::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.service_areas.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.service_areas.form', ['area' => new ServiceArea()]);
    }

    public function store(Request $request)
    {
        ServiceArea::create($this->validateData($request));

        return redirect()->route('admin.service-areas.index')->with('success', 'Area layanan berhasil ditambahkan.');
    }

    public function edit(ServiceArea $area)
    {
        return view('admin.service_areas.form', compact('area'));
    }

    public function update(Request $request, ServiceArea $area)
    {
        $area->update($this->validateData($request));

        return redirect()->route('admin.service-areas.index')->with('success', 'Area layanan berhasil diperbarui.');
    }

    public function destroy(ServiceArea $area)
    {
        $area->delete();

        return redirect()->route('admin.service-areas.index')->with('success', 'Area layanan berhasil dihapus.');
    }

    public function toggle(ServiceArea $area)
    {
        $area->update(['status' => !$area->status]);

        return redirect()->back()->with('success', 'Status area diperbarui.');
    }

    protected function validateData(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        return $data;
    }
}
