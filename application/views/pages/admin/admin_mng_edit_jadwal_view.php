<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');
        
        //Att
 $a_iket = array(
	'class'     => 'form-control' ,
	'id'        => 'iket',
	'name'      => 'iket',
        'rows'      => '3',
        'readonly' => 'readonly'
    );        
$f_attribute = array(
	'class'     => 'form-horizontal',
	'id'        => 'feditjadwal',
	'name'      => 'feditjadwal');
$a_ps = array(
        'class'     => 'form-control select2',
        'id'        => 'dprogramstudi',
        'onchange'  => 'this.form.submit()');
$a_dkelas = array(
        'class'     => 'form-control select2',
        'id'        => 'dkelas',
        'onchange'  => 'this.form.submit()');
$a_label =  array(
	'class' => 'col-sm-3 control-label');
$a_ijadwal = array (
        'class' => 'form-control hidden',
        'id' => 'ijadwal_id',
        'name' => 'ijadwal_id'
);
$a_ijadwal2 = array (
        'class' => 'form-control hidden',
        'id' => 'ijadwal_id2',
        'name' => 'ijadwal_id2'
);
//untuk modal
$a_mkelas = array(
	'type'  => 'text',
	'name'  => 'ikelas',
	'id'    => 'ikelas',
	'class' => 'form-control',
	'readonly' => 'readonly'
);
$a_dosen = array(
	'class'     => 'form-control select2',
	'id'        => 'ddosen',
	'name'      => 'ddosen');
$a_matakuliah = array(
	'class'     => 'form-control select2',
	'id'        => 'dmatakuliah',
	'name'      => 'dmatakuliah');
$a_jam = array(
	'class'     => 'form-control select2',
	'id'        => 'djam',
	'name'      => 'djam');
$a_hari = array(
	'class'     => 'form-control select2',
	'id'        => 'dhari',
	'name'      => 'dhari');
$a_ruangan = array(
	'type'  => 'text',
	'name'  => 'druangan',
	'id'    => 'druangan',
	'class' => 'form-control select2'
);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Edit Jadwal Kuliah
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Manage Jadwal Kuliah</li>
		</ol>
	</section>
                                                                                                                            
	<section class="content">
