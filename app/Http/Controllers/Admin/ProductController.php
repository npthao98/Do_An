<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;

class ProductController extends Controller
{
    protected $orderRepo;
    protected $productRepo;
    protected $categoryRepo;
    protected $productDetailRepo;
    protected $imageRepo;

    public function __construct
    (
        OrderRepositoryInterface $orderRepo,
        ProductRepositoryInterface $productRepo,
        ProductDetailRepositoryInterface $productDetailRepo,
        ImageRepositoryInterface $imageRepo,
        CategoryRepositoryInterface $categoryRepo
    )
    {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->productDetailRepo = $productDetailRepo;
        $this->imageRepo = $imageRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();

        return view('fashi.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepo->getAll();

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
            $product  = $this->productRepo->create($data);
            $product->categories()->attach($request->category);

            for ($i = 0; $i < count($colors); $i++){
                $this->productDetailRepo->create([
                    'product_id' => $product->id,
                    'size' => $sizes[$i],
                    'color' => $colors[$i],
                    'quantity' => $quantities[$i],
                ]);
            }

            foreach ($request->images as $image) {
                $filename = uniqid() . '-' . $image->getClientOriginalName();
                $image->move(config('image.move_url'), $filename);

                $this->imageRepo->create([
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
        $product = $this->productRepo->find($id);
        $categories = $this->categoryRepo->getAll();

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
        $product = $this->productRepo->find($id);

        try {
            $this->productRepo->update($id, $request->all());
            $productImage = $this->imageRepo->findImageByProduct($product->id)->delete();

            foreach ($request->images as $image) {
                $filename = uniqid() . '-' . $image->getClientOriginalName();
                $image->move(config('image.move_url'), $filename);

                $this->imageRepo->create([
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
        $product = $this->productRepo->find($id);

        try {
            $this->productRepo->delete($id);
            $product->categories()->detach();

            foreach ($product->images as $image) {
                $this->imageRepo->delete($image->id);
            }

            foreach ($product->productDetails as $productDetail) {
                $this->productDetailRepo->delete($productDetail->id);
            }
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.product.delete.error'));
        }

        return redirect()->route('admin.products.index')->with('message', trans('message.product.delete.success'));
    }

    public function showOrder()
    {
        $orders = $this->orderRepo->getAll();

        return view('fashi.admin.order.index', compact('orders'));
    }

    public function orderSuccess($id)
    {
        try {
            $this->orderRepo->updateOrderSuccess($id);
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
        try {
            $this->orderRepo->updateOrderCancel($id);
        } catch (Exception $e) {
            Log::error($e);
            $toast(trans('message.cart.update.error'), 'error');

            return back();
        }

        toast(trans('message.cart.update.success'), 'success');

        return back();
    }

    public function orderPending($id)
    {
        try {
            $this->orderRepo->updateOrderPending($id);
        } catch (Exception $e) {
            Log::error($e);
            toast(trans('message.cart.update.error'), 'error');

            return back();
        }

        toast(trans('message.cart.update.success'), 'success');

        return back();
    }
}
