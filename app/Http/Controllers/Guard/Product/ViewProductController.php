<?php

namespace App\Http\Controllers\Guard\Product;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\ProducCategories;
use App\Models\Product;
use Illuminate\Http\Request;

class ViewProductController extends Controller
{
    public function viewCategories()
    {

        $categories = ProducCategories::where('domain', request()->getHost())->get();
        return view('guard.product.view-categories', compact('categories'));
    }

    public function viewCategory($slug)
    {
        $category = ProducCategories::where('slug', $slug)->where('domain', request()->getHost())->first();
        return view('guard.product.view-category', compact('category'));
    }

    public function viewPurchased(Request $request)
    {

        $products = OrderProduct::where('domain', request()->getHost())->where('status', 'success')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);

        return view('guard.product.view-purchased', compact('products'));
    }
}
