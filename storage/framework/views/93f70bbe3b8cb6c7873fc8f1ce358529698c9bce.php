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
	      	<h2><?php echo e($user->name); ?> Mixers</h2>
	      	<?php if($user->hascorona=='oui'): ?>
	      		<span class="badge badge-danger">Infecté</span>
	      	<?php elseif($user->hascorona=='non'): ?>
	      		<span class="badge badge-success">Non infecté</span>
	      	<?php endif; ?>
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
          			<?php if($user->mixers): ?>
						<?php 
							$mixers = explode(',',$user->mixers);
						?>
	                	<?php $__empty_1 = true; $__currentLoopData = $mixers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mixer_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                	<?php 
							$mixer= App\Models\User::find($mixer_id);
						?>
	                  	<tr>
		                    <td><?php echo e($mixer->name); ?></td>
	                  	</tr>
	                  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	                  	<?php endif; ?>
	                <?php else: ?>
						<tr>
							<td colspan="3" class="text-center">Aucun Mixer founded</td>
						</tr>
					<?php endif; ?>
                	</tbody>
        		</table>
      		</div>
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

</script>
<?php $__env->stopSection(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/corona/resources/views/users/show.blade.php ENDPATH**/ ?>