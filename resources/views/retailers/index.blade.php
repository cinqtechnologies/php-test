@extends('tema.layoutBase')
@section('conteudo')
<div class="col-md-12">
<!-- DataTables Example -->
<div class="card mb-3">
<div class="form-group">
<div class="col-md-12 mt-3">
<a href="{{route('retail.new')}}" class="btn btn-success">New Retailer</a>
<!--           		<button class="btn btn-primary">Novo</button> -->
</div>
</div>
</div>
<div class="card mb-3">
<div class="card-header">
<i class="fas fa-table"></i>
Products</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead class="thead-dark">
<tr>
<th class="text-center">#</th>
<th class="text-center">Name</th>
<th class="text-center">Logo</th>
<th class="text-center">Website</th>
<th class="text-center">Action</th>
</tr>
</thead>
					<tbody>
						@if(isset($retailer)) 
						@if(count($retailer) > 0) 
						@foreach($retailer as $retail)
						<tr>
							<td class="text-center">{{$retail->id}}</td>
							<td class="text-center">{{$retail->Name}}</td>
							<td class="text-center"><i class="fas fa-image"></i></td>
							<td class="text-center">{{$retail->Website}}</td>							
							<td class="text-center"><a class="btn btn-warning"
								style="color: white;"
								href="{{route('retail.editScreen', ['id' => $retail->id])}}">Editar</a>
								<a class="btn btn-danger" style="color: white;"
								href="{{route('retail.delete', ['id' => $retail->id])}}">Excluir</a>
							</td>
						</tr>
						@endforeach @else
						<td colspan="6" class="text-center">Nada para Exibir!</td> 
						@endif
						@else
						<td colspan="7" class="text-center">Nada para Exibir!</td> 
						@endif
					</tbody>
					<tfoot class="thead-dark">
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Logo</th>
                    <th class="text-center">Website</th>
                    <th class="text-center">Action</th>  
                  </tr>
                </tfoot>
                <tbody>
                	                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
	</div>
@endsection