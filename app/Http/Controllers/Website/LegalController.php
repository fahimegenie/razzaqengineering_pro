<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Core\Page;

class LegalController extends Controller
{
    public function privacy()
    {
        $page = Page::where('slug', 'privacy-policy')->first();
        return view('website.legal.privacy', compact('page'));
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms-conditions')->first();
        return view('website.legal.terms', compact('page'));
    }

    public function returnPolicy()
    {
        $page = Page::where('slug', 'return-policy')->first();
        return view('website.legal.return', compact('page'));
    }

    public function refund()
    {
        $page = Page::where('slug', 'refund-policy')->first();
        return view('website.legal.refund', compact('page'));
    }

    public function shipping()
    {
        $page = Page::where('slug', 'shipping-policy')->first();
        return view('website.legal.shipping', compact('page'));
    }

    public function payment()
    {
        $page = Page::where('slug', 'payment-policy')->first();
        return view('website.legal.payment', compact('page'));
    }

    public function disclaimer()
    {
        $page = Page::where('slug', 'disclaimer')->first();
        return view('website.legal.disclaimer', compact('page'));
    }

    public function cookies()
    {
        $page = Page::where('slug', 'cookie-policy')->first();
        return view('website.legal.cookies', compact('page'));
    }

    public function cancellation()
    {
        $page = Page::where('slug', 'cancellation-policy')->first();
        return view('website.legal.cancellation', compact('page'));
    }

    public function warranty()
    {
        $page = Page::where('slug', 'warranty-policy')->first();
        return view('website.legal.warranty', compact('page'));
    }
}