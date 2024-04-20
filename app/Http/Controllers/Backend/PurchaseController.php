<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases=Purchase::orderby('id','Asc')->get();
        return view('backend.purchase.index',compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();
        return view('backend.purchase.create', compact('products'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $purchase = new Purchase();
        $purchase->invoice_no = $this->generateInvoiceNumber();
        $purchase->purchase_date = $request->input('date');
        $purchase->discount_percentage = $request->input('discountPer');
        $purchase->discount_amount = $request->input('discountAmount');
        $purchase->discounted_amount = $request->input('discount_amt');
        $purchase->subtotal = $request->input('subtotal');
        $purchase->total = $request->input('total');
        $purchase->grand_total = $request->input('grandTotal');
        $purchase->remarks = $request->input('remarks');
        $purchase->save();

        $expense=new Expense();
        $expense->purchase_date=$request->input('date');
        $expense->total_amount=$request->input('grandTotal');
        $expense->save();

        $quantityArray = $request->input('quantity');
        $productIdArray = $request->input('product_id');
        $priceArray = $request->input('price');
        $itemTotalArray = $request->input('item_total');

        foreach ($productIdArray as $key => $productId) {
            // dd($productId);
            $purchaseDetail = new PurchaseDetail();
            $purchaseDetail->purchase_id = $purchase->id;
            $purchaseDetail->product_id = $productId;
            $purchaseDetail->quantity = $quantityArray[$key];
            $purchaseDetail->price = $priceArray[$key];
            $purchaseDetail->total = $itemTotalArray[$key];
            $purchaseDetail->save();

            $stock=new Stock();
            $stock->stock_in=$quantityArray[$key];
            $stock->product_id=$productId;
            $stock->stock_out=0;
            $stock->stock_date=$request->input('date');
            $stock->remarks=$request->input('remarks');
            $stock->save();

            $stock_log=new StockLog();
            $stock_log->product_id=$productId;
            $stock_log->stock_in=$quantityArray[$key];
            $stock_log->stock_out=0;
            $stock_log->stock_date=$request->input('date');
            $stock_log->save();

        }

        return redirect()->route('purchase.index')->with('message', 'Purchase Created Successfully');
    }

    function generateInvoiceNumber() {
        $latestInvoice = Purchase::latest()->first();
    
        if ($latestInvoice) {
            // Extract the numeric part of the invoice number and increment it
            $numericPart = (int) substr($latestInvoice->invoice_no, 4); // Extract digits after "INV-"
            $nextNumericPart = $numericPart + 1;
            $invoiceNumber = 'INV-' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
        } else {
            // If no previous invoices exist, start with INV-001
            $invoiceNumber = 'INV-001';
        }
    
        return $invoiceNumber;
    }
    public function autocomplete(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $products = Product::where('name', 'like', '%' . $searchTerm . '%')
            ->orwhere('product_code', 'like', '%' . $searchTerm . '%')
            ->orderBy('name', 'ASC')
            ->get();

        $jsonData = [];

        foreach ($products as $product) {
            $jsonData[] = [
                'name' => $product->name,
                'id' => $product->id,
            ];
        }
        return response()->json($jsonData);
    }

    public function getProduct(Request $request)
    {
        $id = $request->input('id');
        $p_array = [];
        $product = Product::orderBy('name')->find($id);
        $p_array['price'] = $product->first()->cost_price;
        return response()->json($p_array, 200);
    }
}
