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
			<li class="active">Profil</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">

				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="<?= base_url($user_image) ?>" alt="User profile picture">

						<h3 class="profile-username text-center"><?= $user_nama  ?></h3>

						<p class="text-muted text-center"><?= $user_is ?> <strong><?= $programStudi ?></strong> Bergabung sejak <?= $generasi ?></p>
						<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">

                                                            <ul class="list-group list-group-unbordered">
                                                                <li class="list-group-item">
                                                                            <b><?= $email?></b> <a class="pull-right">Email</a>
                                                                </li>
                                                                <?php 
                                                                if ($user_is == 'Mahasiswa')
                                                                {
                                                                ?>
                                                                <li class="list-group-item">
										<b><?= $kelas?></b> <a class="pull-right">Kelas</a>
                                                                </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
							</div>
							<div class="col-sm-4"></div>
						</div>


						<a href="<?= base_url('profil/edit')?>" class="btn btn-info btn-block"><b>Edit Profil</b></a>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
		<?php if( $feedback = $this->session->flashdata('feedback')):
			$feedback_class = $this->session->flashdata('feedback_class');
			?>
			<div class="row">
				<div class="col-lg-4"></div>
				<div class="col-lg-4">
					<div class="alert alert-dismissible text-center <?= $feedback_class ?> ">
						<?= $feedback ?>
					</div>
				</div>
				<div class="col-lg-4"></div>
			</div>
		<?php endif; ?>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
$this->load->view('layout/footer_view');
?>
