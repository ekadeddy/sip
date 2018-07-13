<?php $this->load->view('layout/header_view')?>
<body class="login-page bg-gray disabled">
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-3" >
			<img src="<?= base_url('/assets/images/templates/cal.png') ?>" class="img-responsive" style="margin: 2%" alt="Schedule">
		</div>
		<div class="col-lg-6 " >
			<div class="login-box ">

				<!-- /.login-logo -->
				<div class="panel-heading bg-teal-gradient">
					<div class="login-logo">
						<a href="<?= base_url() ?>"><b>SISTEM INFORMASI PENJADWALAN (SIP)</b></a>
					</div>
				</div>
				<div class="login-box-body ">
					<?php if(validation_errors()){ ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong><?php echo validation_errors(); ?></strong>
						</div>
						<?php
					}
					echo form_open('login'); ?>
					<div class="form-group has-feedback">
						<?php echo form_input('username','','class="form-control" id="username" type="email" placeholder="Nama Pengguna"'); ?>
						<span class="fa fa-user form-control-feedback"></span>

					</div>
					<div class="form-group has-feedback">
						<?php echo form_password('password','','class="form-control" id="password" type="password" placeholder="Kata Sandi"'); ?>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<?php echo form_submit('login', 'Login', 'class="btn bg-teal btn-block btn-flat"') ?>
						</div>
						<!-- /.col -->
					</div>
					<?php echo form_close() ?>

					<div class="social-auth-links text-center">

					</div>
					<!-- /.social-auth-links -->


				</div>
				<div class="panel-footer one-edge-shadow ">
					<a href="#" class=" " >Lupa password?</a><br>
				</div>
				<!-- /.login-box-body -->
			</div>
			<!-- /.login-box -->
		</div>
		<div class="col-lg-3">
			<img src="<?= base_url('/assets/images/templates/cal.png') ?>" class="img-responsive" style="margin: 2%" alt="Schedule">
		</div>

	</div>
	<div class="col-lg-12">
		<img src="<?= base_url('/assets/images/templates/cal.png') ?>" class="img-responsive " style="position: fixed" alt="Schedule">
		<img src="<?= base_url('/assets/images/templates/cal.png') ?>" class="img-responsive" style="position: fixed; padding-left: 500px" alt="Schedule">
		<img src="<?= base_url('/assets/images/templates/cal.png') ?>" class="img-responsive" style="position: fixed; padding-left: 1000px" alt="Schedule">
	</div>
</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('/assets/templates/AdminLTE-2.4.3/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});
	});
</script>
</body>
</html>