<!--		MANAGE-->
		<div class="row">
                    <div class="col-lg-12">
                     <div class="box box-warning">      
                        <div class="box-header with-border">
                          <h3 class="box-title">Edit Jadwal</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <?php echo form_open('admin/manage/jadwal/edit', $f_attribute); ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo form_label('Program Studi','lprogramstudi',$a_label); ?>
                                    <div class="col-sm-5">
                                        <?php echo form_dropdown('dprogramstudi', $ps, 'pilih',$a_ps); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo form_label('Kelas','lkelas',$a_label); ?>
                                    <div class="col-sm-5">
                                        <?php echo form_dropdown('dkelas', $kelas, 'pilih',$a_dkelas); ?>
                                    </div>
                                    
                                  
                                </div>
                            </div>
                            
                           
                            
                            <div class="col-lg-12">
                                <table class="table table-bordered" border="2">
                            
                               <?php 
                               $row_senin=0;
                               $row_selasa=0;
                               $row_rabu=0;
                               $row_kamis=0;
                               $row_jumat=0;
                               $bar='';
                               for ($i=0; $i <count($alljamkuliah)+1;$i++)
                               //foreach ($alljamkuliah as $jam)
                               {
                                   echo '<tr>';
                                   $hari= HgetHari();
                                   for($j=0; $j < count($hari);$j++)
                                   {
                                        
                                       if ($i==0)
                                       {
                                           if($hari[$j] != '0')
                                           {
                                               
                                               echo '<th>'.$hari[$j].'</th>';
                                           }
                                           else
                                           {
                                               echo '<th>JAM</th>';
                                           }
                                       }
                                       else
                                       {
                                            if($hari[$j] != '0')
                                           {    
                                                
                                                   
                                                $jadwalfix = $this->jadwal_mdl->getJadwalHarianKelas($hari[$j],$kls,$i);
                                                //$jadwalfix = $this->jadwal_mdl->getJadwalHarianDosen2($hari[$a],$user_email,$jam['JAM_KULIAH_ID']);
                                                
                                                     if($jadwalfix != false)
                                                     {
                                                        foreach ($jadwalfix as $jad)
                                                       { 
                                                            if ($hari[$j] == 'senin')
                                                            {
                                                                $row_senin = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-warning bg-maroon" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'selasa')
                                                            {
                                                                $row_selasa = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-warning" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'rabu')
                                                            {
                                                                $row_rabu = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-success" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'kamis')
                                                            {
                                                                $row_kamis = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-info" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'jumat')
                                                            {
                                                                $row_jumat = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-purple" style="width: 100%"></div></div>';
                                                            }
//                                                             echo '<td rowspan="'.$jad->JAM_MK.'" >'.$bar.' <p>'.$jad->KELAS_NAMA.'<br>'.$jad->MATA_KULIAH_NAMA. '<br> R'.$jad->RUANGAN_ID.'<br>'.
//                                                           $jad->JAM_MULAI.' - '.$jad->JAM_SELESAI.'</p></th>';
                                                              echo '<td align="center" rowspan="'.$jad->JAM_MK.'" >'.$bar.' <p>'.$jad->KELAS_NAMA.'<br>'.$jad->MATA_KULIAH_NAMA. '<br> R'.$jad->RUANGAN_ID.'<br>'.
                                                           $jad->JAM_MULAI.' - '.(($jad->JAM_JK+$jad->JAM_MK)-1).':45:00</p></th>';
                                                              ?>
                                                            <span class="text-center">
                                                                <button type="button" onclick="editJadwal('<?= $jad->JADWAL_ID ?>','<?= $hari[$j] ?>','S')" class="btn btn-success btn-xs m-b-12"><i class='glyphicon glyphicon-pencil'></i></button>
                                                                <button type="button" onclick="editJadwal('<?= $jad->JADWAL_ID ?>','<?= $hari[$j] ?>','D')" class="btn btn-danger btn-xs m-b-12"><i class='glyphicon glyphicon-remove'></i></button>
                                                            </span>
                                                            
                                                              <?php
                                                             
                                                       }
                                                     //echo '<th style="width: 10px">JADWAL KOSONG '.$i.' '.$hari[$j].'</th>';
                                                     }
                                                     else
                                                     {
                                                         if($i <= $row_senin && $hari[$j] == 'senin'){
//                                                              //echo '<td>'.$i.' - '.$hari[$j]. ' = '.$row_senin.'</th>';
                                                             //echo 'RABU';
                                                         }
                                                         elseif ($i <= $row_selasa && $hari[$j] == 'selasa')
                                                         {
                                                            // echo 'SELASA';
                                                         }
                                                          elseif ($i <= $row_rabu && $hari[$j] == 'rabu')
                                                         {
                                                             
                                                         }
                                                          elseif ($i <= $row_kamis && $hari[$j] == 'kamis')
                                                         {
                                                             
                                                         }
                                                          elseif ($i <= $row_jumat && $hari[$j] == 'jumat')
                                                         {
                                                             
                                                         }
                                                         else
                                                         {
                                                             echo '<td>JAM KOSONG</td>';
                                                         }
                                                        
                                                     }                                                 
                                                //echo '<th style="width: 10px">'.$i.$hari[$j].'</th>';
                                           }
                                           else
                                           {
                                               echo '<td>'.$i.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.HgetKet($i).'</td>';
                                               
                                               
                                           }
                                       
                                       }
                                       
                                   }
                               echo '</tr>';
                                   
//                                   
//                                   
//                                    echo '<tr>';
//                                    $hari= HgetHari();
//                                    for ($a=0;$a<count($hari);$a++)
//                                    {
//                                        $jadwalfix = $this->jadwal_mdl->getJadwalHarianDosen2($hari[$a],$user_email,$jam['JAM_KULIAH_ID']);
//                                        if ($hari[$a] == '0')
//                                        {
//                                            echo '<th style="width: 10px">'.$jam->JAM_KULIAH_ID.'</th>';;
//                                        }
//                                        else
//                                        {
//                                            
//                                            if($jam->JAM_KULIAH_ID == 1)
//                                            {
//                                                echo '<th style="width: 10px">'.strtoupper($hari[$a]).'</th>';
//                                            }else
//                                            {
//                                                if($jadwalfix != '')
//                                                {
//                                                foreach($jadwalfix as $jad)
//                                                {
//                                                   echo '<th rowspan="'.$jad->JAM_MK.'" style="width: 10px"> <p>'.$jad->KELAS_NAMA. '<br> R'.$jad->RUANGAN_ID.'<br>'.
//                                                           $jad->JAM_MULAI.' - '.$jad->JAM_SELESAI.''
//                                                           .'</p></th>';                                                 
//                                                }
//
//                                            }
//                                        }}
//                                    }
//                                    echo '</tr>';
                               }
                                   ?>
                          </table>
                                <?php echo form_close() ?>
                            </div>
            <!-- /.box-body -->
                    </div>
                    </div>
                       
                    
                    
		</div> <!-- End Row -->
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

<script src="<?php echo base_url('/assets/js/JS_admin_edit_jadwal.js') ?>"></script>
       
 <div class="modal fade" id="modal-simpan">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php echo form_open('admin/save-edit', $f_attribute); 
                    //hidden form
                   
                   //end hidden form
              ?>
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Ubah Jadwal Kuliah</h4>
              </div>
              <div class="modal-body">
                
                

                 <div class="form-group">
                    <div class="col-lg-12">
                        <label>Kelas</label>
                    </div> 
                    <div class="col-lg-12"> 
                       <?php echo form_input($a_mkelas); 
                       
                       echo form_input($a_ijadwal); 
                       ?>
                    </div> 
                 </div>
                  
                <div class="form-group">
                    <div class="col-lg-12">
                        <label>Mata Kuliah</label>
                    </div> 
                    <div class="col-lg-12"> 
                       <?php echo form_dropdown('dmatakuliah', $matakuliah, 'pilih',$a_matakuliah); ?>
                       
                    </div> 
                </div>
                  
                <div class="form-group">
                    <div class="col-lg-12">
                        <label>Dosen</label>
                    </div> 
                    <div class="col-lg-12"> 
                       <?php echo form_dropdown('ddosen', $dosen, 'pilih',$a_dosen); ?>
                       
                    </div> 
                </div>
                  <div class="form-group">
                    <div class="col-lg-12">
                        <label>Hari</label>
                    </div> 
                    <div class="col-lg-12"> 
                        <?php 
                        $dhari_array = array('senin','selasa');
                        echo form_dropdown('dhari', $dhari, '0',$a_hari); ?>
                    </div> 
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <label>Jam</label>
                    </div> 
                    <div class="col-lg-12"> 
                        <?php echo form_dropdown('djam', $jam, 'pilih',$a_jam); ?>
                    </div> 
                </div>
                  <div class="form-group">
                    <div class="col-lg-12">
                        <label>Ruangan</label>
                    </div> 
                    <div class="col-lg-12"> 
                       <?php echo form_dropdown('druangan', $ruangan, 'pilih',$a_ruangan); ?>
                    </div> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php 
                echo form_submit('btnSave', 'Simpan', 'id="btnSave" class="btn btn-success"'); 
                //echo form_submit('btnSave', 'Delete', 'id="btnSave" class="btn btn-success hidden"'); 
                ?>
                <?php echo form_close() ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

<!--Modal Delete-->
 <div class="modal fade" id="modal-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php echo form_open('admin/save-edit', $f_attribute); 
                    //hidden form
                   
                   //end hidden form
              ?>
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Form Hapus Jadwal</h4>
              </div>
              <div class="modal-body">
                   <div class="form-group">
                    <div class="col-lg-12">
                        <label class="text-red">PERINGATAN ! </label>
                    </div> 
                    <div class="col-lg-12"> 
                        <p> Apakah anda yakin ingin menghapus Jadwal ini?</p>
                       <?php
                        
                       echo form_input($a_ijadwal2); 
                       ?>
                    </div> 
                 </div>
                
  <div class="form-group">
                    <div class="col-lg-12">
                        <label>Detail :</label>
                    </div> 
                    <div class="col-lg-12"> 
                        <?php echo form_textarea($a_iket); ?>
                    </div> 
                    <div class="col-sm-2"> </div> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php 
                echo form_submit('btnSave', 'Hapus', 'id="btnSave" class="btn btn-danger"'); 
                ?>
                <?php echo form_close() ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

