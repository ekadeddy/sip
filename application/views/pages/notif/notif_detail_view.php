<?php
	$this->load->view('layout/header_view');
	$this->load->view($navbar);
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				&nbsp; <?php  echo $jadwal_ganti; ?>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> <?= $user_akses ?></a></li>
				<li class="active">Detail Perubahan Jadwal</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="glyphicon glyphicon-blackboard"></i> Detail Perubahan Jadwal
            <small class="pull-right">Hari ini : <?= date('d/m/Y') ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <?php 
      foreach ($gantiJadwalDetail as $row):
      
      ?>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          
          Mata Kuliah
          <address>
            <strong><?= $row->MATA_KULIAH_NAMA ?></strong><br>
            <?= $row->STATUS ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Dosen
          <address>
            <strong><?= $row->DOSEN_NAMA ?></strong>- <?= $row->DOSEN_INISIAL ?><br>
            <?= $row->EMAIL ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Status
            <?= getStatusPergantianJadwal($row->JDG_STAT,$row->REJECT_BY,$row->APPROVAL_BY,$row->TGL_ACT); ?>
        </div>
        <!-- /.col -->
      </div>
      
      
      <!-- /.row -->
      <div class="row">
       
        <div class="col-xs-6">
          <p class="lead text-green text-bold">Penting</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Tanggal</th>
                <td><?= ucfirst(strtolower($row->HARI)).' '.date('d-m-Y', strtotime($row->TANGGAL)) ?></td>
              </tr>
              <tr>
                <th>Jam</th>
                <td><?= $row->JAM_MULAI.' - '.(($row->JAM_JK+$row->JAM_MK)-1).':45:00' ?></td>
              </tr>
              <tr>
                <th>Ruangan</th>
                <td><?= 'R '.$row->RUANGAN_ID ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
         <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead text-blue">Info:</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Perubahan jadwal telah Anda lihat.
            Terima kasih.
          </p>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <?php endforeach;?>
   
    </section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

<?php $this->load->view('layout/footer_view'); ?>
