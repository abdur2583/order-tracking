<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
   public function index()
    {
        if(Auth::id()){
            
            $userType = Auth()->user()->user_type;
            if($userType == 'user'){
                return redirect('/');
            }
            else if($userType == 'admin'){
                return redirect('/dashboard.all-orders');
            }else {
                return redirect()->back();
            }
        }
        
    }
}
