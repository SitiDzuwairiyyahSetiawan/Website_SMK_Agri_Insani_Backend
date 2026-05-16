<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();

        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tag'         => 'nullable|string|max:100',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'       => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('sliders', 'public');

            $data['image'] = $path;
        }

        $data['is_active'] = $request->has('is_active');

        Slider::create($data);

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.show', compact('slider'));
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tag'         => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'       => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {

            if ($slider->image) {

                Storage::disk('public')->delete($slider->image);
            }

            $path = $request->file('image')->store('sliders', 'public');

            $data['image'] = $path;
        }

        $data['is_active'] = $request->has('is_active');

        $slider->update($data);

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Slide berhasil diupdate.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {

            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Slide berhasil dihapus.');
    }
}