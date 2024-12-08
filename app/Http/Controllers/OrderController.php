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
                $order =  order::get();
                return response()->json(['status' => 'success',  'data' =>$order ], 201); 
            }else{
                return response()->json(['status' => 'error',  'message' =>'Your are not allowed' ], 201); 
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 201);
        }
    }
    public function showSingle( $id )  {
        try {
              $userType = Auth()->user()->user_type;
            if ($userType == "admin"){
                $order = Order::with(['shippingAddress', 'user'])->findOrFail($id); // Fetch the order with its shipping address
               // dd($order);
         return view('orders.show', compact('order'));
            }else{
                return response()->json(['status' => 'error',  'message' =>'Your are not allowed' ], 201); 
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 201);
        }
    }
    //
    function orderWithShippingAddress(){
        try{
            $orders = Order::with('shippingAddress') ->where('user_id', Auth::id()) ->get();
            return response()->json(['status' => 'success', 'data' => $orders], 201);
        }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 201);
        }
    }
    function orderWithShippingAddressToView(){
        try{
            $orders = Order::with('shippingAddress')
        ->where('user_id', Auth::id())
        ->paginate(10);
            
            return view('orders.all-order', compact('orders'));
        }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 201);
        }
    }
    public function userOrderIndex()  {
        try{
            $userType =  $userType = Auth()->user()->user_type;
            $notification =  order::where('user_id', Auth::id())->get();
            return response()->json(['status' => 'success',  'data' =>$notification ], 201); 
        }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 201);
        }
    }
    public function store(Request $request)
    {   
        $shippingAddresses = ShippingAddresse::where('user_id', Auth::id())->get();

       // dd($shippingAddresses);
        $total_amount = $request->input( "total_amount" );
        $status = $request->input('status');
        try{
            $request->validate([
                'total_amount' => 'required|numeric',
                'status' => 'required|string',
            ]); 
    
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => rand(100000, 999999),
                'total_amount' => $total_amount,
                'status' => $status,
                'shipping_address_id' => $shippingAddresses->first()->id,
            ]);
    
            return response()->json(['status' => 'success', 'message' => 'Order created successfully', 'data' => $order], 201);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => $e->getMessage() ], 201);
        }
        
    }
    public function storeAdmin(Request $request)
    {   
        $shippingAddresses = ShippingAddresse::where('user_id', Auth::id())->get();

       // dd($shippingAddresses);
        $total_amount = $request->input( "total_amount" );
        $status = $request->input('status');
        try{
            $request->validate([
                'total_amount' => 'required|numeric',
                'status' => 'required|string',
            ]); 
    
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => rand(100000, 999999),
                'total_amount' => $total_amount,
                'status' => $status,
                'shipping_address_id' => $shippingAddresses->first()->id,
            ]);
    
            return  redirect()->route('dashboard.all-orders')->with('success', 'Order created successfully');
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => $e->getMessage() ], 201);
        }
        
    }
    public function editOrder($id)
    {
        $order = Order::with('shippingAddress')->findOrFail($id); // Fetch the order with its shipping address
        //dd($order);
        return view('orders.update', compact('order'));
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
               // 'status' => 'string',
            ]);
    
            $order = Order::where('user_id', Auth::id())->findOrFail($id);
            $order->update($request->all());
    
            return response()->json(['status' => 'success', 'message' => 'Order updated successfully', 'data' => $order], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => 'Order not found'.$e], 200);
        }
        
    }
    public function adminUpdate(Request $request, $id)
    {   
        try{
            $request->validate([
                'total_amount' => 'numeric',
                'status' => 'string',
            ]);
            
            $shippingAddress = ShippingAddresse::where([
                'user_id' => Auth::id(),
                //'id'      => $id,
            ])->first();
             if($shippingAddress){
                 
                 $shippingAddress->update($request->only(['address_line_1', 'address_line_2', 'city', 'state', 'postal_code', 'country']));
             }
             
    
            $order = Order::where('user_id', Auth::id())->findOrFail($id);
            $order->update($request->all());


            return  redirect()->route('dashboard.all-orders')->with('success', 'Order updated successfully');
           
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => 'Order not found'.$e], 200);
        }
        
    }

    public function destroy($id)
    {   
        try{
            $order = Order::where('user_id', Auth::id())->findOrFail($id);
            $order->delete();
    
            return response()->json(['status' => 'success', 'message' => 'Order deleted successfully'], 201);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => 'Order not found'.$e], 200);
        }   
    }
    public function adminDestroy($id)
    {   
        try{
            $order = Order::where('user_id', Auth::id())->findOrFail($id);
            $order->delete();
    
            return redirect()->route('dashboard.all-orders')->with('success', 'Order deleted successfully.');
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'error' => 'Order not found'.$e], 200);
        }   
    }
}
