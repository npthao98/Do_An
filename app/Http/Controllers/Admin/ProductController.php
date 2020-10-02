<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductDetail;
use App\Category;
use App\Image;
use App\Order;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('fashi.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('fashi.admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $colors = $request->colors;
        $sizes = $request->sizes;
        $quantities = $request->quantities;
        $data = $request->all();
        $totalQuantity = 0;

        foreach ($quantities as $quantity) {
            $totalQuantity += $quantity;
        }

        $data['in_stock'] = $totalQuantity;

        try {
            $product  = Product::create($data);
            $product->categories()->attach($request->category);

            for ($i = 0; $i < count($colors); $i++){
                ProductDetail::create([
                    'product_id' => $product->id,
                    'size' => $sizes[$i],
                    'color' => $colors[$i],
                    'quantity' => $quantities[$i],
                ]);
            }

            foreach ($request->images as $image) {
                $filename = uniqid() . '-' . $image->getClientOriginalName();
                $image->move(config('image.move_url'), $filename);

                Image::create([
                    'product_id' => $product->id,
                    'link_to_image' => config('image.url') . $filename,
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.product.create.error'));
        }

        return redirect()->route('admin.products.index')->with('message', trans('message.product.create.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('fashi.admin.product.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        try {
            $product->update($request->all());
            $productImage = Image::where('product_id', $product->id)->delete();

            foreach ($request->images as $image) {
                $filename = uniqid() . '-' . $image->getClientOriginalName();
                $image->move(config('image.move_url'), $filename);

                Image::create([
                    'product_id' => $product->id,
                    'link_to_image' => config('image.url') . $filename,
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.product.update.error'));
        }

        return redirect()->route('admin.products.index')->with('message', trans('message.product.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            $product->delete();
            $product->categories()->detach();

            foreach ($product->images as $image) {
                $image->delete();
            }

            foreach ($product->productDetails as $productDetail) {
                $productDetail->delete();
            }
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.product.delete.error'));
        }

        return redirect()->route('admin.products.index')->with('message', trans('message.product.delete.success'));
    }

    public function showOrder()
    {
        $orders = Order::all();

        return view('fashi.admin.order.index', compact('orders'));
    }

    public function orderSuccess($id)
    {
        $order = Order::findOrFail($id);

        try {
            foreach ($order->orderDetails as $orderDetail) {
                $productDetail = $orderDetail->productDetail;
                $product = $productDetail->product;

                $orderDetailQuantity = $orderDetail->quantity;
                $productDetailQuantity = $productDetail->quantity;

                $productDetailInStock = $productDetailQuantity - $orderDetailQuantity;
                $productInStock = $product->in_stock - $orderDetailQuantity;

                if ($productDetailInStock >= 0 || $productInStock >= 0) {
                    $productDetail->update(['quantity' => $productDetailInStock]);
                    $product->update(['in_stock' => $productInStock]);
                } else {
                    toast(trans('message.cart.update.error'), 'error');

                    return back();
                }
            }

            $order->update(['status' => config('order.success')]);

        } catch (Exception $e) {
            Log::error($e);
            toast(trans('message.cart.update.error'), 'error');

            return back();
        }

        toast(trans('message.cart.update.success'), 'success');

        return back();
    }

    public function orderCancel($id)
    {
        $order = Order::findOrFail($id);
        try {
            $order->update(['status' => config('order.cancel')]);
        } catch (Exception $e) {
            Log::error($e);
            toast(trans('message.cart.update.error'), 'error');

            return back();
        }

        toast(trans('message.cart.update.sucess'), 'success');

        return back();
    }

    public function orderPending($id)
    {
        $order = Order::findOrFail($id);

        try {
            $order->update(['status' => config('order.pending')]);
        } catch (Exception $e) {
            Log::error($e);
            toast(trans('message.cart.update.error'), 'error');

            return back();
        }

        toast(trans('message.cart.update.success'), 'success');

        return back();
    }
}
