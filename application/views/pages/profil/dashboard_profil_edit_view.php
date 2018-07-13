<?php
$this->load->view('layout/header_view');
$this->load->view($navbar);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Profil

		</h1>

		<ol class="breadcrumb">
			<li><a href="<?= base_url('mahasiswa/dashboard') ?>"><i class="fa fa-dashboard"></i> Mahasiswa</a></li>
			<li class="active">Profil </li>

		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- About Me Box -->
				<div class="row">
					<!-- /.col -->
					<div class="col-md-12">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
							</ul>
							<div class="tab-content">
								<div class="active tab-pane" id="settings">
									<?= $updateProfil?>
										<div class="form-group">
											<label for="inputName" class="col-sm-2 control-label">New Password</label>


											<div class="col-sm-4">
												<?php echo form_input($passwd); ?>
											</div>
										</div>


										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<?php echo form_submit('profil/edit', 'Submit', 'class="btn btn-danger"') ?>

											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- /.nav-tabs-custom -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.box -->
			</div>
		</div>
		<?php
		if(validation_errors())
		{ ?>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong class="text-center"><?php echo validation_errors(); ?></strong>
				</div>
			</div>
			<div class="col-md-4"></div>
		<?php } ?>

	</section>

	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
$this->load->view('layout/footer_view');
?>
