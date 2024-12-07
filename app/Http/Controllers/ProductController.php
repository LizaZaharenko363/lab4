<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
        ]);

        DB::table('products')->insert([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image_url' => $data['image_url'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('shop');
    }


    public function getAllProducts()
    {
        $products = DB::table('products')->get();
        return view('shop', compact('products'));
    }

    public function getProduct($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            abort(404);
        }

        return view('product', compact('product'));
    }

    public function editProduct($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            abort(404);
        }

        return view('update_product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $data = $request->only(['name', 'description', 'price', 'image_url']);
        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'image_url' => $data['image_url'],
                'updated_at' => now(),
            ]);

        return redirect()->route('product.show', $id);
    }

    public function deleteProduct($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('shop');
    }
}
