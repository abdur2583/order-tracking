<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ShippingAddresse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return Order::where('user_id', Auth::id())->get();
    }
   
    public function adminIndex()  {
        try {
              $userType = Auth()->user()->user_type;
            if ($userType == "admin"){
                $notification =  order::get();
                return response()->json(['status' => 'success',  'data' =>$notification ], 201); 
            }else{
                return response()->json(['status' => 'error',  'message' =>'Your are not allowed' ], 201); 
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
    //
    public function userOrderIndex()  {
        try{
            $userType =  $userType = Auth()->user()->user_type;
            $notification =  order::where('user_id', Auth::id())->get();
            return response()->json(['status' => 'success',  'data' =>$notification ], 201); 
        }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {   
        $shippingAddresses = ShippingAddresse::where('user_id', Auth::id())->get();

       // dd($shippingAddresses);

        try{
            $request->validate([
                'total_amount' => 'required|numeric',
                'status' => 'required|string',
            ]); 
    
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => rand(100000, 999999),
                'total_amount' => $request->total_amount,
                'status' => $request->status,
                'shipping_address_id' => $shippingAddresses->first()->id,
            ]);
    
            return response()->json(['status' => 'success', 'message' => 'Order created successfully', 'data' => $order], 201);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 500);
        }
        
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {   
        try{
            $request->validate([
                'total_amount' => 'numeric',
                'status' => 'string',
            ]);
    
            $order = Order::where('user_id', Auth::id())->findOrFail($id);
            $order->update($request->all());
    
            return response()->json(['status' => 'success', 'message' => 'Order updated successfully', 'data' => $order], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => 'Order not found'.$e], 404);
        }
        
    }

    public function destroy($id)
    {   
        try{
            $order = Order::where('user_id', Auth::id())->findOrFail($id);
            $order->delete();
    
            return response()->json(['status' => 'success', 'message' => 'Order deleted successfully'], 201);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => 'Order not found'.$e], 404);
        }   
    }
}
