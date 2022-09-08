<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\MasajedResource;
use App\Http\Resources\ZamzamResource;
use App\Models\Masajed;
use App\Models\Zamzam;
use Illuminate\Http\Request;

class ZamzamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Zamzam::all();
        $products2 = Masajed::all();

        // return response()->json([
        //     'zamzam' => ZamzamResource::collection($products),
        //     'Masajed' => MasajedResource::collection($products2)
        // ], 200);

        // return $this->specialResponse([]);

        return response()->json(
            [
                [
                    'title' => 'zamzam',
                    'description' => 'عروض خاصة لمياة زمزم',
                    'data' => ZamzamResource::collection($products)
                ],
                [
                    'title' => 'masajed',
                    'description' => 'عروض خاصة لمياة المساجد',
                    'data' => MasajedResource::collection($products2)
                ]
            ],
            200
        );
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
