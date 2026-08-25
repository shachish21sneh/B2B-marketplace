<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SeoController extends Controller
{
    public function sitemap()
    {
        $products = Product::where('is_active', true)->select('slug', 'updated_at')->get();
        $categories = Category::where('is_active', true)->select('slug', 'updated_at')->get();
        $suppliers = Supplier::where('status', 'active')->select('slug', 'updated_at')->get();
        $locations = Location::select('city', 'updated_at')->get();

        $content = view('seo.sitemap', compact('products', 'categories', 'suppliers', 'locations'))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        $appUrl = config('app.url', 'http://127.0.0.1:8000');
        $robots = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /buyer/dashboard/\nDisallow: /supplier/dashboard/\n\nSitemap: {$appUrl}/sitemap.xml\n";

        return response($robots, 200)
            ->header('Content-Type', 'text/plain');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:3000',
        ]);

        return back()->with('success', 'Thank you for reaching out! Our enterprise support team will get back to you within 24 hours.');
    }
}
