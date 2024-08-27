<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchDateRequest;
use App\Models\User_DayOff;
use App\Repositories\ReppositoryInterface\DayOffTypeRepositoryInterface;
use App\Repositories\ReppositoryInterface\RequestLeaveRepositoryInterface;
use App\Repositories\ReppositoryInterface\User_DayOffRepositoryInterface;
use App\Repositories\ReppositoryInterface\UserRepositoryInterface;
use App\Repositories\User_DayOffRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    protected $dayOffTypeRepository;
    protected $requestLeaveRepository;
    protected $userRepository;

    protected $userDayOffRepository;


    private $types ;
    

    public function __construct(
        DayOffTypeRepositoryInterface $dayOffTypeRepository,
        RequestLeaveRepositoryInterface $requestLeaveRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        User_DayOffRepositoryInterface $userDayOffRepositoryInterface
    ) {
        $this->dayOffTypeRepository = $dayOffTypeRepository;
        $this->requestLeaveRepository = $requestLeaveRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
        $this->userDayOffRepository = $userDayOffRepositoryInterface;
        $this->types = $this->dayOffTypeRepository->getAll();
    }

    public function index(Request $request)
    {
        $title = 'List request for leave';
        $request_leave = $this->getRequestLeave($request);
        $types = $this->types;
        return view('admin.component.dashboard', compact('request_leave', 'types', 'title'));
    }

    public function filter(Request $request)
    {
        $request_leave = $this->getRequestLeave($request);
        $title = 'List request for leave';
        $types = $this->types;
        return view('admin.component.dashboard', compact('request_leave', 'types', 'title'));
    }

    public function changeStt(Request $request)
    {
        $update = $this->requestLeaveRepository->update($request->id,['status' => $request->stt]);
        $user_id = $this->requestLeaveRepository->find($request->id)->pluck('user_id')->first();

        if ($update) {
            $this->storeUserDayOff($request,$user_id);
            return response()->json(['success' => true, 'message' => 'Trạng thái đã được cập nhật.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy yêu cầu hoặc không có thay đổi nào.'], 404);
        }
    }

    public function listUser()
    {
        $title = 'List user';
        $users = $this->userRepository->getUser();
        return view('admin.component.listUser', compact('users', 'title'));
    }

    public function listFilter(SearchDateRequest $request)
    {   
        $title = 'List user';
        $start_day = date('Y-m-d', strtotime($request->start_day));
        $end_day = date('Y-m-d', strtotime($request->end_day));
        $users = $this->userRepository->filter_date($start_day,$end_day);
        return view('admin.component.listUser', compact('users', 'title'));
    }
    public function formRequest($id)
    {
        $title = 'Tạo đơn nghỉ';
        $types = $this->types;
        $user = $this->userRepository->find($id)->first();
        return view('admin.component.formAddRequest', compact('types', 'title', 'user'));
    }
    public function storeRequest(Request $request)
    {
        $check = $this->requestLeaveRepository->create($request->except('token'));
        if ($check) {
            toastr()->success('Đơn nghỉ phép đã được gửi đi');
            return redirect()->route('admin.index');
        } else {
            toastr()->error('Vui lòng thử lại');
            return redirect()->back();
        }
    }
    // public function countDayOff($user_id){
        
    // }

    private function getRequestLeave(Request $request)
    {
        $query = $this->requestLeaveRepository->search($request);;
        return $query;
    }

    private function storeUserDayOff($request,$user_id){
        if($request->stt == 'approve'){
            $order = $this->requestLeaveRepository->find($request->id)->first();
            $sdate = date('Y-m-d', strtotime($order->start_day));
            $edate = date('Y-m-d', strtotime($order->end_day));
            $d_period = CarbonPeriod::create($sdate, $edate);
            foreach ($d_period as $period) {
                $dayOff = new User_DayOff();
                $dayOff->user_id = $user_id;
                $dayOff->day_off = date('Y-m-d', strtotime($period));
                $dayOff->save();
            }
        }
    }
}
