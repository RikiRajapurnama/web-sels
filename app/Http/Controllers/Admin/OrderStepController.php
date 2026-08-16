<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStep;
use Illuminate\Http\Request;

class OrderStepController extends Controller
{
    public function index()
    {
        $steps = OrderStep::orderBy('sort_order')->orderBy('step_number')->get();
        return view('admin.order_steps.index', compact('steps'));
    }

    public function create()
    {
        return view('admin.order_steps.form', ['step' => new OrderStep()]);
    }

    public function store(Request $request)
    {
        OrderStep::create($this->validateData($request));

        return redirect()->route('admin.order-steps.index')->with('success', 'Langkah berhasil ditambahkan.');
    }

    public function edit(OrderStep $step)
    {
        return view('admin.order_steps.form', compact('step'));
    }

    public function update(Request $request, OrderStep $step)
    {
        $step->update($this->validateData($request));

        return redirect()->route('admin.order-steps.index')->with('success', 'Langkah berhasil diperbarui.');
    }

    public function destroy(OrderStep $step)
    {
        $step->delete();

        return redirect()->route('admin.order-steps.index')->with('success', 'Langkah berhasil dihapus.');
    }

    public function toggle(OrderStep $step)
    {
        $step->update(['status' => !$step->status]);

        return redirect()->back()->with('success', 'Status langkah diperbarui.');
    }

    protected function validateData(Request $request): array
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'step_number' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', $data['step_number'] ?? 0);

        return $data;
    }
}
