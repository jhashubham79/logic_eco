<?php
namespace GP247\Shop\Admin\Controllers;

use GP247\Shop\Models\ShopTestimonial;
use Illuminate\Http\Request;
use GP247\Core\Controllers\RootAdminController;

class ShopTestimonialController extends RootAdminController
{
    public function index()
    {
        
        $testimonials = ShopTestimonial::latest()->get();
        //dd($testimonials);
        return view('gp247-shop-admin::testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        
        return view('gp247-shop-admin::testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'message'     => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['author_name', 'designation', 'message']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        ShopTestimonial::create($data);

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial added successfully!');
    }
    
    
     public function edit($id)
    {
        $testimonial = ShopTestimonial::findOrFail($id);
        return view('gp247-shop-admin::testimonial.edit', compact('testimonial'));
    }
    
     public function update(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $testimonial = ShopTestimonial::findOrFail($id);
        $data = $request->only(['author_name', 'designation', 'message']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully');
    }

    public function destroy($id)
    {
        ShopTestimonial::findOrFail($id)->delete();
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial deleted successfully');
    }
}
