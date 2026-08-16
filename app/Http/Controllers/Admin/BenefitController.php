<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = Benefit::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.benefits.index', compact('benefits'));
    }

    public function create()
    {
        return view('admin.benefits.form', ['benefit' => new Benefit()]);
    }

    public function store(Request $request)
    {
        Benefit::create($this->validateData($request));

        return redirect()->route('admin.benefits.index')->with('success', 'Keunggulan berhasil ditambahkan.');
    }

    public function edit(Benefit $benefit)
    {
        return view('admin.benefits.form', compact('benefit'));
    }

    public function update(Request $request, Benefit $benefit)
    {
        $benefit->update($this->validateData($request));

        return redirect()->route('admin.benefits.index')->with('success', 'Keunggulan berhasil diperbarui.');
    }

    public function destroy(Benefit $benefit)
    {
        $benefit->delete();

        return redirect()->route('admin.benefits.index')->with('success', 'Keunggulan berhasil dihapus.');
    }

    public function toggle(Benefit $benefit)
    {
        $benefit->update(['status' => !$benefit->status]);

        return redirect()->back()->with('success', 'Status keunggulan diperbarui.');
    }

    protected function validateData(Request $request): array
    {
        $data = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        return $data;
    }
}
