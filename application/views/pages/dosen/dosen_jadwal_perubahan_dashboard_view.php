<?php
	//$this->load->view('layout/header_view');
        $this->load->view('layout/dosen/header_dosen');
	$this->load->view('layout/dosen/navbar_dosen_view');
        
        //attribute
$f_attribute = array(
	'class'     => 'form-horizontal',
	'id'        => 'fcreatejadwal',
	'name'      => 'fcreatejadwal');
$a_dosen = array(
	'class'     => 'form-control select2',
	'id'        => 'ddosen',
	'name'      => 'ddosen');
$a_kelas = array(
	'class'     => 'form-control select2',
	'id'        => 'dkelas',
	'name'      => 'dkelas');
$a_jam = array(
	'class'     => 'form-control select2',
	'id'        => 'djam',
	'name'      => 'djam');
$a_matakuliah = array(
	'class'     => 'form-control select2',
	'id'        => 'dmatakuliah',
	'name'      => 'dmatakuliah');
$a_jadwal_hari = array(
	'class'     => 'form-control select2',
	'id'        => 'dhari',
	'name'      => 'dhari');

$a_semester = array(
	'type'  => 'text',
	'name'  => 'semester',
	'id'    => 'semester',
	'value' => $semester,
	'class' => 'form-control',
	'readonly' => 'readonly'
);
$a_iket = array(
	'class'     => 'form-control select2',
	'id'        => 'iket',
	'name'      => 'iket',
        'placeholder' => '...'
    );


$a_hari = array(
	'name'  => 'ihari',
	'id'    => 'ihari',
	'value' => $hari
);
$a_ihari = array(
	'id'  => 'ihari',
        'name' => 'ihari',
        'class' => 'hidden'
);

$a_itanggal = array (
    'id' => 'itanggal',
    'name' => 'itanggal',
    'class' => 'form-control pull-right',
    'placeholder' => '2017/05/20'
);
        
$a_ltanggal_label = array(
	'name'  => 'iltanggal',
	'id'    => 'iltanggal',
	'value' => $hari
);

$a_jadwal_id = array(
	'id'  => 'ijadwal_id',
        'name' => 'ijadwal_id',
        'class' => 'hidden'
);


$a_ruangan = array(
	'type'  => 'text',
	'name'  => 'druangan',
	'id'    => 'druangan',
	'class' => 'form-control select2'
);

$a_label =  array(
	'class' => 'col-sm-2 control-label');

$a_label_tanggal =  array(
	'class' => 'col-sm-2 control-label ',
        'id' => 'ltanggal',
        'value' => 'cicak',
        'name' => 'ltanggal'
    );

////end attribute



$now = time();

        
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
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Pergantian Pertemuan Kuliah</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
<!--			<form class="form-horizontal">-->
				<?php echo form_open('dosen/save-perubahan-jadwal', $f_attribute); ?>
				<div class="box-body">
                                    

                                    <div class="form-group hidden">
                                            <?php //echo form_label('TES','lkelas',$a_label); ?>

                                            <div class="col-sm-10">
                                                    <?php 
                                                    
//                                                    $date = '08-07-2018';
//                                                    $nameOfDay = date('D', strtotime($date));
//                                                    echo $nameOfDay.'<br>';
//                                                    echo unix_to_human($now).'<br>'; // U.S. time, no seconds
//                                                    echo unix_to_human($now, TRUE, 'us').'<br>'; // U.S. time with seconds
//                                                    echo unix_to_human($now, TRUE, 'eu').'<br>'; // Euro time with seconds
//                                                    echo $hari.'<br>';
                                                    
                                                    //echo form_input('ihari','',$a_hari) 
                                                    
                                                    
                                                    ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <?php echo form_label('Kelas','lkelas',$a_label); ?>

                                            <div class="col-sm-4">
                                                    <?php 
                                                    echo form_dropdown('dkelas', $kelas, 'pilih',$a_kelas); 
                                                    echo form_input('ijadwal_id','',$a_jadwal_id); 
                                                    echo form_input('ihari','',$a_ihari); 
                                                    
                                                    
                                                   
                                                    ?>
                                            </div>
                                    </div>
                                    <div class="form-group hidden" id="gmatakuliah">
                                            <?php echo form_label('Mata Kuliah','lmatakuliah',$a_label); ?>

                                            <div class="col-sm-4">
                                                    <?php echo form_dropdown('dmatakuliah', $matakuliah, 'pilih',$a_matakuliah); ?>
                                            </div>
                                    </div>
                                    
                                    <div class="form-group hidden" id="ghari">
                                            <?php echo form_label('Hari','lhari',$a_label); ?>

                                            <div class="col-sm-4">
                                                    <?php echo form_dropdown('dhari', $jadwal_hari, 'pilih',$a_jadwal_hari); ?>
                                            </div>
                                    </div>
                                    <hr> </hr>
                                    <div class="form-group hidden" id="gtanggal">
                                            <?php echo form_label('Tanggal Perubahan','ldosen',$a_label); ?>

                                            <div class="col-sm-2">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <?php echo form_input('itanggal','',$a_itanggal) ?>
                                                  </div>
                                            </div>
                                        <div class="col-sm-4">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group hidden" id="gjam">
                                            <?php echo form_label('Jam','ljam',$a_label); ?>
                                            <div class="col-sm-2">
                                                    <?php echo form_dropdown('djam', $jam, 'pilih',$a_jam); ?>
                                            </div>
                                    </div>
                                    
                                    <div class="form-group hidden" id="gruangan">
                                            <?php echo form_label('Ruangan','lruangan',$a_label); ?>
                                            <div class="col-sm-3">
                                                    <?php echo form_dropdown('druangan', $ruangan, 'pilih',$a_ruangan); ?>
                                                
                                            </div>
                                    </div>
                                    <div class="form-group hidden" id="gket">
                                            <?php echo form_label('Keterangan','lket',$a_label); ?>

                                            <div class="col-sm-5">
                                                    <?php echo form_textarea($a_iket); ?>
                                            </div>
                                    </div>
                                    
                                    
				</div>
				<!-- /.box-body -->
				<div class="box-footer">


					<button type="submit" class="btn btn-default">Cancel</button>
					<?php echo form_submit('btnSave', 'Simpan', 'class="btn btn-success pull-right"') ?>
					<?php echo form_close() ?>
				</div>
				<!-- /.box-footer -->
			</form>
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
<?php //$this->load->view('layout/dosen/footer_dosen'); ?>

<script src="<?php echo base_url('/assets/js/JS_dosen_jadwal.js') ?>"></script>