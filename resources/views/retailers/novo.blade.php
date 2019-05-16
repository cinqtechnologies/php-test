@extends('tema.layoutBase') @section('conteudo')
<form action="{{route('retail.save')}}" method="POST">
		
	<div class="form-group">
			@csrf
			<div class="col-md-6">
				<div class="row mb-2">
					<div class="col-md-6">
						<label for="inputName">Name</label> <input type="text" value=""
							class="form-control" name="inputName">
					</div>
					<div class="col-md-6">
						<label for="inputLogoPath">Logo Path</label> <input type="text" value=""
							class="form-control" name="inputLogoPath">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="inputDescription">Description</label> <input type="text" value=""
							class="form-control" name="inputDescription">
					</div>
					<div class="col-md-6">
						<label for="inputWebsite">Website</label> <input type="text" value=""
							class="form-control" name="inputWebsite">
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

