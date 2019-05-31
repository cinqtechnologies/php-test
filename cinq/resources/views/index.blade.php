@extends('layouts.app')

@section('title', 'CINQ - Products')

@section('content')
<div class="container">
    <div id="row">
        <h1>Products</h1>
    </div>
    <hr />
    <div id="row">
            <table id="tableTarget">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pic</th>
                        <th>Product</th>
                        <th>Retailer</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>
@endsection

@section('javascriptpage')

<script type="text/javascript">

    $(document).ready(function() {

        $('#tableTarget').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products') }}",
            responsive:true,
            columns: [

                { name: 'id', selectable: true },
                { name: 'file_pic', render: function ( data, type, row, meta ) { return '<img src="'+data+'" class="img-thumbnail">'; } },
                { name: 'name', orderable: true, render: function ( data, type, row, meta ) { return '<a href="'+row.DT_RowData.producturl+'" target=_"self">'+data+'</a>'; } },
                { name: 'retailers.name',  orderable: false, render: function ( data, type, row, meta ) { return '<a href="'+row.DT_RowData.retailerurl+'" target=_"self">'+data+'</a>'; } },
                { name: 'description' },
                { name: 'price'
                 , orderable: true
                 , render: $.fn.dataTable.render.number('.',',',2,'R$')
                },
            ]
        });

    });

</script>

@endsection

