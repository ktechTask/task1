<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        $title = 'List request for leave';
        $request_leave = $this->getRequestLeave($request);
        $types = DB::table('dayoff_type')->get();
        return view('admin.component.dashboard', compact('request_leave', 'types', 'title'));
    }

    public function filter(Request $request)
    {
        $request_leave = $this->getRequestLeave($request);
        $title = 'List request for leave';
        $types = DB::table('dayoff_type')->get();
        return view('admin.component.dashboard', compact('request_leave', 'types', 'title'));
    }

    public function changeStt(Request $request)
    {
        $updated = DB::table('request_leave')
            ->where('id', $request->id)
            ->update(['status' => $request->stt]);

        if ($updated) {
            return response()->json(['success' => true, 'message' => 'Trạng thái đã được cập nhật.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy yêu cầu hoặc không có thay đổi nào.'], 404);
        }
    }

    public function listUser()
    {
        $title = 'List user';
        $users = DB::table('users')->get();
        return view('admin.component.listUser', compact('users', 'title'));
    }

    public function formRequest($id)
    {
        $title = 'Tạo đơn nghỉ';
        $types = DB::table('dayoff_type')->get();
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.component.formAddRequest', compact('types', 'title', 'user'));
    }
    public function storeRequest(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'type_dayoff_id' => $request->type,
            'start_day' => $request->start_date,
            'end_day' => $request->end_date,
            'status' => 2
        ];

        $check = DB::table('request_leave')->insert($data);
        if ($check) {
            toastr()->success('Đơn nghỉ phép đã được gửi đi');
            return redirect()->route('admin.index');
        } else {
            toastr()->error('Vui lòng thử lại');
            return redirect()->back();
        }
    }

    private function getRequestLeave(Request $request)
    {
        $query = DB::table('request_leave')
            ->join('dayoff_type', 'request_leave.type_dayoff_id', '=', 'dayoff_type.id')
            ->join('users', 'request_leave.user_id', '=', 'users.id')
            ->select('request_leave.*', 'dayoff_type.type_name', 'users.name');


        if (!empty($request->keywork)) {
            $query->where('users.name', $request->keywork);
        }

        if (isset($request->status) && $request->status != '') {
            $query->where('request_leave.status', $request->status);
        }

        return $query->get();
    }
}
