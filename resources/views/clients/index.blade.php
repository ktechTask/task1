@extends('admin.layout_backend')
@section('admin')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">

                    <form action="{{ route('client.store') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floating-input"  value="{{ old('title') }}" autocomplete="off">
                            <label for="floating-input">Tiêu đề : </label>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <select name="type_dayoff_id" class="form-select" id="select-users">
                                        <option value="">Lý do nghỉ</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ old('type_dayoff_id') == $type->id ? 'selected' : '' }}>{{ $type->type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_dayoff_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-icon mb-2">
                                    <input class="form-control" type="date" name="start_day" placeholder="Ngày bắt đầu" id="datepicker-icon" value="{{ old('start_day') }}" />
                                    <span class="input-icon-addon">
                                        
                                        
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                    @error('start_day')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-icon mb-2">
                                    <input class="form-control" type="date" name="end_day" placeholder="Ngày kết thúc" id="datepicker-icon" value="{{ old('end_day') }}" />
                                    <span class="input-icon-addon">
                                       
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                    @error('end_day')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 mb-0">
                                    <textarea rows="5" class="form-control" name="reason" placeholder="Lý do chi tiết">{{ old('reason') }}</textarea>
                                    @error('reason')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    
    </div>
    </div>
    </div>
@endsection
