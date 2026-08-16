<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\SalesProfile;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('search')) {
            $query->where(fn ($q) => $q
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('whatsapp', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('package', 'like', '%' . $request->search . '%'));
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $leads = $query->latest()->get();

        return view('admin.leads.index', [
            'leads' => $leads,
            'statuses' => Lead::STATUS,
            'sales' => SalesProfile::get(),
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', [
            'lead' => $lead,
            'statuses' => Lead::STATUS,
            'sales' => SalesProfile::get(),
        ]);
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Lead::STATUS)),
        ]);

        $lead->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status lead diperbarui menjadi ' . Lead::STATUS[$request->status] . '.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Data calon pelanggan berhasil dihapus.');
    }
}
