<?php
$getdata = $this->session->userdata('logged_in');
$user_image = $getdata['user_images'];
$user_nama = $getdata['user_nama'];
?>
<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= base_url('admin/dashboard') ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SIP</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SIP </b>PCR</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                                <?php 
                                $user = $this->ses_data['user_email'];
                                $akses= $this->ses_data['user_akses'];
                                $jumlahNotif = getTotNotifReq($user,$akses); 
                                //$jumlahNotif = 0; 
                                if($jumlahNotif>0):?>
                                <span class="label label-warning"><?= $jumlahNotif ?></span>
                                <?php endif; ?>
                            
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"> 
                                <?php if($jumlahNotif>0):?>
                                Anda Memiliki <?= $jumlahNotif ?> Request Pergantian jadwal
                                <?php else: ?>
                                Tidak ada Request Pergantian Jadwal
                                <?php endif; ?>
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php 
                                    $notifUnread = getListNotifReq($user);
                                    $f_attribute = array(
                                    'class'     => 'form-horizontal hidden',
                                    'id'        => 'freaddetail',
                                    'name'      => 'freaddetail');
                                    $a_ijadwal_ganti_id = array (
                                      'class' => 'form-control hidden',
                                      'id' => 'ijadwal_ganti_id',
                                      'name' => 'ijadwal_ganti_id');

                                    
                                    echo form_open('notif/detail', $f_attribute); 
                                    echo form_input($a_ijadwal_ganti_id); 
                                    echo form_close();
                                     
                                    foreach ($notifUnread as $row)
                                    {?>
                                    <li>                
                                          <a href="#" onclick="readNotif('<?= $row->JADWAL_GANTI_ID ?>')">
                                            <i class="fa fa-users text-aqua"></i>Perubahan Jadwal Matakuliah <?= $row->MATA_KULIAH_NAMA ?>
                                        </a>
                                    </li> 
                                    
                                    <?php 
                                    }
                                    
                                    ?>
                                    
                                    
                                </ul>
                            </li>
                            <li class="footer"><a href="<?= base_url('jadwal/ganti/list')?>">View all</a></li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_url($user_image)?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= $user_nama ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?=base_url($user_image)?>" class="img-circle" alt="User Image">

                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
									<?php $session_data = $this->session->userdata('logged_in');?>
                                    <a href="<?= HGetProfilPath($session_data['user_akses'])?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= base_url($user_image) ?>" class="img-circle" alt="User Image XX">
                </div>
                <div class="pull-left info">
                    <p><?= $user_nama; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="#">
                      <i class="fa fa-laptop"></i>
                      <span>Manage Jadwal Kuliah</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?= base_url('admin/manage/jadwal/add')?>"><i class="fa fa-circle-o"></i> Add</a></li>
                      <li><a href="<?= base_url('admin/manage/jadwal/edit')?>"><i class="fa fa-circle-o"></i> Edit/Delete</a></li>
                    </ul>
                </li> 
                <li>
                    <a href="<?= base_url('admin/manage/kalender')?>">
                        <i class="fa fa-calendar-plus-o"></i> <span>Manage Kalender Akademik</span>

                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/manage/event')?>">
                        <i class="fa fa-calendar-check-o"></i> <span>Manage Event PCR</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/approval')?>">
                        <i class="fa fa-calendar-check-o"></i> <span>Approval Ganti Jadawal</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('jadwal/ganti/list')?>">
                        <i class="fa fa-bell-o"></i> <span>Perubahan Jadwal</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->


