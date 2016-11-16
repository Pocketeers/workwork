@extends('layouts.app')

@section('content')

<div class="form-group">
	<a href="/my/applications" class="btn btn-default btn-sm">Back</a>
</div>

<div>{{$appInfo->advert->job_title}}</div>

<div class="panel panel-default">
	<div class="panel-body">
		Status: {{$appInfo->status}}<br>
		Comment: {{$appInfo->employer_comment}}
	</div>
</div>

<script type="text/javascript">
var applicationID = '{{ $appInfo->id }}';

$(document).ready(function(){
    $.ajax({
      type: "POST",
      url: "/viewed",
      context: document.body,
      data: {
            'applicationID': applicationID,
            '_token': '{!! csrf_token() !!}'
            }
    });
});
</script>

@stop