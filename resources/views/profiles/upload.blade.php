@extends('layouts.app')

@section('content')


	<div class="flash">
		@include('messages.flash')
	</div>


	<h1>Upload your Business / Company Photo</h1>

	<hr>

	<div class="row">
		<form method="post" action="/upload" enctype="multipart/form-data" class="col-md-6">

			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

			
			@include('profiles.upload_form')


		</form>
	</div>
@stop