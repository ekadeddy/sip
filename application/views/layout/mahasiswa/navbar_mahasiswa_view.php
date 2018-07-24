<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= base_url('mahasiswa/dashboard') ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SI</b>P</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SIP</b>PCR</span>
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

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                                <?php 
                                $email = $this->ses_data['user_email'];
                                $akses= $this->ses_data['user_akses'];
                                $jumlahNotif = totNotifMhsUnread($email); 
                                
                                if($jumlahNotif>0):?>
                                <span class="label label-warning"><?= $jumlahNotif ?></span>
                                <?php endif; ?>
                            
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Anda Memiliki <?= jumlahNotifUnread($email,$akses) ?> Notifikasi belum dibaca</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php 
                                    //notif mahasiswa
                                    $notifUnread = notifMhsUnread($email,$akses);
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
                                            <i class="fa fa-users text-aqua"></i><?= $row->JADWAL_GANTI_ID ?>Perubahan Jadwal Matakuliah <?= $row->MATA_KULIAH_NAMA ?>
                                        </a>
                                    </li> 
                                    
                                    <?php 
                                    }
                                    
                                    ?>
                                    
                                    
                                </ul>
                            </li>
                            <li class="footer"><a href="<?= base_url('mahasiswa/jadwal/perubahan')?>">View all</a></li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_url($user_image) ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= $user_nama ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= base_url($user_image) ?>" class="img-circle" alt="User Image">

                                <p>
                                    <?= $user_nama ?>
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= base_url('mahasiswa/profil') ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

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
                <li>
                    <a href="<?= base_url('mahasiswa/jadwal')?>">
                        <i class="fa fa-calendar"></i> <span>Jadwal Mata Kuliah</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('mahasiswa/kalender')?>">
                        <i class="fa fa-calendar-plus-o"></i> <span>Kalender Akademik</span>

                    </a>
                </li>
                <li>
                    <a href="<?= base_url('mahasiswa/event')?>">
                        <i class="fa fa-calendar-check-o"></i> <span>Event PCR</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('mahasiswa/jadwal/perubahan')?>">
                        <i class="fa fa-bell-o"></i> <span>Perubahan Jadwal</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->


