<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Loại nghỉ</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>

            </tr>
        </thead>
        <tbody>


            {{-- {{ dd($history); }} --}}
            @foreach ($history as $item)
            <tr>
                <td>{{ $item->dayoff_type->type_name ? $item->dayoff_type->type_name : 'Unknown' }}</td>
                <td>{{ $item->start_day }}</td>
                <td>{{ $item->end_day }}</td>
                <td>
                    
                    @if ($item->status == 'pending')
                        Chưa xử lý
                    @else
                        {{ $item->status == 'approve' ? 'Đã duyệt' : 'Bị từ chối' }}
                    @endif
                </td>
            </tr>
        @endforeach
        

        </tbody>
    </table>
</body>

</html>
