
@extends('admin.layout_backend')
@section('admin')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                 
                    <form  action="{{ route('client.store') }}" method="post">
                        @csrf
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floating-input"
                                    value="" name="title" autocomplete="off">
                                <label for="floating-input">Tiêu đề : </label>
                            </div>
                        <div class="row">
                            
                            <div class="col-4">
                                <div class="mb-3">
                                    <select type="text" name='type' class="form-select" id="select-users"
                                        value="">
                                        <option>Lý do nghỉ</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="input-icon mb-2">
                                    <input class="form-control " name="start_date" placeholder="Ngày bắt đầu" id="datepicker-icon"
                                        value="" />
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
                                <div class="input-icon mb-2">
                                    <input class="form-control "  name="end_date" placeholder="Ngày kết thúc" id="datepicker-icon"
                                        value="" />
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
                            <div class="col-12">
                                <div class="mb-3 mb-0">
                                    <textarea rows="5" class="form-control" placeholder="Lý do chi tiết"
                                                      value="Mike"></textarea>
                                  </div>
                            </div>

                        </div>
                        <div class="card-footer text-end mt-3">
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">Send data</button>
                            </div>
                        </div>
                </div>
            </div>
            
        </div>
        </form>
    </div>
    </div>
    </div>
@endsection
