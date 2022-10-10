<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\SubCategoriesResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCats = SubCategory::where('is_special', 0)->get();
        return $this->sendResponse(SubCategoriesResource::collection($subCats), 'success');
    }

    public function comCat($id)
    {
        $cat = Category::find($id);
        if ($cat) {
            $sub = SubCategory::where('cat_id', $id)->where('is_special', 0)->get();
            if (count($sub) > 0) {
                return response()->json([
                    'success' => true,
                    'subcats' => SubCategoriesResource::collection($sub),
                ], 200);
                // return $this->sendResponse(SubCategoriesResource::collection($sub), 'success');
            }else{
                return response()->json([
                    'success' => true,
                    'subcats' => SubCategoriesResource::collection($sub),
                ], 200);
            }

        }else{
            return $this->sendError('there is no Company');
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
