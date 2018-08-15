<?php
		$this->load->view('layout/header_view');
		$this->load->view('layout/dosen/navbar_dosen_view');
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dashboard
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dosen</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-12">
                                        <div class="box box-primary">
                                          <div class="box-body no-padding">
                                            <!-- THE CALENDAR -->
                                            <div id="calendar"></div>
                                          </div>
                                          <!-- /.box-body -->
                                        </div>
                                        <!-- /. box -->
                                </div>	
			</div>


		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

<?php $this->load->view('layout/footer_calendar'); ?>

        
        
