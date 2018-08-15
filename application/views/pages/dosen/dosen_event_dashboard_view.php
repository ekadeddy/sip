<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/dosen/navbar_dosen_view');
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Event PCR
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> <?= $user_akses ?></a></li>
				<li class="active">Event PCR</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-12">
					
			                <!-- Notification -->
			             
			            
			   
                    <div id='calendar'></div>
			               
			            
			       

			        <!--  -->	
				</div>
			</div>


		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

    <!-- modal add -->

    <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="error"></div>
                        <form class="form-horizontal" id="crud-form">
                        <!-- <input type="hidden" id="start">
                        <input type="hidden" id="end"> -->
                        <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="title">Title</label>
                                <div class="col-md-10">
                                    <input id="title" name="title" type="text" class="form-control input-md" />
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="description">Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                            </div>
                         <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Color</label>
                            <div class="col-sm-10">
                                <select name="color" id="color" class="form-control">
                                    <option value="">Choose</option>
                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>                       
                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                    <option style="color:#000;" value="#000">&#9724; Black</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Start Date</label>
                            <div class="col-sm-10">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" id="start" name="start" class="form-control" readonly>
                                    <span class="input-group-addon"><i class="fa fa-calendar font-dark"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">End Date</label>
                            <div class="col-sm-10">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" id="end" name="end" class="form-control" readonly>
                                    <span class="input-group-addon"><i class="fa fa-calendar font-dark"></i></span>
                                </div>
                            </div>
                        </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


<?php $this->load->view('layout/footer_view'); ?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/fullcalendar/fullcalendar.min.css" />
<script src="<?php echo base_url() ?>assets/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>assets/fullcalendar/gcal.js"></script>
<script src='<?php echo base_url() ?>assets/js/main.js'></script>


<script src='<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'></script>  
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>">
