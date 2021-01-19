<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductInfor;
use App\Models\Rate;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Image;

class ProductController extends Controller
{
    protected $orderRepo;
    protected $productRepo;
    protected $categoryRepo;
    protected $orderDetailRepo;
    protected $commentRepo;
    protected $imageRepo;

    public function __construct
    (
        OrderRepositoryInterface $orderRepo,
        ProductRepositoryInterface $productRepo,
        CategoryRepositoryInterface $categoryRepo,
        OrderDetailRepositoryInterface $orderDetailRepo,
        ImageRepositoryInterface $imageRepo,
        CommentRepositoryInterface $commentRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->orderDetailRepo = $orderDetailRepo;
        $this->commentRepo = $commentRepo;
        $this->imageRepo = $imageRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        $categories = $this->categoryRepo->findChildrenCategory()->get();

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function newProduct()
    {
        $products = $this->productRepo->orderByCreatedAt();
        $categories = $this->categoryRepo->findChildrenCategory()->get();

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function showProductByCategory($id)
    {
        $categories = $this->categoryRepo->findChildrenCategory()->get();
        $category = $this->categoryRepo->findOneChildrenCategory($id);
        $products = $category->products;

        return view('fashi.user.shop', compact('products', 'categories'));
    }

    public function productDetail(Request $request, $id)
    {
        $rating = false;
        if (Auth::check() && !Auth::user()->employee) {
            $client = new \GuzzleHttp\Client();

            $request = $client->get('http://localhost:5000/recommendations', [
                'query' => ['customer' => Auth::user()->customer->id]
            ]);
            $rate = Rate::where([
                'customer_id' => Auth::user()->customer->id,
                'product_id' => $id,
                'rate' => 0,
            ])->first();

            if ($rate) {
                $rating = true;
            }

            $response = $request->getBody();
            $recommendations = json_decode($response)->data;
        } else {
            $recommendations = Product::take(7)->pluck('id')->toArray();
        }
        if (in_array($id, $recommendations)) {
            unset($recommendations[array_search($id, $recommendations)]);
        }
        $products = Product::whereIn('id', $recommendations)->get();
        $categories = $this->categoryRepo->findChildrenCategory()->get();
        $product = $this->productRepo->find($id);
        $rates = Rate::where('product_id', $product->id)
            ->where('rate' , '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(config('comment.paginate'));
        $cart = session('cart');
        $totalQuantity = 0;
        if (isset($cart)) {
            foreach ($cart as $cartItem) {
                $totalQuantity += $cartItem['quantity'];
            }
        }

        session()->put('totalQuantity', $totalQuantity);

        return view('fashi.user.product', compact(
            'product',
            'categories',
            'rates',
            'products',
            'rating'
        ));
    }

    public function search(Request $request)
    {
        $nameProduct = $request->name;
        $products = $this->productRepo->searchProduct($nameProduct);
        $categories = $this->categoryRepo->findChildrenCategory()->get();

        if ($products->count() === 0) {
            return view('fashi.user.404', compact(['categories']));
        }

        return view('fashi.user.shop', compact(['products', 'categories']));
    }

    public function indexAdmin()
    {
        $products = $this->productRepo->getAll()->SortByDesc('id');

        return view('fashi.admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('fashi.admin.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $colors = $request->colors;
        $sizes = $request->sizes;
        $data = $request->all();
        $data['link_to_image_base'] = uniqid() . '-' . $request['image']->getClientOriginalName();
        $request['image']->move('images', $data['link_to_image_base']);
        $data['rate'] = 0;
        $data['price_import'] = 0;

        try {
            $product  = Product::create($data);

            for ($i = 0; $i < count($colors); $i++){
                ProductInfor::create([
                    'product_id' => $product->id,
                    'size' => $sizes[$i],
                    'color' => $colors[$i],
                    'quantity' => 0,
                ]);
            }

            foreach ($request->images as $image) {
                $filename = uniqid() . '-' . $image->getClientOriginalName();
                $image->move('images', $filename);
                Image::create([
                    'product_id' => $product->id,
                    'link_to_image' => $filename,
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.product.create.error'));
        }

        return redirect()->route('admin.products.index')->with('message', trans('message.product.create.success'));
    }

    public function edit($id)
    {
        $product = $this->productRepo->find($id);
        $categories = $this->categoryRepo->getAll();

        return view('fashi.admin.product.edit', compact(['product', 'categories']));
    }

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

    public function destroy($id)
    {
        $product = Product::find($id);
        try {
            $this->productRepo->delete($id);

            foreach ($product->images as $image) {
                $this->imageRepo->delete($image->id);
            }

            foreach ($product->productInfors as $productInfor) {
                $productInfor->delete();
            }
        } catch (Exception $e) {
            Log::error($e);

            return back()->with('message', trans('message.product.delete.error'));
        }

        return redirect()->route('admin.products.index')->with('message', trans('message.product.delete.success'));
    }
}
