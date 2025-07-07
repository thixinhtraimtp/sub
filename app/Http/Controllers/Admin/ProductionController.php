<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProducCategories;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductionController extends Controller
{
    public function viewProductCategory(){

        $categories = ProducCategories::where('domain', request()->getHost())->get();
        $totalProductSelling = Product::where('domain', request()->getHost())->where('status', 'selling')->count();
        $totalProductOrder = OrderProduct::where('domain', request()->getHost())->where('status', 'success')->count();
        $totalProductProfit = OrderProduct::where('domain', request()->getHost())->sum('price');

        return view('admin.production.category', compact('categories', 'totalProductSelling', 'totalProductOrder', 'totalProductProfit'));
    }

    public function createProductCategory(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            //'image' => 'required',
            //'note' => 'required',
            //'description' => 'required',
            'price' => 'required|numeric',
        ]);

        if($valid->fails()){
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        }

        // multiple image upload
        $images = [];

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $rnd = rand(1, 1000);
                $name = time().$rnd.'.'.$image->extension();
                $image->move(public_path('uploads'), $name);
                $images[] = "uploads/".$name;
            }
        }

        $slug = Str::slug($request->slug, '-');

        // check if slug already exists
        $check = ProducCategories::where('slug', $slug)->where('domain', request()->getHost())->first();
        if($check){
            return redirect()->back()->with('error', 'Slug đã tồn tại, vui lòng chọn slug khác');
        }

        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'image' => json_encode($images),
            'description' => $request->description,
            'note' => $request->note,
            'price' => $request->price,
            'domain' => $request->getHost(),
        ];

        // save data to database\
        ProducCategories::create($data);

        return redirect()->back()->with('success', 'Tạo danh mục sản phẩm thành công');
    }

    public function viewEditProductCategory($id){
        $category = ProducCategories::where('id', $id)->where('domain', request()->getHost())->first();

        if(!$category){
            return redirect()->back()->with('error', 'Danh mục sản phẩm không tồn tại');
        }

        return view('admin.production.category-edit', compact('category'));
    }

    public function updateProductCategory(Request $request, $id){
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            //'description' => 'required',
            //'note' => 'required',
            'price' => 'required|numeric',
        ]);

        if($valid->fails()){
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        }

        $category = ProducCategories::where('id', $id)->where('domain', request()->getHost())->first();

        if(!$category){
            return redirect()->back()->with('error', 'Danh mục sản phẩm không tồn tại');
        }

        // multiple image upload
        $images = [];

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){

                // delete old image
                $old_images = json_decode($category->image);
                foreach($old_images as $old_image){
                    if(file_exists(public_path($old_image))){
                        unlink(public_path($old_image));
                    }
                }

                $rnd = rand(1, 1000);
                $name = time().$rnd.'.'.$image->extension();
                $image->move(public_path('uploads'), $name);
                $images[] = "uploads/".$name;
            }
        }else{
            $images = json_decode($category->image);
        }

        $slug = Str::slug($request->slug, '-');

        // check if slug already exists
        $check = ProducCategories::where('slug', $slug)->where('domain', request()->getHost())->where('id', '!=', $id)->first();
        if($check){
            return redirect()->back()->with('error', 'Slug đã tồn tại, vui lòng chọn slug khác');
        }

        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'image' => json_encode($images),
            'description' => $request->description,
            'note' => $request->note,
            'price' => $request->price,
            'domain' => $request->getHost(),
        ];

        // save data to database
        $category->update($data);

        return redirect()->back()->with('success', 'Cập nhật danh mục sản phẩm thành công');
    }

    public function deleteProductCategory($id){
        $category = ProducCategories::where('id', $id)->where('domain', request()->getHost())->first();

        if(!$category){
            return redirect()->back()->with('error', 'Danh mục sản phẩm không tồn tại');
        }

        // delete image
        $images = json_decode($category->image);
        foreach($images as $image){
            if(file_exists(public_path($image))){
                unlink(public_path($image));
            }

            // delete product
            $products = Product::where('category_id', $category->id)->where('domain', request()->getHost())->get();
            foreach($products as $product){
                $product->delete();
            }
        }

        $category->delete();
        return redirect()->back()->with('success', 'Xóa danh mục sản phẩm thành công');
    }

    public function viewAddProduct($id){
        $category = ProducCategories::where('id', $id)->where('domain', request()->getHost())->first();

        return view('admin.production.product', compact('category'));
    }

    public function createProduct(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'data' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()
                ->back()
                ->with('error', $valid->errors()->first())
                ->withInput();
        }

        $category = ProducCategories::where('id', $request->category_id)
            ->where('domain', request()->getHost())
            ->first();

        if (!$category) {
            return redirect()
                ->back()
                ->with('error', 'Danh mục sản phẩm không tồn tại');
        }

        $data = array_filter(explode("\n", $request->data), function ($value) {
            return !empty($value);
        });

        foreach ($data as $row) {
            if (empty($row) || strlen($row) < 1) {
                continue;
            }

            Product::create([
                'category_id' => $request->category_id,
                'name' => $category->name,
                'description' => $category->description,
                'data' => $row,
                'status' => 'selling',
                'domain' => request()->getHost(),
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Thêm sản phẩm thành công');
    }


    public function deleteProduct($id){
        $product = Product::where('id', $id)->where('domain', request()->getHost())->first();

        if(!$product){
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        $product->delete();

        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }
}
