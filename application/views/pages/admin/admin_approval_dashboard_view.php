<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');
        
        //attribute
        
        $a_iket = array(
	'class'     => 'form-control',
	'id'        => 'iket',
	'name'      => 'iket',
        'rows'      => '3',
        'placeholder' => 'Wajib Diisi'
    );
        
        $f_attribute = array(
	'class'     => 'form-horizontal',
	'id'        => 'fsaveapproval',
	'name'      => 'fsaveapproval');
        
        //end
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Approval Ganti Jadwal
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
				<li class="active">Approval Ganti Jadwal </li>
			</ol>
		</section>  

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-12">
                                    <div class="box">
                                                <div class="box-header with-border">
                                                  <h3 class="box-title">Approval List</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                  <table class="table table-bordered">
                                                    <tr>
                                                      <th style="width: 10px">#</th>
                                                      <th>Dosen</th>
                                                      <th>Mata Kuliah</th>
                                                      <th>Tanggal Pertemuan</th>
                                                      <th>Tanggal Ganti</th>
                                                      <th>Ruangan</th>
                                                      <th colspan="2" class="text-center">Action</th>
                                                    </tr>
                                                    
                                                    <?php 
                                                    $no = 1;
                                                    foreach ($aprroval_list as $row): ?>
                                                    <tr>
                                                        <td ><?= $no ?></td>
                                                        <td><?= $row->DOSEN_NAMA ?></td>
                                                        <td><?= $row->MATA_KULIAH_NAMA ?></td>
                                                        <td><?= $row->TANGGAL ?></td>
                                                        <td><?= strtoupper($row->HARI).' '.$row->TANGGAL ?></td>
                                                        <td><?= $row->RUANGAN_ID ?></td>
<!--                                                        <td align="center"> <?= "<button onclick=approvalSave() class='btn btn-success btn-xs m-b-5'><i class=' glyphicon glyphicon-ok '></i></button>";?> </td>
                                                        <td align="center"> <?= "<button onclick=approvalSave() class='btn btn-danger btn-xs m-b-5'><i class='glyphicon glyphicon-remove'></i></button>";?> </td>-->
                                                        
                                                        <td align="center"> 
                                                            <button onclick="approvalSave('<?= $row->JADWAL_GANTI_ID ?>','<?= $row->JADWAL_ID ?>','Y')" class="btn btn-success btn-xs m-b-5"><i class=' glyphicon glyphicon-ok '></i></button>
                                                        </td>
                                                        
                                                        <td align="center"> 
                                                            <button onclick="approvalSave('<?= $row->JADWAL_GANTI_ID ?>','<?= $row->JADWAL_ID ?>','T')" class="btn btn-danger btn-xs m-b-5"><i class='glyphicon glyphicon-remove'></i></button>
                                                        </td>
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
       
<script src="<?php echo base_url('/assets/js/JS_admin_approval.js') ?>"></script>
        
 <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php echo form_open('admin/save-approval', $f_attribute); ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Default Modal</h4>
              </div>
              <div class="modal-body">
                <p class="kata-kata">Apakah anda yakin akan melakukan </p>
                
                <div class="form-group">
                    <div class="col-lg-12">
                        <label>Detail</label>
                    </div> 
                    <div class="col-lg-12"> 
                        <div class="col-lg-3">Dosen </div>
                        <div class="col-lg-9"><span class="kata-dosen text-bold">dsn</span></div>   
                        <div class="col-lg-3">Mata Kuliah </div>
                        <div class="col-lg-9"><span class="kata-matakuliah text-bold">mk</span></div>   
                        <div class="col-lg-3">Tanggal </div>
                        <div class="col-lg-9"><span class="kata-tanggal text-bold">tgl</span></div>   
                        <div class="col-lg-3">Ruangan </div>
                        <div class="col-lg-9"><span class="kata-ruangan text-bold">r</span></div>  
                        
                    </div> 
                    <div class="col-sm-2"> </div> 
                </div>
                
                <div class="form-group">
                    <div class="col-lg-12">
                        <label>Keterangan</label>
                    </div> 
                    <div class="col-lg-12"> 
                        <?php echo form_textarea($a_iket); ?>
                        <?php 
                        echo form_hidden('jadwal_ganti_id'); 
                        echo form_hidden('approval_status');
                        ?>
                    </div> 
                    <div class="col-sm-2"> </div> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php echo form_submit('btnSave', 'Simpan', 'id="btnSave" class="btn btn-success"') ?>
                <?php echo form_close() ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
