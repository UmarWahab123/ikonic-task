<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function productList(){
    $products = Product::get();
    return view('product.index',compact('products'));
  }
  public function addProduct(){
    return view('product.save');
  }
  public function storeProduct(Request $request)
  {
    $request->validate([
        'product_title' => 'required|string|max:255',
        'product_price' => 'required',
        'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation as needed
    ]);

    $data = $request->all();

    if ($request->hasFile('product_image')) {
        $backgroundImg0 = 'product_image' . '.' . time() . '.' . $request->file('product_image')->getClientOriginalExtension();
        $request->file('product_image')->move(public_path('img'), $backgroundImg0);
        $data['product_image'] = $backgroundImg0;
    }

    Product::create($data);

    return redirect('/products')->with('success', 'Product has been added!');
 }
 public function delete(Request $request)
 {
     $id = $request->input('id');
     $product = Product::find($id);
    if ($product) {
         $affected_rows = $product->delete();
         return back()->with(['success' => 'Product has been deleted successfully!']);
    }else{
      return back()->with(['error' => 'Product not found!']);
    }

 }

}
