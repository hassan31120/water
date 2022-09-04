<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('ar');
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
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
            'image' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'admin/images/categories/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image'] = $filename;
        }

        Category::create($data);

        return redirect(route('admin.categories'))->with('success', 'تم اضافة الشركة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Carbon::setLocale('ar');
        $category = Category::find($id);
        $subs = SubCategory::where('cat_id', $id)->first();
        return view('admin.categories.show', compact('category', 'subs'));

    }

    public function showCat($id)
    {
        Carbon::setLocale('ar');
        $sub = SubCategory::find($id);
        if ($sub) {
            $category = Category::where('id', $sub->cat_id)->first();
            return view('admin.categories.showCat', compact('sub', 'category'));
        }else{
            return view('admin.categories.showCat', compact('sub'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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
        $category = Category::find($id);
        $request->validate([
            'title' => 'required',
            'image' => 'required'
        ]);

        $data = $request->except(['old-image']);

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filepath = 'admin/images/categories/'.date('Y').'/'.date('m').'/';
            $filename =$filepath.time().'-'.$file->getClientOriginalName();
            $file->move($filepath, $filename);
            if(request('old-image')){
                $oldpath=request('old-image');
                if(File::exists($oldpath)){
                    unlink($oldpath);
                }

            }
          $data['image'] = $filename;
        }

        $category->update($data);

        return redirect()->back()->with('success', 'تم تعديل الشركة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect(route('admin.categories'))->with('success', 'تم حذف الشركة بنجاح');
    }
}
