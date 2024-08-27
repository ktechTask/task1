<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\formRequestForLeave;
use App\Notifications\RequestLeaveNoti;
use App\Repositories\ReppositoryInterface\DayOffTypeRepositoryInterface;
use App\Repositories\ReppositoryInterface\RequestLeaveRepositoryInterface;
use App\Repositories\ReppositoryInterface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ClientController extends Controller
{
    protected $dayOffTypeRepository;
    protected $requestLeaveRepository;
    protected $userRepository;

    private $types ;
    

    public function __construct(
        DayOffTypeRepositoryInterface $dayOffTypeRepository,
        RequestLeaveRepositoryInterface $requestLeaveRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->dayOffTypeRepository = $dayOffTypeRepository;
        $this->requestLeaveRepository = $requestLeaveRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
        $this->types =  $this->dayOffTypeRepository->getAll();
    }
    public function index()
    {
        $types = $this->types;
        return view('clients.index', compact('types'));
    }
    public function profile()
    {
        $user = $this->userRepository->find(Auth::user()->id)->first();
        return view('clients.profile', compact('user'));
    }
    public function myHistory()
    {
        $history = $this->requestLeaveRepository->queryWhereUserId(Auth::user()->id)->get();
        return view('clients.myHistory', compact('history'));
    }
    public function store(formRequestForLeave $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['status'] = 'pending';
        $check = $this->requestLeaveRepository->create($request->except('_token'));
        // Notification::send($admin ,new RequestLeaveNoti($request->user()->name));
        if ($check) {
            toastr()->success('Đơn nghỉ phép đã được gửi đi');
            return redirect()->back();
        } else {
            toastr()->error('Vui lòng thử lại');
            return redirect()->back();
        }
    }

}

