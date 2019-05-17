@extends('tema.layoutBase')
@section('conteudo')
	<div class="col-md-12" id="pagecont">
		<!-- DataTables Example -->
		<div class="card mb-3">
          	<div class="form-group">
          	<div class="col-md-12 mt-3">
          		<a href="{{route('prod.new')}}" class="btn btn-success">New Product</a>
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
                    <th class="text-center">Price</th>
                    <th class="text-center">Image</th>                    
                    <th class="text-center">Description</th>                    
                    <th class="text-center">Retailer</th>                    
                    <th class="text-center">Last Update</th>                    
                    <th class="text-center">Action</th>                    
                  </tr>
                </thead>
                <tbody>
                	@if(isset($products))
                		@if(count($products) > 0)
                        	@foreach ($products as $prod)
                              <tr>
                                <td class="text-center">{{$prod->id}}</td>
                                <td class="text-center">{{$prod->Name}}</td>
                                <td class="text-center"><?=str_replace('.', ',', $prod->Price)?></td>
                                <td class="text-center"><a href="/imagens/productImages/{{$prod->ImagePath}}" class="preview"><i class="fas fa-image"></i></a></td>
                                <td class="text-center">{{$prod->Description}}</td>
                                <td class="text-center">{{$prod->retailer->Name}}</td>
                                @if($prod->updated_at != null)
                                <td class="text-center">{{$prod->updated_at}}</td>
                                @else
                                <td class="text-center">-</td>
                                @endif
                                <td class="text-center">
                                <a class="btn btn-warning" style="color:white;" href="{{route('prod.editScreen', ['id' => $prod->id])}}">Edit</a>
                                <a class="btn btn-danger" style="color:white;" href="{{route('prod.delete', ['id' => $prod->id])}}">Delete</a>
                                </td>
                              </tr>
                          	@endforeach
                        @else
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
                    <th class="text-center">Price</th>
                    <th class="text-center">Image</th>                    
                    <th class="text-center">Description</th>                    
                    <th class="text-center">Retailer</th>                    
                    <th class="text-center">Last Update</th>
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