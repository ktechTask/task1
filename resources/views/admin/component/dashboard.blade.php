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
                                            <option value="pending"
                                                {{ old('status', request()->status) == 'pending' ? 'selected' : '' }}>
                                                Chưa xử lý</option>
                                            <option value="deject"
                                                {{ old('status', request()->status) == '' ? 'deject' : '' }}>
                                                Từ chối</option>
                                            <option value="approve"
                                                {{ old('status', request()->status) == 'approve' ? 'selected' : '' }}>
                                                Xác nhận</option>
                                        </select>
                                    </div>
                                    <div class="col-2"> 
                                        
                                        
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
                                            @if ($item->status == 'pending')
                                                <span class="badge bg-warning text-dark" data-id-show="{{ $item->id }}">Chưa
                                                    xử lý</span>
                                            @elseif ($item->status == 'deject')
                                                <span class="badge bg-danger" data-id-show="{{ $item->id }}">Từ chối</span>
                                            @else
                                                <span class="badge bg-success" data-id-show="{{ $item->id }}">Đồng ý</span>
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
                                                            data-stt="deject">Từ chối</span></li>
                                                    <li><span class="changeStt btn " data-id="{{ $item->id }}"
                                                            data-stt="approve">Đồng ý</span></li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                            var statusBadge = $('span[data-id-show="' + id + '"]');
                            if (stt == 'deject') {
                                statusBadge.removeClass('bg-success bg-warning').addClass(
                                    'bg-danger').text('Từ chối');
                            } else if (stt == 'approve') {
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
