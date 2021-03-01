@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<h2>Criar Tópico</h2>
		<hr>
	</div>
	<div class="col-12">
		<form action="{{route('threads.store')}}" method="post">
			@csrf
			@method('POST')
			<div class="form-group">
				<label >Conteúdo do Tópico</label>
				<input type="text" name="title"  class="form-control">
			</div>
			<div class="form-group">
				<label >Contegudo do Tópico</label>
				<textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
			</div>
			<button class="btn btn-success">Criar Tópico</button>
		</form>
	</div>
</div>
<hr>
@endsection