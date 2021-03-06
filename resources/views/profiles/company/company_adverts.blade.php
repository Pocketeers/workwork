@extends('layouts.app')
@section('content')
<h2>Adverts</h2>

<hr>

<div class="row">
	<div class="col-sm-8">
		@forelse($myAdverts as $myAdvert)
			<div class="panel panel-default">
				<div class="panel-body">
					@if($myAdvert->plan_ends_at != null)
	                    <a href="/choose/plan/{{ $myAdvert->id }}" class="btn btn-default btn-xs">Extend Post</a>
	                @endif
					@if($myAdvert->published != 0)
						<h5><span class="label label-success label">PUBLISHED</span></h5>
					@else
						<h5><span class="label label-warning">UNPUBLISHED</span></h5>
					@endif
					<a href="/adverts/{{ $myAdvert->id }}/{{ strtolower($myAdvert->job_title) }}">
						<h4>{{ $myAdvert->job_title }}</h4>
					</a>
					<a href="/adverts/{{ $myAdvert->id }}/{{ strtolower($myAdvert->job_title) }}/edit" class="btn btn-default">Edit</a>
					<a href="/adverts/{{ $myAdvert->id }}/{{ strtolower($myAdvert->job_title) }}" class="btn btn-default">Preview</a>
		            <a href="/advert/{{ $myAdvert->id }}/job/requests/pending" class="btn btn-default">View Job Requests </a>
		            @if(count($myAdvert->applications->where('responded', 0)) > 0)
	            		<span class="badge">
	            			{{ count($myAdvert->applications->where('responded', 0)) }} New!
	            		</span>
		            @endif
				</div>
			</div>
			{!! $myAdverts->render() !!}
		@empty
			<p>You have no part-time advertisements yet, lets create one...
			@can('edit_advert')
                <a class="btn btn-primary btn-lg btn-ww-lg" href="{{ url('/adverts/create') }}">Create Part-time Ad</a>
            @endcan
		@endforelse</p>
	</div>
	@if(count($myAdverts) > 0)
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<p>
						This is where you view all your part-time adverts.
					</p>
					@can('edit_advert')
	                    <a class="btn btn-primary btn-lg btn-block btn-ww-lg" href="{{ url('/adverts/create') }}">Create Part-time Ad</a>
	                @endcan
                </div>
			</div>
		</div>
	@endif
</div>
@stop