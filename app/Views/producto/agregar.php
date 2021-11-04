<?= $header ?>
<?= $menu ?>

<?php
    if(isset(session()->getFlashdata('errores')['nombre']))
    {
        $error_nombre = session()->getFlashdata('errores')['nombre'];
    }

    if(isset(session()->getFlashdata('errores')['marca']))
    {
        $error_marca = session()->getFlashdata('errores')['marca'];
    }

    if(isset(session()->getFlashdata('errores')['precio']))
    {
        $error_precio = session()->getFlashdata('errores')['precio'];
    }
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-5">
        <h2 class="display-5 mb-3 fw-bold">Agregar Producto</h2>    
    <form class="row my-4 g-3" action="<?= site_url("admin/producto/insertar") ?>" method="POST">

        <div class="col-md-4">
            <label for="nombre" class="badge bg-primary my-3">Nombre del producto</label>
            <input type="text" class="form-control <?= isset($error_nombre) ? 'is-invalid' : ''; ?>" id="nombre"
                name="nombre" value="<?= old('nombre'); ?>" data-validetta="required,minLength[2],maxLength[60]">

            <?php if(isset($error_nombre)) : ?>
            <div class="invalid-feedback">
                <?= $error_nombre; ?>
            </div>
            <?php endif; ?>

        </div>

        <div class="col-md-4">
            <label for="marca" class="badge bg-primary my-3">Marca</label>
            <select class="form-select <?= isset($error_marca) ? 'is-invalid' : ''; ?>" id="marca" name="marca" value="<?= old('marca'); ?>"
                data-validetta="minSelected[1],maxSelected[1]">
                <option value="" disabled>Seleccionar marca ...</option>
                <?php foreach($marcas as $marca): ?>
                <option value="<?= $marca->codigo; ?>"><?= $marca->nombre ?></option>
                <?php endforeach; ?>
            </select>

            <?php if(isset($error_marca)) : ?>
            <div class="invalid-feedback">
                <?= $error_marca; ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-3">
            <label for="precio" class="badge bg-primary my-3">Precio</label>
            <input type="number" name="precio" id="precio" value="<?= old('precio'); ?>"
                class="form-control <?= isset($error_precio) ? 'is-invalid' : ''; ?>" step="0.01" min="0.01"
                data-validetta="required,number">

            <?php if(isset($error_precio)) : ?>
            <div class="invalid-feedback">
                <?= $error_precio; ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-12 my-5">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-refresh align-middle" aria-hidden="true"></i>
                <span class="align-middle">Agregar</span></button>
            <a class="btn btn-dark" href="<?= site_url('admin/producto/index'); ?>">
                <i class="fa fa-home align-middle" aria-hidden="true"></i>
                <span class="align-middle">Regresar</span></a>
        </div>

    </form>

</main>

<?= $footer ?>

<script>
    $('select[name="marca"]').val('<?= old('marca'); ?>').change();
</script>