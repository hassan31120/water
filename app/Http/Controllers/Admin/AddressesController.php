<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AddressesController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ar');
        $addresses = Address::all();
        return view('admin.addresses.index', compact('addresses'));
    }

    public function create()
    {
        $users = User::where('userType', 0)->get();
        return view('admin.addresses.add', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'name' => 'required',
            'number' => 'required|numeric',
            'user_id' => 'required'
        ]);

        $data = $request->all();

        Address::create($data);

        return redirect(route('admin.addresses'))->with('success', 'تم اضافة العنوان بنجاح');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $address = Address::find($id);
        $users = User::where('userType', 0)->get();
        return view('admin.addresses.edit', compact('address', 'users'));
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'name' => 'required',
            'number' => 'required|numeric',
            'user_id' => 'required'
        ]);

        $data = $request->all();

        $address->update($data);

        return redirect()->back()->with('success', 'تم تعديل العنوان بنجاح');

    }

    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();
        return redirect(route('admin.addresses'))->with('success', 'تم حذف العنوان بنجاح');
    }
}
