<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\order;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct(){$this->middleware('auth');}

    public function index(){
        $usertype = strtolower(Auth::user()->usertype);
        if($usertype=='admin') return app(AdminController::class)->index();
        
        $permissions = json_decode(((DB::select("select permission from permissions where usertype=:usertype", ["usertype"=>$usertype]))[0])->permission);
        
        return view('user.user')->with("data", $permissions);
    }

    public function post_updated_ref(Request $request){
        $ref = Order::find($request->id);
        $ref->update($request->all());
        return redirec()->back()->with('success', 'Амжилттай засагдлаа');
    }
    public function settings(){
        return view('auth.settings');
    }
}