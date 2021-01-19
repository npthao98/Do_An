<?php

namespace App\Http\Controllers;

use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Repositories\Order\OrderRepositoryInterface;

class HomeController extends Controller
{
    protected $categoryRepo;
    protected $orderRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo, OrderRepositoryInterface $orderRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        if (Auth::check() && Auth::user()->employee) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::check() && !Auth::user()->employee) {
            $client = new \GuzzleHttp\Client();

            $request = $client->get('http://localhost:5000/recommendations', [
                'query' => ['customer' => Auth::user()->customer->id]
            ]);
            $response = $request->getBody();
            $recommendations = json_decode($response)->data;
        } else {
            $recommendations = Product::take(7)->pluck('id')->toArray();
        }
        $products = Product::whereIn('id', $recommendations)->get();
        $categories = $this->categoryRepo->findChildrenCategory()->orderBy('created_at')->limit(config('category.limit'))->get();
        $categoryFirst = $categories->first();
        $categorySecond = $categories->skip(config('category.skip'))->first();

        return view('fashi.user.index', compact(
            'categories',
            'categoryFirst',
            'categorySecond',
            'products'
        ));

    }

    public function changeLanguage($language)
    {
        session()->put('website_language', $language);

        return redirect()->back();
    }

    public function getDistrictByCity($city)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://localhost:5000/districts', [
            'query' => ['province' => $city]
        ]);
        $response = $request->getBody();
        $districts = json_decode($response)->data;
        return $districts;
    }

    public function indexAdmin(Request $request)
    {
        if ($request->ajax()) {
            $dataTitle = [
                trans('text.revenue'),
            ];

            $dataStatisticalInMonth = array();
            $dataMonths = [
                trans('text.jan'),
                trans('text.feb'),
                trans('text.mar'),
                trans('text.apr'),
                trans('text.may'),
                trans('text.june'),
                trans('text.july'),
                trans('text.aug'),
                trans('text.sep'),
                trans('text.oct'),
                trans('text.nov'),
                trans('text.dec'),
            ];

            for ($i = 1; $i <= config('order.month_in_year'); $i++) {

                $statistical = $this->orderRepo->getStatisticalByMonth($i);

                array_push($dataStatisticalInMonth, $statistical);
            }

            $data = [
                $dataTitle,
                $dataMonths,
                $dataStatisticalInMonth,
            ];

            return response()->json($data, 200);
        }

        return view('fashi.admin.dashboard');
    }
}
