<?php
$this->load->view('parts/header');
echo form_open('login/login_aksi');

?>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h1 class="text-center"><strong>Login</strong>
		<small>Sistem Informasi Apotek</small></h1>
		<div class="login-wrapper">
		<?php if($this->session->flashdata('pesan1')) { ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss='alert' aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4><strong>Peringatan</strong></h4>
				<?php echo $this->session->flashdata('pesan1'); ?>
			</div>
		<?php }else if($this->session->flashdata('pesan2')) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss='alert' aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4><strong>Ada Kesalahan</strong></h4>
				<?php echo $this->session->flashdata('pesan2'); ?>
			</div>
		<?php }; ?>
			<div class="form-group">
				<label for="input-user">Username</label>
				<input class="form-control" id="input-user" type="text" name="username" placeholder="Username">	
			</div>
			<div class="form-group">
				<label for="input-pass">Password</label>
				<input class="form-control" id="input-pass" type="password" name="password" placeholder="Password">	
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-primary">
			</div>
		</div>		
	</div>
</div>
<?php 
	echo form_close();
	$this->load->view('parts/footer');
?>