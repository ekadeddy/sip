<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/mahasiswa/navbar_mahasiswa_view');
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Jadwal Kuliah
			</h1>
			<ol class="breadcrumb">
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
                                                
                                                   
                                                $jadwalfix = $this->jadwal_mdl->getJadwalHarianMahasiswa($hari[$j],$user_email,$i);
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
                                                             echo '<td rowspan="'.$jad->JAM_MK.'" >'.$bar.' <p>'.$jad->KELAS_NAMA.'<br>'.$jad->MATA_KULIAH_NAMA. '<br> R'.$jad->RUANGAN_ID.'<br>'.
                                                           $jad->JAM_MULAI.' - '.(($jad->JAM_JK+$jad->JAM_MK)-1).':45:00</p></th>';
                                                             
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
                                                             echo '<td> -- </th>';
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
