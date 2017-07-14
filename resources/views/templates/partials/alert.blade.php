@if (Session::has('danger'))
	<div class="alert alert-danger alert-dismissible fade in" style="max-width:80%; margin:1% auto;" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Error!</strong> {{ Session::get('danger') }}
	</div>
@elseif (Session::has('info'))
	<div class="alert alert-info alert-dismissible fade in" style="max-width:80%; margin:1% auto;" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Information!</strong> {{ Session::get('info') }}
	</div>
@elseif (Session::has('warning'))
	<div class="alert alert-warning alert-dismissible fade in" style="max-width:80%; margin:1% auto;" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Warning!</strong> {{ Session::get('warning') }}
	</div>
@elseif (Session::has('success'))
	<div class="alert alert-success alert-dismissible fade in" style="max-width:80%; margin:1% auto;" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Success!</strong> {{ Session::get('success') }}
	</div>
@endif
