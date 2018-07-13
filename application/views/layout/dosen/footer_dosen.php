<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->

<script src="<?php echo base_url('/assets/js/jquery.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Select2 -->
<!--<script src="<?php //echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>-->
<!-- InputMask -->
<!--<script src="<?php// echo base_url('/assets/templates/AdminLTE-2.4.3/plugins/input-mask/jquery.inputmask.js') ?>"></script>-->
<!--<script src="<?php //echo base_url('/assets/templates/AdminLTE-2.4.3/plugins/input-mask/jquery.inputmask.date.extensions.js') ?>"></script>-->
<!--<script src="<?php // / echo base_url('/assets/templates/AdminLTE-2.4.3/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>-->
<!-- date-range-picker -->
<!--<script src="<?php //echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/moment/min/moment.min.js') ?>"></script>-->
<!--<script src="<?php // echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>-->
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<!-- bootstrap color picker -->
<!--<script src="<?php //echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') ?>"></script>-->
<!-- bootstrap time picker -->
<!--<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>-->
<!-- SlimScroll -->
<!--<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>-->
<!-- iCheck 1.0.1 -->
<!--<script src="../../plugins/iCheck/icheck.min.js"></script>-->
<!-- FastClick -->
<!--<script src="<?php // echo base_url('/assets/templates/AdminLTE-2.4.3/bower_components/fastclick/lib/fastclick.js') ?>"></script>-->
<!-- AdminLTE App -->
<script src="<?php echo base_url('/assets/templates/AdminLTE-2.4.3/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('/assets/templates/AdminLTE-2.4.3/dist/js/demo.js') ?>"></script>
<!-- Page script -->
<script>
 $(function () {
    //Initialize Select2 Elements

    //Date picker
    $('#itanggal').datepicker({
      autoclose: true
    })

  });    
</script>
    