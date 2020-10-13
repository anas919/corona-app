<?php $__env->startSection('title','Utilisateurs'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success_message')): ?>
<div class="alert alert-success">
<?php echo e(session('success_message')); ?>

</div>
<?php endif; ?>

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
                  <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr id="user_<?php echo e($user->id); ?>">
                    <td><?php echo e($user->name); ?></td>
                    <td>
                      <?php if($user->hascorona=='oui'): ?>
                        <span class="badge badge-danger">Oui</span>
                      <?php else: ?>
                        <span class="badge badge-success">Non</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a class="btn btn-info" href="<?php echo e(route('users.show', ['user'=>$user->id])); ?>"><i class="fas fa-eye"></i></a>
                      <button data-id="<?php echo e($user->id); ?>" data-name="<?php echo e($user->name); ?>" data-gender="<?php echo e($user->gender); ?>" data-age="<?php echo e($user->age); ?>" <?php if($user->province): ?> data-city="<?php echo e($user->province->id); ?>" <?php endif; ?> class="btn btn-success" data-toggle="modal" data-target="#UpdateUserModel"><i class="fas fa-pencil-alt"></i></button>
                      <button onclick="markAsSick(<?php echo e($user->id); ?>)" class="btn btn-danger" type="button"><i class="fas fa-check"></i></button>
                      <button onclick="deleteUser(<?php echo e($user->id); ?>)" class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr>
                    <td colspan="3" class="text-center">Aucun Utilisateur</td>
                  </tr>
                  <?php endif; ?>
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
        <form method="POST" action="<?php echo e(route('users.uploadTwoMixers')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
        
            
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Personne 1</span>
              </div>
              <select name="person1" class="form-control">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
              </select>
            </div>
            <br>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Personne 2</span>
              </div>
              <select name="person2" class="form-control">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
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
        <form method="POST" action="<?php echo e(route('users.store')); ?>">
        <?php echo csrf_field(); ?>
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
                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($province->id); ?>"><?php echo e($province->city); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
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
        <?php echo csrf_field(); ?>
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
                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($province->id); ?>"><?php echo e($province->city); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
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
<?php $__env->startSection('scripts'); ?>
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
    modal.find('form').attr('action','<?php echo e(url('/')); ?>/users/update');

  });
  function  markAsSick(user_id){
    $('#loading').css('display','block');
    $.ajax({
        type:'POST',
        url:'<?php echo e(url('/')); ?>/users/mark-sick',
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
                url:'<?php echo e(url('/')); ?>/users/destroy',
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
<?php $__env->stopSection(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/corona/resources/views/users/index.blade.php ENDPATH**/ ?>