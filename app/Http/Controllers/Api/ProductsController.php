<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_special', 0)->get();
        return $this->sendResponse(ProductsResource::collection($products), 'success');
    }

    public function CatProducts($id)
    {
        $sub = SubCategory::find($id);
        if ($sub) {
            $products = Product::where('sub_id', $id)->where('is_special', 0)->get();
            if (count($products) > 0) {
                return $this->sendResponse(ProductsResource::collection($products), 'success');
            } else {
                return $this->sendError('There is no products in this SubCat!');
            }
        } else {
            return $this->sendError('There is no SubCategory');
        }
    }

    public function searchProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError('please Validate error', $validator->errors());
        }

        $search = $request->input('search');

        $products = Product::where('title', 'LIKE', "%{$search}%")->get();

        if (count($products) > 0) {
            return response()->json([
                'success' => true,
                'products' => ProductsResource::collection($products),
                'message' => 'here is your products'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'sorry, there are no products that match your search'
            ], 200);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
