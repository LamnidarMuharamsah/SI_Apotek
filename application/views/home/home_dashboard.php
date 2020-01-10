<div class="alert alert-primary alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss='alert' aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4><strong>Selamat Datang </strong><?php echo $this->session->userdata('nama'); ?></h4>
	<?php echo anchor("login/logout","Logout","class='btn btn-danger'"); ?>
</div>