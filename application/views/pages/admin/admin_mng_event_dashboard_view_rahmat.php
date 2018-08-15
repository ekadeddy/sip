<?php
	$this->load->view('layout/header_view');
	$this->load->view('layout/admin/navbar_admin_view');
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Manage Event PCR
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
				<li class="active">Manage Event PCR</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-12">
						<div id='calendar'></div>
				</div>
			</div>


		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" method="POST" id="myForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="error"></div>
                    <form class="form-horizontal" id="crud-form">

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
                                <option style="color:#5484ED;" value="9">&#9724; DARK BLUE</option>
                                <option style="color:#7AE7BF;" value="7">&#9724; TURQOISE</option>
                                <option style="color:#51B749;" value="10">&#9724; GREEN</option>
                                <option style="color:#FBD75B;" value="5">&#9724; YELLOW</option>
                                <option style="color:#FFB878;" value="6">&#9724; ORANGE</option>
                                <option style="color:#DC2127;" value="11">&#9724; RED</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Start Date</label>
                        <div class="col-sm-10">
                            <div class="input-group date form_date col-md-7" data-date-format="yyyy-mm-dd" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" id="start" name="start" type="text" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>

                            <div class="input-group date form_time col-md-7" data-date-format="hh:ii:ss"  data-link-format="hh:ii:ss">
                                <input class="form-control" size="16" id="start_time" type="text" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                            </div>
                            <!-- <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input type="text" id="start" name="start" class="form-control" readonly>
                                <span class="input-group-addon"><i class="fa fa-calendar font-dark"></i></span>
                            </div> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">End Date</label>
                        <div class="col-sm-10">
                            <div class="input-group date form_date col-md-7" data-date="" data-date-format="yyyy-mm-dd" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" id="end" name="start" type="text" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>

                            <div class="input-group date form_time col-md-7" data-date="" data-date-format="hh:ii:ss"  data-link-format="hh:ii:ss">
                                <input class="form-control" size="16" id="end_time" type="text" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                            </div>
                            <!-- <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                <input type="text" id="end" name="end" class="form-control" readonly>
                                <span class="input-group-addon"><i class="fa fa-calendar font-dark"></i></span>
                            </div> -->
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
<script src='<?php echo base_url() ?>assets/js/JS_admin_event.js'></script>


<script src='<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'></script>  
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>">

<!-- husus datetimepicker region indonesia -->


<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker-master/v3/jquery/jquery-1.8.3.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker-master/v3/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.id.js"></script>


<script type="text/javascript">
    $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 1,
        maxView: 1,
        forceParse: 0
    });
</script>
<!-- <link href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker-master/v3/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" > -->
<link href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">