<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $types = DB::table('dayoff_type')->get();
        return view('clients.index', compact('types'));
    }
    public function profile()
    {
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        return view('clients.profile', compact('user'));
    }
    public function myHistory()
    {
        $history = DB::table('request_leave')->where('user_id',Auth::user()->id)->get();
        return view('clients.myHistory', compact('history'));
    }
    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'type_dayoff_id' => $request->type,
            'start_day' => $request->start_date,
            'end_day' => $request->end_date,
            'status' => $request->status
        ];
        $check = DB::table('request_leave')->insert($data);
        if ($check) {
            toastr()->success('Đơn nghỉ phép đã được gửi đi');
            return redirect()->back();
        } else {
            toastr()->error('Vui lòng thử lại');
            return redirect()->back();
        }
    }

}

