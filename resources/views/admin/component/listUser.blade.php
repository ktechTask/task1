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

                    </div>

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>Nhân viên </th>
                                    <th>Email</th>
                                    <th>Tạo đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
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
