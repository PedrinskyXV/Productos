<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">MVC</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
        data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Buscar ..." aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link text-dark px-3 btn btn-warning fw-bold" href="<?= base_url('/logout'); ?>"><i
                    class="fa-solid fa-door-closed"></i> Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= site_url('admin/index'); ?>">
                            <i class="fa-solid fa-home" aria-hidden="true"></i>
                            Bienvenido <?= session()->get('usuario') ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/producto/index'); ?>">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/marca/index'); ?>">
                            <i class="fa-solid fa-certificate"></i>
                            Marcas
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reportes</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <i class="fa fa-archive" aria-hidden="true"></i>
                    </a>
                </h6>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/reporte/productosPDF') ?>" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i>
                            Productos
                        </a>
                    </li>
                </ul>
            </div>
        </nav>