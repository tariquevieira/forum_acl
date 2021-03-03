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
			<div class="form-group">
				<label>Escolha um canal para Tópico</label>
				<select name="channel_id"  class="form-control @error('channel_id') is-invalid @enderror">
					<option value=""> Selecione um canal</option>
					@foreach($channels as $channel)
					<option value="{{$channel->id}}" @if(old('channel_id')==$channel->id)selected @endif >{{$channel->name}}</option>

					@endforeach
					@error('channel_id')
					<div class="invalid-feedback">
						{{$message}}
					</div>
					@enderror
				</select>
			</div>
			<div class="form-group">
				<label >Título do Tópico</label>
				<input type="text" name="title"  class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
				@error('title')
				<div class="invalid-feedback">
					{{$message}}
				</div>
				@enderror
			</div>
			<div class="form-group">
				<label >Conteúdo do Tópico</label>
				<textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{old('body')}}</textarea>
				@error('body')
				<div class="invalid-feedback">
					{{$message}}
				</div>
				@enderror
			</div>
			<button class="btn btn-success">Criar Tópico</button>
		</form>
	</div>
</div>
<hr>
@endsection