<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Manage Jadwal Kuliah
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Manage Jadwal Kuliah</li>
		</ol>
        </section>
        <br><br><br>
        
        <section class="content">
		<div class="row">
			<div class="col-lg-4">
				<!-- SEMESTER 1-->
				<a href="<?= base_url('admin/manage-jadwal')?>">
					<div class="info-box bg-green-gradient">
						<span class="info-box-icon">1</span>

						<div class="info-box-content">
							<span class="info-box-number">ADD</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">Buat Jadwal Baru</span>
						</div>
						<!-- /.info-box-content -->
					</div>

				</a>

				<!-- SEMESTER 2-->

				<!-- /.box -->
			</div>

			<div class="col-lg-4">
				<!-- SEMESTER 3-->
				<a href="<?= base_url('admin/manage/edit/jadwal')?>">
					<div class="info-box bg-yellow-gradient">
						<span class="info-box-icon">3</span>
						<div class="info-box-content">
							<span class="info-box-number">EDIT</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">Ubah Jadwal</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- SEMESTER 4-->

			</div>
			<div class="col-lg-4">
				<!-- Info Boxes Style 2 -->
				<a href="<?= base_url('admin/manage-jadwal/5')?>">
					<div class="info-box bg-red-gradient">
						<span class="info-box-icon">5</span>

						<div class="info-box-content">
							<span class="info-box-number">DELETE</span>

							<div class="progress">
								<div class="progress-bar" style="width: 20%"></div>
							</div>
							<span class="progress-description">Hapus Jadwal</span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>

				<!-- /.box -->

			</div>
		</div>


	</section>
        
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('layout/footer_view'); ?>
