@extends('admin::layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <h2 class="mb-4">Products</h2>
            </div>
            <div class="col-md-8">
                <a href="{{route('product.create')}}" class="btn btn-primary float-right">Create New Product</a>
            </div>
        </div>
        <table class="table table-bordered yajra-datatable" id="products-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Stock Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let datatable;
        $(function () {
             datatable = $('#products-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name', searchable: true},
                    {data: 'description', name: 'description'},
                    {data: 'stock_quantity', name: 'stock_quantity'},
                    {data: 'price', name: 'price'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        function destroyProduct(productId) {
            if (confirm('Are you want to delete this product?')) {
                const url = '{{ route('product.destroy', ['product' => ':product']) }}';
                $.ajax({
                    method: 'DELETE',
                    url: url.replace(':product', productId),
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success: function () {
                        datatable.ajax.reload();
                    }
                });
            }
        }
    </script>
@endsection
