@extends('admin.layout_backend')
@section('admin')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('admin.filter') }} "method='post'>
                                @csrf
                                <div class="row m-3">
                                    <div class="col-6">
                                        <div class="input-icon mb-3">
                                            <input name="keywork" type="text" class="form-control"
                                                placeholder="search..." value="{{ old('keywork', request()->keywork) }}">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <select class="form-select" name="status" id="">
                                            <option value="">Filter by status</option>
                                            <option value="0"
                                                {{ old('status', request()->status) == '0' ? 'selected' : '' }}>
                                                Chưa xử lý</option>
                                            <option value="1"
                                                {{ old('status', request()->status) == '1' ? 'selected' : '' }}>
                                                Từ chối</option>
                                            <option value="2"
                                                {{ old('status', request()->status) == '2' ? 'selected' : '' }}>
                                                Xác nhận</option>
                                        </select>
                                    </div>
                                    <div class="col-2"> 
                                        <button type="submit" class="btn btn-primary ms-auto  ms-5">Send data</button>
                                    </div>
                                </div>

                                

                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>Người dùng</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Lý do</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($request_leave as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->start_day }}</td>
                                        <td>{{ $item->end_day }}</td>
                                        <td>{{ $item->type_name }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="badge bg-warning text-dark" data-id="{{ $item->id }}">Chưa
                                                    xử lý</span>
                                            @elseif ($item->status == 1)
                                                <span class="badge bg-danger" data-id="{{ $item->id }}">Từ chối</span>
                                            @else
                                                <span class="badge bg-success" data-id="{{ $item->id }}">Đồng ý</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Edit
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><span class="changeStt btn" data-id="{{ $item->id }}"
                                                            data-stt="2">Từ chối</span></li>
                                                    <li><span class="changeStt btn " data-id="{{ $item->id }}"
                                                            data-stt="3">Đồng ý</span></li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of <span>16</span> entries
                        </p>
                        <ul class="pagination m-0 ms-auto">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    prev
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.changeStt').on('click', function() {
                var id = $(this).data('id');
                var stt = $(this).data('stt');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.changeStt') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        stt: stt
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Thay đổi thành công');
                            var statusBadge = $('span[data-id="' + id + '"]');
                            if (stt == 2) {
                                statusBadge.removeClass('bg-success bg-warning').addClass(
                                    'bg-danger').text('Từ chối');
                            } else if (stt == 3) {
                                statusBadge.removeClass('bg-danger bg-warning').addClass(
                                    'bg-success').text('Đồng ý');
                            }
                        } else {
                            alert('Có lỗi xảy ra: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Có lỗi xảy ra: ' + error);
                    }
                });
            });
        });
    </script>
@endsection
