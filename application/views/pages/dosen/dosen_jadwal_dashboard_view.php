<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/dosen/navbar_dosen_view');
        //attribute
        
        //modal ganti jadwal
        //untuk modal
        
        $f_attribute = array(
	'class'     => 'form-horizontal',
	'id'        => 'fgantijadwal',
	'name'      => 'fgantijadwal');
        $a_iket = array(
	'class'     => 'form-control select2',
	'id'        => 'iket',
	'name'      => 'iket',
         'rows'      => '3',
        'placeholder' => '...'
    );
        $a_itanggal = array (
        'id' => 'itanggal',
        'name' => 'itanggal',
        'class' => 'form-control pull-right',
        'placeholder' => '2017/05/20'
        );
        $a_ijadwal = array (
        'class' => 'form-control hidden',
        'id' => 'ijadwal_id',
        'name' => 'ijadwal_id',
         'type' => 'hidden'
        );
        $a_iharih = array (
        'class' => 'form-control hidden',
        'id' => 'iharih',
        'name' => 'iharih',
         'type' => 'hidden'
        );
        $a_mkelas = array(
                'type'  => 'text',
                'name'  => 'ikelas',
                'id'    => 'ikelas',
                'class' => 'form-control',
                'readonly' => 'readonly'
        );
        $a_mmatakuliah = array(
                'type'  => 'text',
                'name'  => 'imatakuliah',
                'id'    => 'imatakuliah',
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
        $a_npertemuan = array(
                'class'     => 'form-control select2',
                'id'        => 'npertemuan',
                'name'      => 'npertemuan');
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
        //end modal ganti jadwal
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Jadwal Kuliah
			</h1>
			<ol class="breadcrumb">
                            
                            <?php   if( $feedback = $this->session->flashdata('feedback')):
                                $feedback_class = $this->session->flashdata('feedback_class'); 
                                $txt_alert = $this->session->flashdata('txt_alert');
                    ?>
                    
                                <!--        Toastr    -->

                                <div id="snackbar">
                                    <div class="alert alert-dismissible <?= $feedback_class ?>">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-check"></i> <?= $txt_alert ?></h4>
                                     <?= $feedback ?>
                                    </div>
                                </div>
                            <!--end toastr -->
                    
                               <script type="text/javascript"> 
                                    var x = document.getElementById("snackbar");
                                    x.className = "show";
                                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
                                </script>
                    <?php   endif; ?>
                            
				<li><a href="#"><i class="fa fa-dashboard"></i> <?= $user_akses ?></a></li>
				<li class="active">Jadwal Kuliah</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
                    <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">JADWAL ANDA</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
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
                                               
                                               echo '<th>'.strtoupper($hari[$j]).'</th>';
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
                                                
                                                $items = array('#f56954','#00c0ef','#f39c12','#d2d6de','#605ca8','#D81B60','#39CCCC');    
                                                $jadwalfix = $this->jadwal_mdl->getJadwalHarianDosen($hari[$j],$user_email,$i);
                                                //$jadwalfix = $this->jadwal_mdl->getJadwalHarianDosen2($hari[$a],$user_email,$jam['JAM_KULIAH_ID']);
                                                
                                                     if($jadwalfix != false)
                                                     {
                                                        foreach ($jadwalfix as $jad)
                                                       { 
                                                            if ($hari[$j] == 'senin')
                                                            {
                                                                $bg_td ='style="background-color:'.$items[array_rand($items,1)].'"';
                                                                $row_senin = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-warning bg-maroon" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'selasa')
                                                            {
                                                                $row_selasa = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bg_td ='style="background-color:'.$items[array_rand($items,1)].'"';
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-warning" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'rabu')
                                                            {
                                                                $row_rabu = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bg_td ='style="background-color:'.$items[array_rand($items,1)].'"';
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-success" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'kamis')
                                                            {
                                                                $row_kamis = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bg_td ='style="background-color:'.$items[array_rand($items,1)].'"';
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-info" style="width: 100%"></div></div>';
                                                            }
                                                            elseif ($hari[$j] == 'jumat')
                                                            {
                                                                $row_jumat = $jad->JAM_MK+$jad->JAM_KULIAH_ID-1;
                                                                $bg_td ='style="background-color:'.$items[array_rand($items,1)].'"';
                                                                $bar = ' <div class="progress progress-xs"><div class="progress-bar progress-bar-purple" style="width: 100%"></div></div>';
                                                            }
//                                                             echo '<td rowspan="'.$jad->JAM_MK.'" >'.$bar.' <p>'.$jad->KELAS_NAMA.'<br>'.$jad->MATA_KULIAH_NAMA. '<br> R'.$jad->RUANGAN_ID.'<br>'.
//                                                           $jad->JAM_MULAI.' - '.$jad->JAM_SELESAI.'</p></th>';
                                                              echo '<td '.$bg_td.' class="text-center" rowspan="'.$jad->JAM_MK.'" >'.$bar.' <p>'.$jad->KELAS_NAMA.'<br>'.$jad->MATA_KULIAH_NAMA. '<br> R'.$jad->RUANGAN_ID.'<br>'.
                                                           $jad->JAM_MULAI.' - '.(($jad->JAM_JK+$jad->JAM_MK)-1).':45:00</p></th>';
                                                              
                                                             ?>
                                                            <span class="text-center">
                                                                <button type="button" onclick="gantiJadwal('<?= $jad->JADWAL_ID ?>')" class="btn btn-success  btn-md m-b-12"><i class='glyphicon glyphicon-wrench'></i></button>
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
                                                             echo '<td>--</th>';
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
                        </div>
        <!-- /.box-body -->
                    </div>  


		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

<?php $this->load->view('layout/footer_view'); ?>
<script src="<?php echo base_url('/assets/js/JS_dosen_ubah_jadwal.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/JS_dosen_ruangan.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/toastr.js') ?>"></script>

<!--modal edit-->
 <div class="modal fade" id="modal-ganti-jadwal">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php echo form_open('dosen/save-perubahan-jadwal', $f_attribute); 
                    //hidden form
                   
                   //end hidden form
              ?>
              
              <div class="modal-header bg-navbar">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title text-center text-white"><b>Ganti Jadwal Kuliah</b></h4>
              </div>
              <div class="modal-body">
                
                

                 <div class="form-group">
                    <label class="col-sm-3 control-label">Kelas</label>
                        <div class="col-lg-9">
                       <?php echo form_input($a_mkelas); 
                        echo form_input('ijadwal_id','',$a_ijadwal);
                       //echo form_input($a_ijadwal); 
                       ?>
                    </div> 
                 </div>
                  
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mata Kuliah</label>
                        <div class="col-lg-9">
                        <?php echo form_input($a_mmatakuliah);  ?>
                       
                    </div> 
                </div>
                  
                    <div class="col-lg-12"><hr></div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Banyak Pertemuan</label>
                        <div class="col-lg-9">
                        <?php echo form_dropdown('npertemuan', $npertemuan, '1',$a_npertemuan); ?>
                    </div> 
                </div>
                    
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal</label>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo form_input('itanggal','',$a_itanggal);
                                        echo form_input('iharih','',$a_iharih);
                                        ?>
                              </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                 
                <div class="form-group">
                    <label class="col-sm-3 control-label">Jam</label>
                        <div class="col-lg-9">
                        <?php echo form_dropdown('djam', $jam, 'pilih',$a_jam); ?>
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Ruangan</label>
                        <div class="col-lg-9">
                            
                       <?php echo form_dropdown('druangan', $ruangan, 'pilih',$a_ruangan); ?>
                    </div> 
                </div>
                <div class="form-group" >
                    <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-lg-9">
                            <?php echo form_textarea($a_iket); ?>
                    </div>
            </div>
              </div>
              <div class="modal-footer bg-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php 
                echo form_submit('btnSave', 'Request', 'id="btnSave" class="btn btn-success"'); 
                //echo form_submit('btnSave', 'Delete', 'id="btnSave" class="btn btn-success hidden"'); 
                ?>
                <?php echo form_close() ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
<!--end modal edit-->       
<!--<script src="<?php  echo base_url('/assets/js/JS_dosen_jadwal.js') ?>"></script>-->