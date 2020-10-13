@extends('layouts.app')

@section('title','Utilisateurs')

@section('content')
@if(session('success_message'))
<div class="alert alert-success">
{{session('success_message')}}
</div>
@endif

<div class="container-fluid">
  	<div class="row">
  		<div class="col-12">
	      	<h2>{{$user->name}} Mixers</h2>
	      	@if($user->hascorona=='oui')
	      		<span class="badge badge-danger">Infecté</span>
	      	@elseif($user->hascorona=='non')
	      		<span class="badge badge-success">Non infecté</span>
	      	@endif
	    </div>
  		<div class="col-12 ">
  			<div id="users">
	        	<table class="table table-striped table-bordered" id="users-table">
          			<thead>
			            <tr>
			              	<th>Nom</th>
						</tr>
          			</thead>
          			<tbody>
          			@if($user->mixers)
						@php 
							$mixers = explode(',',$user->mixers);
						@endphp
	                	@forelse($mixers as $mixer_id)
	                	@php 
							$mixer= App\Models\User::find($mixer_id);
						@endphp
	                  	<tr>
		                    <td>{{$mixer->name}}</td>
	                  	</tr>
	                  	@empty
	                  	@endforelse
	                @else
						<tr>
							<td colspan="3" class="text-center">Aucun Mixer founded</td>
						</tr>
					@endif
                	</tbody>
        		</table>
      		</div>
      	</div>
    </div>
</div>

@section('scripts')
<style type="text/css">

#users {
  overflow-x: auto;
}
#users-table th {
    font-weight: bolder;
    font-size: 13px;
    color: #039;
    background: #b3d4fc;
    white-space: nowrap;
}
#users-table td {
    color: #669;
    border-top: 1px dashed #fff;
    padding: 10px; 
}
#users-table td a {
    color: #039;
    text-decoration: underline;
}
#users-table tbody tr:hover td {
    color: #339;
    background: #d0dafd;
}

</style>
<script type="text/javascript">

</script>
@endsection


@endsection