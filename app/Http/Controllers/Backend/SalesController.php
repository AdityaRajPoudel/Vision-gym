<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::orderby('id', 'Asc')->get();
        return view('backend.sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('backend.sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $sales = new Sales();
        $sales->bill_no = $this->generateBillNumber();
        $sales->sales_date = $request->input('date');
        $sales->discount_percentage = $request->input('discountPer');
        $sales->discount_amount = $request->input('discountAmount');
        $sales->discounted_amount = $request->input('discount_amt');
        $sales->subtotal = $request->input('subtotal');
        $sales->total = $request->input('total');
        $sales->grand_total = $request->input('grandTotal');
        $sales->tender = $request->tender;
        $sales->return = $request->return;
        $sales->due = $request->due;
        $sales->remarks = $request->input('remarks');
        $sales->save();

        $income = new Income();
        $income->sales_date = $request->input('date');
        $income->total_amount = $request->input('grandTotal');
        $income->save();

        $quantityArray = $request->input('quantity');
        $productIdArray = $request->input('product_id');
        $priceArray = $request->input('price');
        $itemTotalArray = $request->input('item_total');

        foreach ($productIdArray as $key => $productId) {
            // dd($productId);
            $salesDetail = new SalesDetail();
            $salesDetail->sales_id = $sales->id;
            $salesDetail->product_id = $productId;
            $salesDetail->quantity = $quantityArray[$key];
            $salesDetail->price = $priceArray[$key];
            $salesDetail->total = $itemTotalArray[$key];
            $salesDetail->save();

            $stock = new Stock();
            $stock->stock_in = $quantityArray[$key];
            $stock->product_id = $productId;
            $stock->stock_out = 0;
            $stock->stock_date = $request->input('date');
            $stock->remarks = $request->input('remarks');
            $stock->save();

            $stock_log = new StockLog();
            $stock_log->product_id = $productId;
            $stock_log->stock_in = $quantityArray[$key];
            $stock_log->stock_out = 0;
            $stock_log->stock_date = $request->input('date');
            $stock_log->save();
        }

        $pay_modes = $request->pay_modes;
        $amt = $request->pay_amount;

        if ($sales) {

            foreach ($pay_modes as $key => $val) {
                $pay_mode = $val;
                $amount = $amt[$key];
                $payment = new Payment();
                $payment->amount = $amount;
                $payment->paymode = $pay_mode;
                $payment->save();
            }
        }

        return redirect()->route('sales.index')->with('message', 'Sales Created Successfully');
    }

    function generateBillNumber()
    {
        // Assuming Sales is your model for sales table
        $latestBill = Sales::latest()->first();

        if ($latestBill) {
            // Extract numeric part from the invoice number
            $numericPart = (int)substr($latestBill->bill_no, 5);
            $nextNumericPart = $numericPart + 1;
            $nextInvoiceNo = 'Bill-' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
        } else {
            // If no previous bill exists, start with '001'
            $nextInvoiceNo = 'Bill-001';
        }

        return $nextInvoiceNo;
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
        $p_array['price'] = $product->first()->selling_price;
        return response()->json($p_array, 200);
    }
}
