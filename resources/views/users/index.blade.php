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
	      	<button style="float: left" class="btn btn-primary" data-toggle="modal" data-target="#AddUserModal"><i class="fa fa-plus"></i> Nouvel Utilisateur</button>
          <button style="float: left" class="btn btn-primary" data-toggle="modal" data-target="#MakeMixersModal"><i class="fa fa-save"></i> Contact between user</button>
	    </div>
	    <div class="col-12 ">
	      	<div id="users">
	        	<table class="table table-striped table-bordered" id="users-table">
          			<thead>
			            <tr>
		              	<th>Nom</th>
		              	<th>Infecté (Oui / Non)</th>
                    <th>Actions</th>
						      </tr>
          			</thead>
          			<tbody>
                  @forelse($users as $user)
                  <tr id="user_{{$user->id}}">
                    <td>{{$user->name}}</td>
                    <td>
                      @if($user->hascorona=='oui')
                        <span class="badge badge-danger">Oui</span>
                      @else
                        <span class="badge badge-success">Non</span>
                      @endif
                    </td>
                    <td>
                      <a class="btn btn-info" href="{{route('users.show', ['user'=>$user->id])}}"><i class="fas fa-eye"></i></a>
                      <button data-id="{{$user->id}}" data-name="{{$user->name}}" data-gender="{{$user->gender}}" data-age="{{$user->age}}" @if($user->province) data-city="{{$user->province->id}}" @endif class="btn btn-success" data-toggle="modal" data-target="#UpdateUserModel"><i class="fas fa-pencil-alt"></i></button>
                      <button onclick="markAsSick({{$user->id}})" class="btn btn-danger" type="button"><i class="fas fa-check"></i></button>
                      <button onclick="deleteUser({{$user->id}})" class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="3" class="text-center">Aucun Utilisateur</td>
                  </tr>
                  @endforelse
                </tbody>
        		</table>
      		</div>
    	</div>
  	</div>
</div>

<div class="modal fade" id="MakeMixersModal" tabindex="-1" role="dialog" aria-labelledby="MakeMixersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg modal-right modal-success" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="MakeMixersModalsLabel">Mixers Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form method="POST" action="{{ route('users.uploadTwoMixers') }}">
        @csrf
        <div class="modal-body">
        
            
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Personne 1</span>
              </div>
              <select name="person1" class="form-control">
                @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach                     
              </select>
            </div>
            <br>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Personne 2</span>
              </div>
              <select name="person2" class="form-control">
                @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach                     
              </select>
            </div>
            <br>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="AddUserModal" tabindex="-1" role="dialog" aria-labelledby="AddClientLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg modal-right modal-success" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddClientLabel">Ajouter un nouveau utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="modal-body">
        
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Nom Complet</span>
              </div>
              <input type="text" class="form-control" name="name" placeholder="Saisir le nom complet de l'Utilisateur">
            </div>
            <br>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Age</span>
              </div>
              <select name="age" class="form-control">
                  <option value="small">15-24 ans</option>
                  <option value="medium">26-40 ans</option>
                  <option value="large">41-65 ans</option>
                  <option value="extra">plus de 66 ans</option>
              </select>
            </div>
            <br>
            
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Ville</span>
              </div>
              <select name="city" class="form-control">
                @foreach($provinces as $province)
                  <option value="{{$province->id}}">{{$province->city}}</option>
                @endforeach                     
              </select>
            </div>
            <br>
            <div class="input-group">
              <label for=""></label>
              <span class="input-group-text">Genre</span>
                <select name="gender" class="form-control">
                  <option value="m">Masculin</option>
                  <option value="f">Féminin</option>
                </select>
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="UpdateUserModel" tabindex="-1" role="dialog" aria-labelledby="UpdateUserModel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg modal-right modal-success" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UpdateUserModelLabel">Modification Utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action = "" method = "POST" id="update_user_form" >
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id" id="user_id">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Nom Complet</span>
              </div>
              <input type="text" class="form-control" name="name" id="name" placeholder="Saisir le nom complet de l'Utilisateur">
            </div>
            <br>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Age</span>
              </div>
              <select id="age" name="age" class="form-control">
                  <option value="small">15-24 ans</option>
                  <option value="medium">26-40 ans</option>
                  <option value="large">41-65 ans</option>
                  <option value="extra">plus de 66 ans</option>
              </select>
            </div>
            <br>
            
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Ville</span>
              </div>
              <select id="city" name="city" class="form-control">
                @foreach($provinces as $province)
                  <option value="{{$province->id}}">{{$province->city}}</option>
                @endforeach                     
              </select>
            </div>
            <br>
            <div class="input-group">
              <label for=""></label>
              <span class="input-group-text">Genre</span>
                <select id="gender" name="gender" class="form-control">
                  <option value="m">Masculin</option>
                  <option value="f">Féminin</option>
                </select>
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
        </form>
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

  $('#UpdateUserModel').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var name = button.data('name')
    var city = button.data('city')
    var age = button.data('age')
    var gender = button.data('gender')
    var modal = $(this)
    modal.find('.modal-body #user_id').val(id)
    modal.find('.modal-body #name').val(name)
    modal.find('.modal-body #city').val(city)
    modal.find('.modal-body #age').val(age)
    modal.find('.modal-body #gender').val(gender)
    modal.find('form').attr('action','{{ url('/') }}/users/update');

  });
  function  markAsSick(user_id){
    $('#loading').css('display','block');
    $.ajax({
        type:'POST',
        url:'{{url('/')}}/users/mark-sick',
        data: {
          user_id: user_id
        },
        success:function(data){
          $('#loading').css('display','none');
          location.reload(true);
        },
        error:function(error){
          $('#loading').css('display','none');
            swal("Erreur!");
        }
    });
  }
  function deleteUser(user_id){
    swal({
        title: "Vous voulez vraiment supprimer ce utilisateur",
        text: "Une fois supprimé, vous ne pourrez pas récupérer ce utilisateur!",
        icon: "warning",
        buttons: ['Annuler', 'Confirmer'],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type:'POST',
                url:'{{url('/')}}/users/destroy',
                data: {
                    id: user_id,
                },
                success:function(data){
                    $('#user_'+user_id).remove();
                    swal(data.success, {
                      icon: "success",
                    });
                },
                error:function(error){
                  console.log(error);
                    swal("Erreur!");
                }
            });
        } else {
            swal("Opération annulé!");
        }
    });
  }
</script>
@endsection


@endsection