@extends('layouts.app')

@section('title', 'CINQ - Retailers')

@section('content')

<div class="container">
    <div id="row">
    <h1>Retailer - {{ $retailer->name }}</h1>
    </div>
    <hr />
    <div class="row">
            <div class="col-sm-6 col-md-6 col-xs-12 image-container">
                <img src="{{ config('filesystems.disks.public.retailers') }}/{{ $retailer->file_pic }}" class="card-img-top img-thumbnail" alt="">
            </div>
            <div class="col-sm-6 col-md-6 col-xs-12">
                <p class="card-text">{{ $retailer->name }}</p>
                <p class="card-text">{{ $retailer->description }}</p>
                <p class="card-text"><a href="{{ $retailer->website }}" target="_blank">Website</a></p>
            </div>
    </div>
    <hr />
    <div id="row">
            <table id="tableTarget">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
     </div>
     <hr />
     <div class="row">
            <a href="/" role="button" class="btn btn-primary btn-lg">
                Voltar
            </a>
        </div>
</div>
@endsection

@section('javascriptpage')

<script type="text/javascript">

$(document).ready(function() {

    $('#tableTarget').DataTable({
        ajax: {
                url: "{{ route('retailer.products', ['id' => $retailer->id]) }}",
                dataSrc: ""
        },
        responsive:true,
        columns: [
            { targets: 0, data: 'id' },
            { targets: 1, data: 'file_pic', render: function ( data, type, row, meta ) { return '<img src="/storage/images/products/'+data+'" class="img-thumbnail">'; } },
            { targets: 2, data: 'name' },
            { targets: 3, data: 'description' },
            { targets: 4, data: 'price', render: $.fn.dataTable.render.number('.',',',2,'R$')}
           ],
        "autoWidth": false
    });

});

</script>

@endsection
