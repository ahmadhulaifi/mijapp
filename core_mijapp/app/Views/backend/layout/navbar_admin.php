<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url(); ?>/dashboard" class="nav-link">Home</a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                <!-- <span class="badge badge-warning navbar-badge">15</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><img src="<?= base_url(); ?>/asset/images/user/default.png" alt="" class="rounded-circle"></span>
                <div class="dropdown-divider"></div>


                <center class="mt-3 mb-3">
                    <a class="btn btn-success mb-2" href="#" role="button" class="dropdown-item"><i class="fas fa-edit">Edit Profile</i></a>
                    <div class="dropdown-divider"></div>
                    <a class="btn btn-success" href="<?= base_url(); ?>/logout" role="button" class="dropdown-item"><i class="fas fa-users mr-2">Logout</i></a>
                </center>




            </div>
        </li>
        <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-success">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>/dashboard" class="brand-link navbar-success">
        <img src="<?= base_url(); ?>/asset/images/logo_madrasah.png" alt="Logo Madrasah" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">MIJ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <img src="<?= base_url(); ?>/asset/images/user/<?= $user['foto']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $user['nama_lengkap']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php
                $db = \Config\Database::connect();
                // $builder = $db->table('users');

                // dd($user['role_kode']);
                $role_kode_user = $user['role_kode'];

                $querymenu = $db->table('user_menu')->select('user_menu.id,menu,icon,url,sort')->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')->where('user_access_menu.role_kode', $role_kode_user)->orderBy('user_menu.sort', 'ASC')->get()->getResultArray();

                ?>
                <?php foreach ($querymenu as $qm) : ?>
                    <li class="nav-item has-treeview">
                        <a href="<?= base_url($qm['url']); ?>" class="sub_menu nav-link <?php echo ($title == $qm['menu']) ? 'active' : '' ?>">
                            <i class="nav-icon <?= $qm['icon']; ?>"></i>
                            <p>
                                <?= $qm['menu']; ?>
                            </p>
                            <?php if ($qm['url'] == '#') : ?>
                                <i class="fas fa-angle-left right"></i>
                            <?php endif; ?>
                        </a>

                        <?php
                        $menuid = $qm['id'];

                        $querysubmenu = $db->table('user_sub_menu')->select('user_sub_menu.id,sub_menu,user_sub_menu.url,user_sub_menu.icon,user_sub_menu.is_active,user_sub_menu.sort')->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')->where('user_sub_menu.menu_id', $menuid)->where('user_sub_menu.is_active', 1)->orderBy('user_sub_menu.sort', 'ASC')->get()->getResultArray();
                        ?>

                        <?php foreach ($querysubmenu as $qsm) : ?>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url($qsm['url']); ?>" class="sub_menu nav-link <?php echo ($title == $qsm['sub_menu']) ? 'active' : '' ?>">
                                        <i class="<?= $qsm['icon']; ?>"></i>
                                        <p><?= $qsm['sub_menu']; ?></p>
                                    </a>
                                </li>
                            </ul>
                        <?php endforeach; ?>



                    </li>
                <?php endforeach; ?>

                <li class="nav-item has-treeview">
                    <a href="<?= base_url('logout'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>

                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $title; ?></a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>