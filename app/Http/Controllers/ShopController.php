<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
 
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
    
}


