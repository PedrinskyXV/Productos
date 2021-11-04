<?php helper('number'); ?>

<div class="table-responsive text-center">
    <table class="table table-striped table-hover">
        <div class="table-title bg-warning align-items-center py-3">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Administrar<b> Productos</b></h2>
                </div>
                <div class="col-sm-6 my-auto">
                    <a class="btn btn-dark" href="<?= site_url('admin/producto/agregar')?>" role="button"><i
                            class="fa fa-cart-plus" aria-hidden="true"></i> Agregar Producto</a>
                </div>
            </div>
        </div>
        <caption>Lista actual de productos</caption>
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($productos as $producto): ?>
            <tr>
                <th><?= $producto->codigo; ?></th>
                <td><?= $producto->nombre; ?></td>
                <td><?= $producto->marca_nombre; ?></td>
                <td><?= number_to_currency($producto->precio, 'USD', 'en_US', 2); ?></td>
                <?php if($producto->estado == 1): ?>
                <td><span class="badge rounded-pill bg-success">Disponible</span></td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= base_url('admin/producto/editar/'.$producto->codigo); ?>" class="btn btn-info"> <i
                                class="fa fa-refresh" aria-hidden="true"></i> Editar</a>
                        <a href="<?= base_url('admin/producto/darDeBaja/'.$producto->codigo); ?>"
                            class="btn btn-secondary" name="btnDarDeBaja"> <i class="fa-solid fa-thumbs-down"></i></i>
                            Dar de Baja</a>
                        <a href="<?= base_url('admin/producto/eliminar/'.$producto->codigo); ?>" class="btn btn-danger"
                            name="btnEliminar"> <i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                    </div>
                </td>
                <?php else: ?>
                <td><span class="badge rounded-pill bg-secondary">No Disponible</span></td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= base_url('admin/producto/editar/'.$producto->codigo); ?>" class="btn btn-info"> <i
                                class="fa fa-refresh" aria-hidden="true"></i> Editar</a>
                        <a href="<?= base_url('admin/producto/darDeAlta/'.$producto->codigo); ?>"
                            class="btn btn-success" name="btnDarDeAlta"> <i class="fa-solid fa-thumbs-up"></i></i> Dar
                            de Alta</a>
                        <a href="<?= base_url('admin/producto/eliminar/'.$producto->codigo); ?>" class="btn btn-danger"
                            name="btnEliminar"> <i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                    </div>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>