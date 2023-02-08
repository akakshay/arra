<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api');
    }
 
    public function index()
    {
        return Shop::all();
    }
    
    public function show($id)
    {
        return Shop::find($id);
    }

    public function store(Request $request)
    {
    //dd($request);
        return Shop::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = Shop::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Shop::findOrFail($id);
        $article->delete();

        return 204;
    }

    public function getShops(Request $request)
    {
        $getshops = Shop::where(['pincode' => auth()->user()->pincode])->get()->toArray();
        return response()->json([
            'success' => true,
            'data' => $getshops
        ], 200);
    }

    public function getReviews(Request $request, $shop)
    {
        $getReviews = DB::table('shop_reviews')->where(['shop_id' => $shop])->get()->toArray();
        return response()->json([
            'success' => true,
            'data' => $getReviews
        ], 200);
    }

    public function postShopReview(Request $request, $shop)
    {

        $shopData = Shop::find($shop);
        if($shopData){
            $validator = Validator::make($request->all(), [
                'rating' => 'required|integer',
                'comment' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 500);
            }
            $input = $validator->validated();
            $input['shop_id'] = $shop;
            $input['user_id'] = auth()->user()->id;
            $input['updated_at'] = DB::raw('CURRENT_TIMESTAMP');
            $input['created_at'] = DB::raw('CURRENT_TIMESTAMP');
            $shopRating = DB::table('shop_reviews')->insert($input);
            return response()->json([
                'success' => false,
                'data' => 'Review submitted successfully'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Shop not found'
        ], 500);
    }
    
}


