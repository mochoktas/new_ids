@extends('Layouts/main')
@section('title_page','coin')
@section('title','coin')
@section('content')
<table class="table table-bordered" id="coins-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Market Cap</th>
            <th>24h Volume</th>
        </tr>
    </thead>
</table>
@endsection
@section('css_custom')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
@endsection
@section('js_custom')
<script type="text/javascript">
    $(function() {
        $('#coins-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('get.trend') }}",
            columns: [{
                    data: 'item.id',
                    name: 'id'
                },
                {
                    data: 'item.name',
                    name: 'name'
                },
                {
                    data: 'item.data.price',
                    name: 'price'
                },
                {
                    data: 'item.data.market_cap',
                    name: 'market_cap'
                },
                {
                    data: 'item.data.total_volume',
                    name: 'total_volume'
                }
            ]
        });
    });
</script>
@endsection