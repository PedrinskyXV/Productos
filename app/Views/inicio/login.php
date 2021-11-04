<?=$header?>

<div class="container">
    <div class="row align-items-center justify-content-center vh-100">
        <div class="col-lg-4 col-md-4 col-sm-12 shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <h2 class="text-center pt-3 lead fw-bold display-4 my-5">Bienvenido</h2>                
                <form action="<?=base_url('/autentificar');?>" method="POST">

                    <span class="badge rounded-pill bg-dark">Usuario</span>
                    <input type="text" class="form-control mb-3" name="usuario">
                    <span class="badge rounded-pill bg-dark">Contraseña</span>
                    <input type="password" class="form-control mb-3" name="clave">

                    <?php if (session()->getFlashdata('msg')): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                        <div>
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <div>
                            <?=session()->getFlashdata('msg')?>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif;?>

                    <div class="col mt-5">
                        <button class="btn btn-dark btn-sm w-100"> <i class="fa-solid fa-right-to-bracket"></i>
                            Iniciar Sesión</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-center text-white mt-5 p-3 fixed-bottom">
    &copy; 2021 Copyright: <span class="text-decoration-underline">Pedro Pérez</span>
</footer>

<?=$footer?>