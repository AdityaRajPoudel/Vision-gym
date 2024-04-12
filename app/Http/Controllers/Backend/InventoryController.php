<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    private $default_pagination;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $products = Product::orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.product.index", compact('products'));
    }

    public function create()
    {
        do {
            $productCode = 'Pr-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Product::where('product_code', $productCode)->exists());
        
        return view("backend.product.create",compact('productCode'));
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $product = new Product();
        $product->product_code = $requestData['product_code'];
        $product->name = $requestData['name'];
        $product->brand = $requestData['brand'];
        $product->purchase_date = $requestData['purchase_date'];
        $product->purchase_qty = $requestData['purchase_qty'];
        $product->cost_per_item = $requestData['cost_per_item'];
        $product->total = $requestData['total'];
        $product->vendor_name = $requestData['vendor_name'];
        $product->vendor_address = $requestData['vendor_address'];
        $product->description = $requestData['description'];

        $product->save();
        return redirect()->route('product.index')->with('message', 'Product Created Successfully');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view("backend.product.edit", compact('product'));
    }
    
    public function update(Request $request,$id)
    {
        $requestData = $request->all();
        $product = Product::where('id', $id)->first();
        $product->name = $requestData['name'];
        $product->brand = $requestData['brand'];
        $product->purchase_date = $requestData['purchase_date'];
        $product->purchase_qty = $requestData['purchase_qty'];
        $product->cost_per_item = $requestData['cost_per_item'];
        $product->total = $requestData['total'];
        $product->vendor_name = $requestData['vendor_name'];
        $product->vendor_address = $requestData['vendor_address'];
        $product->description = $requestData['description'];
        $product->update();

        return redirect()->route('product.index')->with('info', 'Product Updated Successfully');
    }

    public function delete(Request $request,$id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect()->route('product.index')->with('error', 'Product Deleted Successfully');
    } 
}
