@extends('tema.layoutBase') @section('conteudo')
<form action="{{route('prod.save')}}" method="POST">
		
	<div class="form-group">
			@csrf
			<div class="col-md-6">
				<div class="row mb-2">
					<div class="col-md-8">
						<label for="inputName">Name</label> <input type="text" value=""
							class="form-control" name="inputName">
					</div>
					<div class="col-md-4">
						<label for="inputPrice">Price</label> <input type="text" value=""
							class="form-control" name="inputPrice">
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="inputImagePath">Image Path</label> <input type="text" value=""
							class="form-control" name="inputImagePath">
					</div>
					<div class="col-md-8">
						<label for="inputDescription">Description</label> <input type="text" value=""
							class="form-control" name="inputDescription">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="selectRetailer">Retailer</label> <select
							class="form-control" id="selectRetailer" name="selectRetailer">
							@foreach($retailer as $ret)
								<option value="{{$ret->id}}">{{$ret->Name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3 mt-3">
					<input type="submit" class="btn btn-primary" name="btnEnviar" value="ENVIAR"></input>
				</div>
			</div>
	</div>

</form>
@endsection
