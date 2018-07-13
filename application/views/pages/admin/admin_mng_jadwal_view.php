<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');
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
			<li class="active">Manage Jadwal Kuliah</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
<!--		MANAGE-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<h3 class="panel-title"><b>MANAGE SEMESTER <?= $semester?> </b></h3>
							</div>

						</div>
					</div>
					<div class="panel-body">
						<?php if( $feedback = $this->session->flashdata('feedback')):
							$feedback_class = $this->session->flashdata('feedback_class');
							?>
							<div class="row">
								<div class="col-lg-12">
									<div class="alert alert-dismissible <?= $feedback_class ?>">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<?= $feedback ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="container-fluid">
							<div class="row-fluid">
								<div class="span12">
									<div class="table-wrapper">
										<div class="scrollable">
											<table class="table table-striped">
												<thead>
												<tr>
													<?php for ($j=0;$j<=5;$j++) {?>
														<td align="left">
															<?php
															if ($j==0)
															{?>
																<b></b>
															<?php
															}
															else
															{?>
																<b><?= ucwords($hari[$j]) ?></b>
															<?php
															}
															?>
														</td>
													<?php } ?>
												</tr>
												</thead>
												<tbody>
												<?php
												//for ($i=0;$i<9;$i++) {

													?>
													<tr>
														<?php for ($j=0;$j<=5;$j++) {
															$ship = array(
																'class' => 'btn btn-warning btn-xs m-b-5',
																'title' => 'Good JOb');
															//$ads = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">';
															//$edit = anchor(''.$semester.'/'.$hari[$j],'<i class="glyphicon glyphicon-pencil"></i>',$ship)
															$edit = anchor('admin/edit-jadwal/'.$semester.'/'.$hari[$j],'<i class="glyphicon glyphicon-pencil"></i>',$ship)
															?>
															<td align="left">
															<?php
															if ($j==0)
															{?>
																<b>Action</b>
																<?php
															}
															else
															{?>
																	<div class="outer2">
																		<div class="inner wrap">
																			<div class="row">
																				<div class="col-lg-8 text-left">
																					<?=  $edit ?>
																				</div>
																				<div class="col-lg-2 text-left">
																					<?php
																					if ($j%2==0)
																					{
																						$vhari='Y';
																					}
																					else
																					{
																						$vhari='N';
																					}
																					if($vhari =='Y')
																					{ ?>
																						<span class='glyphicon glyphicon-ok-circle text-success'></span>
																					<?php
																					}
																					else
																					{ ?>
																						<span class='glyphicon glyphicon-remove-circle text-danger'></span>
																					<?php
																					} ?>

																				</div>
																			</div>
																		</div>
																	</div>
																<?php
															}
															?>
															</td>

														<?php } ?>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<i><u>Keterangan</u> :  </i><br>
									<span class='glyphicon glyphicon-ok-circle text-success'></span> = Data telah diverifikasi.  &nbsp
									<span class='glyphicon glyphicon-remove-circle text-danger'></span> = Data Belum diverifikasi.  &nbsp
									<button type='button' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-pencil'></span></button> = Ubah Data.  &nbsp

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- End Row -->
<!--		VIEW-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<h3 class="panel-title"><b>MANAGE SEMESTER <?= $semester?> </b></h3>
							</div>

						</div>
					</div>
					<div class="panel-body">

						<div class="container-fluid">
							<div class="row-fluid">
								<div class="span12">
									<div class="table-wrapper">
										<div class="scrollable">
											<table class="table table-striped">
												<thead>
												<tr>
													<?php for ($j=0;$j<=5;$j++) {?>
														<td align="left">
															<?php
															if ($j==0)
															{?>
																<b></b>
																<?php
															}
															else
															{?>
																<b><?= $hari[$j] ?></b>
																<?php
															}
															?>
														</td>
													<?php } ?>
												</tr>
												</thead>
												<tbody>
												<?php
												//for ($i=0;$i<9;$i++) {
												foreach ($jam_kuliah as $jam)
												{
													$edit = "<button class='btn btn-warning btn-xs m-b-5' onclick=''><i class='glyphicon glyphicon-pencil'></i></button>";
												?>
												<tr>
													<?php for ($j=0;$j<=5;$j++) {?>
														<td align="left">
															<?php
															if ($j==0)
															{?>
																<b>

																	<?= $jam['JAM_KULIAH_ID'] ?>
																</b>
																<?php
															}
															else
															{?>
																<div class="outer2">
																	<div class="inner wrap">
																		<div class="row">
																			<div class="col-lg-8 text-left">
																				<?=  $edit ?>
																			</div>
																			<div class="col-lg-2 text-left">
																				<?php
																				if ($j%2==0)
																				{
																					$vhari='Y';
																				}
																				else
																				{
																					$vhari='N';
																				}
																				if($vhari =='Y')
																				{ ?>
																					<span class='glyphicon glyphicon-ok-circle text-success'></span>
																					<?php
																				}
																				else
																				{ ?>
																					<span class='glyphicon glyphicon-remove-circle text-danger'></span>
																					<?php
																				} ?>

																			</div>
																		</div>
																	</div>
																</div>
																<?php
															}
															?>
														</td>

													<?php } ?>
												</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									<i><u>Keterangan</u> :  </i><br>
									<span class='glyphicon glyphicon-ok-circle text-success'></span> = Data telah diverifikasi.  &nbsp
									<span class='glyphicon glyphicon-remove-circle text-danger'></span> = Data Belum diverifikasi.  &nbsp
									<button type='button' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-pencil'></span></button> = Ubah Data.  &nbsp

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- End Row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('layout/footer_view'); ?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><?= $semester ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>

							<div class="col-sm-10">
								<?php echo form_dropdown('dosen', $dosen, 'pilih',$ldosen_s); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Password</label>

							<div class="col-sm-10">
								<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
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
						<button type="submit" class="btn btn-info pull-right">Sign in</button>
					</div>
					<!-- /.box-footer -->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
