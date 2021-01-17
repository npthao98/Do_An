<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use App\Models\Import;
use App\Models\ItemImport;
use App\Models\Product;
use App\Models\ProductInfor;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function index()
    {
        $imports = Import::with([
            'supplier',
            'itemImports',
            'employee',
        ])->get()->sortByDesc('date');

        return view('fashi.admin.import.index', compact('imports'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::with('productInfors')->get();

        return view('fashi.admin.import.create', compact(
            'suppliers',
            'products'
        ));
    }

    public function store(ImportRequest $request)
    {
        for ($i = 0; $i < sizeof($request['productId']); $i++) {
            $product = Product::find($request['productId'][$i]);
            $price_sale = $product->price_sale > $request['priceImport'][$i] ? $product->price_sale : $request['priceImport'][$i] + 50000;
            $product->update([
                'price_sale' => $price_sale,
                'price_import' => $request['priceImport'][$i],
            ]);
        }
        $total_price = 0;
        for ($i = 0; $i < sizeof($request['productInforId']); $i++) {
            $productInfor = ProductInfor::find($request['productInforId'][$i]);
            $product = $productInfor->product;
            $total_price += $product->price_import * $request['numberImport'][$i];
            $productInfor->update([
                'quantity' => $productInfor->quantity + $request['numberImport'][$i],
            ]);
        }
        $import = Import::create([
            'employee_id' => Auth::user()->employee->id,
            'supplier_id' => $request['supplier_id'],
            'date' => Carbon::now()->format('Y-m-d H-i-s'),
            'total_price' => $total_price,
        ]);
        for ($i = 0; $i < sizeof($request['productInforId']); $i++) {
            $productInfor = ProductInfor::find($request['productInforId'][$i]);
            $product = $productInfor->product;
            ItemImport::create([
                'quantity' => $request['numberImport'][$i],
                'price_import' => $product->price_import,
                'product_infor_id' => $request['productInforId'][$i],
                'import_id' => $import->id,
            ]);
        }

        return redirect()->route('admin.imports.index')
            ->with('message', trans('message.import.create.success'));
    }

    public function storeSupplier(Request $request)
    {
        Supplier::create($request->all());

        return back()->with('message', trans('message.supplier.create.success'));
    }
}
