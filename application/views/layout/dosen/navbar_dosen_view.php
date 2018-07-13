<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= base_url('dosen/dashboard') ?>" class="logo">
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
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=  base_url('assets/templates/AdminLTE-2.4.3/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Perubahan Jadwal
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Matakuliah Kewarganegaraan hari ini dibatalakn</p>
                                        </a>
                                    </li>
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=  base_url($user_image) ?>" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Perubahan Jadwal
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Matakuliah English hari ini dibatalakan</p>
                                        </a>
                                    </li>
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=  base_url($user_image) ?>" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Perubahan Jadwal
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Matakuliah English hari ini dibatalakan</p>
                                        </a>
                                    </li>
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=  base_url($user_image) ?>" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Perubahan Jadwal
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Matakuliah English hari ini dibatalakan</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Anda Memiliki 4 Notifikasi</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> Matakuliah English hari ini dibatalakn
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> Matakuliah Kewarganegaraan hari ini dibatalakn
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> Matakuliah B.Indo hari ini dibatalakn
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> Matakuliah Alpro hari ini dibatalakn
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
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
                                    <a href="<?= base_url('dosen/profil') ?>" class="btn btn-default btn-flat">Profile</a>
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
                <li class="header text-center">MENU UTAMA</li>
                <li>
                    <a href="<?= base_url('dosen/dashboard')?>">
                        <i class="fa fa-calendar"></i> <span>BERANDA</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('dosen/jadwal-kuliah')?>">
                        <i class="fa fa-calendar-plus-o"></i> <span>Jadwal Mata Kuliah</span>

                    </a>
                </li>
                <li>
                    <a href="<?= base_url('dosen/kalender-akademik')?>">
                        <i class="fa fa-calendar-check-o"></i> <span>Kalender Akademik</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('dosen/event-pcr')?>">
                        <i class="fa fa-bell-o"></i> <span>Event PCR</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('dosen/jadwal-ubah')?>">
                        <i class="fa fa-bell-o"></i> <span>Ubah Jadwal Mata Kuliah</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->


