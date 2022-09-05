<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\AddressesResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();
        return $this->sendResponse(AddressesResource::collection($addresses), 'Addresses Receieved Successfully!');
    }

    public function user_addresses($id)
    {
        $user = User::find($id);
        if (isset($user)) {
            $addresses = Address::where('user_id', $user->id)->get();
            if (Auth::user()->id == $addresses[0]->user_id) {
                return $this->sendResponse(AddressesResource::collection($addresses), 'Addresses Receieved Successfully!');
            }else{
                return $this->sendError('You don\'t have the right to show this addresses');
            }


        } else {
            return $this->sendError('there is no such user!');
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('please Validate error', $validator->errors());
        }

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        Address::create($input);

        return response()->json(['message' => 'Address Added Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);
        if (isset($address)) {
            if ($address->user_id == Auth::user()->id) {
                return $this->sendResponse(new AddressesResource($address), 'found successfully!');
            }else{
                return $this->sendError('You don\'t have the right to show this addresses');
            }
        } else {
            return $this->sendError('There is no address!');
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

        $address = Address::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('please Validate error', $validator->errors());
        }

        if ($address->user_id == Auth::user()->id) {
            $input = $request->all();
            $address->update($input);
            return response()->json(['message' => 'Address updated Successfully!']);
        }else{
            return $this->sendError('you don\'t have the right to edit this address !!!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        if ($address->user_id == Auth::user()->id) {
            $address->delete();
            return response()->json(['message' => 'Address Deleted Successfully!']);
        }else{
            return $this->sendError('you don\'t have the right to delete this address !!!');
        }
    }
}
