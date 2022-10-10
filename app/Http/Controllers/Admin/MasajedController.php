<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masajed;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class MasajedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('ar');
        $products = Product::where('is_special', 2)->get();
        return view('admin.masajed.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.masajed.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'image' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
        ]);

        $data = $request->all();
        $data['is_special'] = 2;
        $data['sub_id'] = 8;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/images/masajed/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect(route('admin.masajed'))->with('success', 'تم إضافة المنتج بنجاح');
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
        $product = Product::find($id);
        return view('admin.masajed.edit', compact('product'));
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
        $product = Product::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/images/masajed/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            if (request('old-image')) {
                $oldpath = request('old-image');
                if (File::exists($oldpath)) {
                    unlink($oldpath);
                }
            }
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->back()->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('admin.masajed'))->with('success', 'تم حذف المنتج بنجاح');
    }
}
