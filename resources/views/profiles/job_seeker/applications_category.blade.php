<a href="/dashboard">Back</a>

<div>
	<ul class="nav nav-pills">
	  <li role="presentation" class="active"><a href="/my/applications" id="urlPending">All</a></li>
	  <li role="presentation"><a href="/my/applications/pending" id="urlPending">Pending List</a></li>
	  <li role="presentation">
		<a href="/my/applications/rejected" id="urlRejected">Rejected List
			@if(count($jobSeeker->applications
					->where('status', 'REJECTED')
					->where('viewed', 0)) > 0)

				{{ count($jobSeeker->applications
						->where('status', 'REJECTED')
						->where('viewed', 0)) }} 
			@endif
		</a>
	  </li>
	  <li role="presentation">
		<a href="/my/applications/accepted" id="urlAccepted">Accepted List 
			@if(count($jobSeeker->applications
					->where('status', 'ACCEPTED FOR INTERVIEW')
					->where('viewed', 0)) > 0)

				{{ count($jobSeeker->applications
						->where('status', 'ACCEPTED FOR INTERVIEW')
						->where('viewed', 0)) }} 
			@endif
		</a>
	   </li>
	</ul>
</div>