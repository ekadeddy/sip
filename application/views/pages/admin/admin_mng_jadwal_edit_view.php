<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');

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
$a_semester = array(
	'type'  => 'text',
	'name'  => 'semester',
	'id'    => 'semester',
	'value' => $semester,
	'class' => 'form-control',
	'readonly' => 'readonly'
);

$a_hari = array(
	'type'  => 'text',
	'name'  => 'hari',
	'id'    => 'hari',
	'value' => $hari,
	'class' => 'form-control',
	'readonly' => 'readonly'
);


$a_mk = array(
	'type'  => 'text',
	'name'  => 'dmatakuliah',
	'id'    => 'dmatakuliah',
	'class' => 'form-control select2'
);

$a_ruangan = array(
	'type'  => 'text',
	'name'  => 'druangan',
	'id'    => 'druangan',
	'class' => 'form-control select2'
);

$a_label =  array(
	'class' => 'col-sm-2 control-label');
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
			<li class="active">Edit Jadwal Kuliah</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Jadwal Kuliah</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
<!--			<form class="form-horizontal">-->
				<?php echo form_open('admin/save-jadwal', $f_attribute); ?>
				<div class="box-body">
                                    <div class="form-group">
                                            <?php echo form_label('Semester','lsemester',$a_label); ?>
                                            <div class="col-sm-10">
                                                    <?php echo form_input($a_semester); ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <?php echo form_label('Hari','lhari',$a_label); ?>
                                            <div class="col-sm-10">
                                                    <?php echo form_input($a_hari); ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <?php echo form_label('Kelas','lkelas',$a_label); ?>

                                            <div class="col-sm-10">
                                                    <?php echo form_dropdown('dkelas', $kelas, 'pilih',$a_kelas); ?>
                                            </div>
                                    </div>
                                    <div class="form-group hidden" id="gmatakuliah">
                                            <?php echo form_label('Mata Kuliah','lmatakuliah',$a_label); ?>

                                            <div class="col-sm-10">
                                                    <?php echo form_dropdown('dmatakuliah', $matakuliah, 'pilih',$a_matakuliah); ?>
                                            </div>
                                    </div>
                                    <div class="form-group hidden" id="gdosen">
                                            <?php echo form_label('Dosen','ldosen',$a_label); ?>

                                            <div class="col-sm-10">
                                                    <?php echo form_dropdown('ddosen', $dosen, 'pilih',$a_dosen); ?>
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
                                    <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                            <label>
                                                                    <input type="checkbox"> Remember me
                                                            </label>
                                                    </div>
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
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('layout/footer_view'); ?>

<script src="<?php echo base_url('/assets/js/JS_admin_jadwal.js') ?>"></script>
