<?php
$this->load->view('layout/header_view');
$this->load->view('layout/mahasiswa/navbar_mahasiswa_view');
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dashboard
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Mahasiswa</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-6">
					<!-- Default box -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">VISI & MISI</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
										title="Collapse">
									<i class="fa fa-minus"></i></button>
								<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
									<i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							KONTEN VISI MISI
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<?php
							$tgl = date('Y-m-d H:i:s');
							$date = date_create($tgl);
							echo date_format($date, 'Y-m-d H:i:s').'<br>';

							date_add($date, date_interval_create_from_date_string('5 hours'));
							echo date_format($date, 'Y-m-d H:i:s');

							?>
						</div>
						<!-- /.box-footer-->
					</div>
					<!-- /.box -->
				</div>
				<div class="col-lg-6">
					<!-- Default box -->
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">BERITA PCR</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
										title="Collapse">
									<i class="fa fa-minus"></i></button>
								<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
									<i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							KONTEN BERITA
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							uptdate soon
						</div>
						<!-- /.box-footer-->
					</div>
					<!-- /.box -->
				</div>
			</div>


		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->


<?php $this->load->view('layout/footer_view');
?>
