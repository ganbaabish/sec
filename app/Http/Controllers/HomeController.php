<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\order;
use App\Models\log;

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

    public function update_ref(Request $request, $column){
        date_default_timezone_set('Asia/Ulaanbaatar');
        $ref = Order::find($request->id);
        $logs->user_id = Auth::user()->id;
        $logs->column=$column;
        $logs->old_data=$ref->$column;
        $logs->new_data=$request->$column;
        Log::create($logs->all());
        $ref->update($request->all());
        return redirec()->back()->with('success', 'Амжилттай засагдлаа');
    }
    public function settings(){
        return view('auth.settings');
    }
}