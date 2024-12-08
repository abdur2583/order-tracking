<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {   
        $userType = Auth()->user()->user_type;

        return Notification::where('user_id', Auth::id())->get();
    }
    public function adminIndex()  {
        try{
            $userType =  $userType = Auth()->user()->user_type;
            if ($userType == "admin"){
                $notification =  Notification::get();
                return response()->json(['status' => 'success',  'data' =>$notification ], 201); 
            }else{
                return response()->json(['status' => 'error',  'message' =>'Your are not allowed' ], 201); 
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
    //relational view of order based on user
    public function userNotificationIndex()  {
        try{
            $userType =  $userType = Auth()->user()->user_type;
            $notification =  Notification::where('user_id', Auth::id())->get();
            return response()->json(['status' => 'success',  'data' =>$notification ], 201); 
        }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {   
        try{
            $request->validate([
                'type' => 'required|string|max:255',
                'data' => 'required|string',
            ]);
    
            $notification = Notification::create([
                'user_id' => Auth::id(),
                'type' => $request->type,
                'data' => $request->data,
                'read' => false,
            ]);
    
            return response()->json(['status' => 'success', 'message' =>'Notification created successfully ', 'data' =>$notification ], 201); 
        }catch(\Exception $e){
                return response()->json(['status' => 'error', 'error' => 'Notification fail to create'.$e], 201); 
        }
        
    }

    public function show($id)
    {   
        try{
            $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
            return response()->json(['status' => 'success', 'data' =>$notification ], 201); 
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Notification create fail'.$e], 201); 
        }
    }

    public function update(Request $request, $id)
    {   
        try{
            $request->validate([
                'type' => 'required|string|max:255',
                'data' => 'required|string',
                'read' => 'required|boolean',
            ]);
    
            $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
            $notification->update($request->all());

            return response()->json(['status' => 'success', 'message' =>'Notification updated successfully ', 'data' =>$notification ], 201); 
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Notification fail to update'.$e], 201); 
        }
    }

    public function destroy($id)
    {   
        try{
            $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
            $notification->delete();
    
            return response()->json(['status' => 'success', 'message' =>'Notification deleted successfully ', 'data' =>$notification ], 201); 
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Notification delete fail'.$e], 201); 
        }
    }

    public function markAsRead($id)
    {   
        try{
            $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
            $notification->update(['read' => true, 'read_at' => now()]);
    
            return response()->json(['status' => 'success', 'message' =>'Notification marked successfully ', 'data' =>$notification ], 201);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Notification marked fail'.$e], 201); 
        }
    }
}
