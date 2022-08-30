<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ar');
        $users = User::where('userType', 0)->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'number' => ['required', 'numeric'],
        ]);

        $request['password'] = Hash::make($request['password']);

        $data = $request->all();

        User::create($data);

        return redirect(route('admin.users'))->with('success', 'تم اضافة العضو بنجاح');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'number' => ['required', 'numeric'],
        ]);

        $request['password'] = Hash::make($request['password']);

        $data = $request->all();

        $user->update($data);

        return redirect()->back()->with('success', 'تم تعديل العضو بنجاح');

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect(route('admin.users'))->with('success', 'تم حذف العضو بنجاح');
    }
}
