<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\UploadsImages;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use UploadsImages;

    public function index()
    {
        $banners = Banner::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.form', ['banner' => new Banner()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['image'] = $this->storeImage($request->file('image'), 'uploads/banners');

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.form', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $this->validateData($request);
        $data['image'] = $this->storeImage($request->file('image'), 'uploads/banners', $banner->image);

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $this->deleteImage($banner->image);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }

    public function toggle(Banner $banner)
    {
        $banner->update(['status' => !$banner->status]);

        return redirect()->back()->with('success', 'Status banner diperbarui.');
    }

    protected function validateData(Request $request): array
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        return $data;
    }
}
