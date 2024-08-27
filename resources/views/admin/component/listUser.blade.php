@extends('admin.layout_backend')
@section('admin')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                   <form action="{{ route('admin.listFilter') }}" method="post">
                    @csrf


                    <div class="row">
                    <div class="col-2">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                    </div>
                    
                        <div class="col-4 pt-2">
                            <div class="input-icon mb-2">
                                <input class="form-control" type="date" name="start_day" placeholder="Ngày bắt đầu" id="datepicker-icon"
       value="{{ old('start_day', request('start_day')) }}" />

                                <span
                                    class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="input-icon pt-2">
                                <input class="form-control " type="date"  name="end_day" placeholder="Ngày kết thúc" id="datepicker-icon"
                                value="{{ old('end', request('end_day')) }}"  />
                                <span
                                    class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="col-2 pt-2">
                            <button type="submit" class="btn btn-primary ms-auto  ms-5">Send data</button>
                        </div>
                    </div>
                </div></form>

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>Nhân viên </th>
                                    <th>Email</th>
                                    <th>Tổng ngày nghỉ</th>
                                    <th>Tạo đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->user_day_off_count }}</td>
                                        <td><a href="{{ route('admin.formRequest', $user->id) }}">Tạo đơn</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
 
@endsection
