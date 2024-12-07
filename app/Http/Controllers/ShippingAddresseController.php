<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingAddresse;
use Illuminate\Support\Facades\Auth;

class ShippingAddresseController extends Controller
{
    public function index()
    {
        return ShippingAddresse::where('user_id', Auth::id())->get();
    }

    public function adminIndex()  {
        try {
              $userType = Auth()->user()->user_type;
            if ($userType == "admin"){
                $notification =  ShippingAddresse::get();
                return response()->json(['status' => 'success',  'data' =>$notification ], 201); 
            }else{
                return response()->json(['status' => 'error',  'message' =>'Your are not allowed' ], 201); 
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
    //
    public function userShippingIndex()  {
        try{
            $userType =  $userType = Auth()->user()->user_type;
            $notification =  ShippingAddresse::where('user_id', Auth::id())->get();
            return response()->json(['status' => 'success',  'data' =>$notification ], 201); 
        }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try{

            $request->validate([
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'country' => 'required|string|max:255',
            ]);
    
            $ShippingAddress = ShippingAddresse::create([
                'user_id' => Auth::id(),
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]);
    
            return response()->json(['status' => 'success', 'message' => 'Shipping Address created successfully', 'data' => $ShippingAddress], 201);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

        
    }

    public function show($id)
    {
        $ShippingAddress = ShippingAddresse::where('user_id', Auth::id())->findOrFail($id);
        return response()->json(['status' => 'success', 'data' =>$ShippingAddress], 200);
    }

    public function update(Request $request, $id)
    {   
        //dd($request->address_line_1);
        try{
            $request->validate([
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'country' => 'required|string|max:255',
            ]);
    
            $ShippingAddress = ShippingAddresse::where('user_id', Auth::id())->findOrFail($id);
            $ShippingAddress->update($request->all());
    
            return response()->json(['status' => 'success', 'message' => 'Shipping Address updated successfully', 'data' => $ShippingAddress], 201);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function destroy($id)
    {   
        try{
            $ShippingAddresse = ShippingAddresse::where('user_id', Auth::id())->findOrFail($id);
            $ShippingAddresse->delete();
    
            return response()->json(['status' => 'success', 'message' => 'Shipping Address deleted successfully'], 201);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
