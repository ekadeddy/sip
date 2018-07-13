<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');
        
        //Att
        
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

//untuk modal
$a_mkelas = array(
	'type'  => 'text',
	'name'  => 'ikelas',
	'id'    => 'ikelas',
	'value' => 'asa',
	'class' => 'form-control',
	'readonly' => 'readonly'
);
$a_matakuliah = array(
	'class'     => 'form-control select2',
	'id'        => 'dmatakuliah',
	'name'      => 'dmatakuliah');
$a_jam = array(
	'class'     => 'form-control select2',
	'id'        => 'djam',
	'name'      => 'djam');
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

	<!-- Main content -->
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
                          <?php echo form_open('admin/manage/edit/jadwal', $f_attribute); ?>
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
                                                                <button type="button" onclick="approvalSave()" class="btn btn-success btn-xs m-b-12"><i class='glyphicon glyphicon-pencil'></i></button>
                                                                <button type="button"  onclick="approvalSave()" class="btn btn-danger btn-xs m-b-12"><i class='glyphicon glyphicon-remove'></i></button>
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
                                
                                <?php echo form_submit('btnSave', 'Simpan', 'class="btn btn-success pull-right"') ?>
                                <?php echo form_close() ?>
                            </div>
            <!-- /.box-body -->
                    </div>
                    </div>
                    
                    
		</div> <!-- End Row -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('layout/footer_view'); ?>

<script src="<?php echo base_url('/assets/js/JS_admin_edit_jadwal.js') ?>"></script>
       
 <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php echo form_open('admin/save-approval', $f_attribute); ?>
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
                       <?php echo form_input($a_mkelas); ?>
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
                <?php echo form_submit('btnSave', 'Simpan', 'id="btnSave" class="btn btn-success"') ?>
                <?php echo form_close() ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

