<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/mahasiswa/navbar_mahasiswa_view');
        $f_attribute2 = array(
            'class'     => 'form-horizontal hidden',
            'id'        => 'freaddetail2',
            'name'      => 'freaddetail2');
        
        $a_ijadwal_ganti_id = array (
            'class' => 'form-control hidden',
            'id' => 'ijadwal_ganti_id2',
            'name' => 'ijadwal_ganti_id2');


        echo form_open('notif/detail', $f_attribute2); 
        echo form_input($a_ijadwal_ganti_id); 
        echo form_close();
        
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Perubahan Jadwal
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> <?= $user_akses ?></a></li>
				<li class="active">Perubahan Jadwal</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-12">
                                    <div class="box box-success">
                                                <div class="box-header with-border">
                                                  <h3 class="box-title">Daftar Perubahan Jadwal Kuliah</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                  <table class="table table-bordered">
                                                    <tr>
                                                      <th style="width: 10px">#</th>
                                                      <th>Tanggal</th>
                                                      <th>Mata Kuliah</th>
                                                      <th>Jam</th>
                                                      <th>Ruangan</th>
                                                      <th class="text-center">Keterangan</th>
                                                    </tr>
                                                    
                                                    <?php 
                                                    $no = 1;
                                                    foreach ($jadwal_ganti as $row): ?>
                                                    <tr class="email-read">
                                                    
                                                        <td ><a href="#" class="text-black" onclick="readNotif2('<?= $row->JADWAL_GANTI_ID ?>')"><?= $no ?></a></td>
                                                        <td><a href="#" class="text-black" onclick="readNotif2('<?= $row->JADWAL_GANTI_ID ?>')"><?= ucfirst($row->HARI).', '.date(' d - M - Y ',strtotime($row->TANGGAL))?></a></td>
                                                        <td><a href="#" class="text-black" onclick="readNotif2('<?= $row->JADWAL_GANTI_ID ?>')"><?= $row->MATA_KULIAH_NAMA.' '.$row->KELAS_NAMA ?></a></td>
                                                        <td><a href="#" class="text-black" onclick="readNotif2('<?= $row->JADWAL_GANTI_ID ?>')"><?= $row->JAM_MULAI.' - '.(($row->JAM_JK+$row->JAM_MK)-1).':45:00' ?></a></td>
                                                        <td><a href="#" class="text-black" onclick="readNotif2('<?= $row->JADWAL_GANTI_ID ?>')"><?= $row->RUANGAN_ID ?></a></td>
                                                        <td align="center"> 
                                                            <a href="#" class="text-black" onclick="readNotif2('<?= $row->JADWAL_GANTI_ID ?>')"><?= $row->KET ?></a>
                                                        </td>
                                                    </a>
                                                    </tr>                                                       
                                                    
                                                    <?php 
                                                    
                                                    $no++;
                                                    endforeach;?>
                                                  </table>
                                                </div>
                                                <!-- /.box-body -->
                                                
                                              </div>
                                    <?php 
                                    ?>
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

<?php $this->load->view('layout/footer_view'); ?>
