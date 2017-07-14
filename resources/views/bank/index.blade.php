@extends('templates.default')
@section('content')
	<div class="container">
	  <div class="row">
	    <div class="col-lg-10 lg-offset-2">
	      <h1 class="text-xs-center"> My bank </h1>

		<p> Hi <b><u>{{ Auth::user()->getNameOrUsername() }},</u></b> Here you can check how much your earned on Earnm by writing content as well you can check detailed stats of your article and everything you posted on website. </p>

		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th>Stats type</th>
					<th>Stats details</th>
					<th>Earned amount</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>Total post</td>
					<td> 500 </td>
					<td> 0.5 $ </td>
		    </tr>
				<tr>
		      <td>Total post</td>
					<td> 500 </td>
					<td> 0.5 $ </td>
		    </tr>
				<tr>
		      <td>Total post</td>
					<td> 500 </td>
					<td> 0.5 $ </td>
		    </tr>
		  </tbody>
		</table>

	  </div>
	</div>
	</div>
@stop
