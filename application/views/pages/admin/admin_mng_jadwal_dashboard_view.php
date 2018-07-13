<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Tambah Jadwal Kuliah
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Manage Jadwal Kuliah</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-3">
				<!-- SEMESTER 1-->
				<a href="<?= base_url('admin/manage-jadwal/1')?>">
					<div class="info-box bg-aqua">
						<span class="info-box-icon">1</span>

						<div class="info-box-content">
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">32 Hari dari 150 Hari</span>
						</div>
						<!-- /.info-box-content -->
					</div>

				</a>

				<!-- SEMESTER 2-->
				<a href="<?= base_url('admin/manage-jadwal/2')?>">
					<div class="info-box bg-green">
						<span class="info-box-icon">2</span>

						<div class="info-box-content">
							<span class="info-box-text"></span>
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">20% Increase in 30 Days</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>

				<!-- /.box -->
			</div>

			<div class="col-lg-3">
				<!-- SEMESTER 3-->
				<a href="<?= base_url('admin/manage-jadwal/3')?>">
					<div class="info-box bg-aqua">
						<span class="info-box-icon">3</span>
						<div class="info-box-content">
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">32 Hari dari 150 Hari</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- SEMESTER 4-->
				<a href="<?= base_url('admin/manage-jadwal/4')?>">
					<div class="info-box bg-green">
						<span class="info-box-icon">4</span>

						<div class="info-box-content">
							<span class="info-box-text"></span>
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">20% Increase in 30 Days</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>

			</div>
			<div class="col-lg-3">
				<!-- Info Boxes Style 2 -->
				<a href="<?= base_url('admin/manage-jadwal/5')?>">
					<div class="info-box bg-aqua">
						<span class="info-box-icon">5</span>

						<div class="info-box-content">
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">32 Hari dari 150 Hari</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>

				<!-- /.box -->
				<a href="<?= base_url('admin/manage-jadwal/6')?>">
					<div class="info-box bg-green">
						<span class="info-box-icon">6</span>

						<div class="info-box-content">
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">32 Hari dari 150 Hari</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>

			</div>
			<div class="col-lg-3">
				<!-- Info Boxes Style 2 -->
				<a href="<?= base_url('admin/manage-jadwal/7')?>">
					<div class="info-box bg-aqua">
						<span class="info-box-icon">7</span>

						<div class="info-box-content">
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">32 Hari dari 150 Hari</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<a href="<?= base_url('admin/manage-jadwal/8')?>">
					<div class="info-box bg-green">
						<span class="info-box-icon">8</span>

						<div class="info-box-content">
							<span class="info-box-number">SEMESTER</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">32 Hari dari 150 Hari</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>

			</div>
		</div>


	</section>
	<!-- /.content -->
        
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('layout/footer_view'); ?>
