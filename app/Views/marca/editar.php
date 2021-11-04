<?= $header ?>
<?= $menu ?>

<?php
    $errores = \Config\Services::validation();    
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-5">
    <h2 class="display-5 mb-3 fw-bold">Editar Marca</h2>    
    <form class="row my-4 g-3" action="<?= site_url("admin/marca/modificar") ?>" method="POST">

        <input type="hidden" name="codigo" value="<?= $marca['codigo'] ?>">
        <input type="hidden" name="estado" value="<?= $marca['estado'] ?>">
        <div class="row col-md-4">
            <label for="nombre" class="badge bg-primary my-3 col-form-label">Nombre de la marca</label>
            <input type="text" class="form-control <?= $errores->getError('nombre') ? 'is-invalid' : ''; ?>" id="nombre"
                name="nombre" value="<?= old('nombre', $marca['nombre']); ?>" data-validetta="required,minLength[2],maxLength[100]">

                <?php if($errores->getError('nombre')) : ?>
                <div class="invalid-feedback">
                    <?= $error_nombre = $errores->getError('nombre'); ?>
                </div>
                <?php endif; ?>
        </div>

        <div class="col-12 my-5">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-refresh align-middle" aria-hidden="true"></i>
                <span class="align-middle">Editar</span></button>
            <a class="btn btn-dark" href="<?= site_url('admin/marca/index'); ?>">
                <i class="fa fa-home align-middle" aria-hidden="true"></i>
                <span class="align-middle">Regresar</span></a>
        </div>

    </form>

</main>

<?= $footer ?>