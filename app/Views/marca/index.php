<?=$header?>
<?=$menu?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-5">

    <h2 class="display-5 mb-3 fw-bold mb-5">Marcas</h2>

    <div class="table-responsive text-center">
        <table class="table table-striped table-hover">
        <div class="table-title bg-warning align-items-center py-3">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Administrar<b> Marcas</b></h2>
                </div>
                <div class="col-sm-6 my-auto">
                    <a class="btn btn-dark" href="<?= site_url('admin/marca/agregar')?>" role="button"><i
                            class="fa fa-certificate" aria-hidden="true"></i> Agregar Marca</a>
                </div>
            </div>
        </div>
            <caption>Lista actual de marcas</caption>
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($marcas as $marca): ?>
                <tr>
                    <th><?= $marca['codigo']; ?></th>
                    <td><?= $marca['nombre']; ?></td>                    
                    <?php if($marca['estado'] == 1): ?>
                    <td><span class="badge rounded-pill bg-success">Disponible</span></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="<?= base_url('admin/marca/editar/'.$marca['codigo']); ?>" class="btn btn-info">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Editar</a>
                            <a href="<?= base_url('admin/marca/darDeBaja/'.$marca['codigo']); ?>"
                                class="btn btn-secondary" name="btnDarDeBaja"> <i
                                    class="fa-solid fa-thumbs-down"></i></i> Dar de Baja</a>
                            <a href="<?= base_url('admin/marca/eliminar/'.$marca['codigo']); ?>"
                                class="btn btn-danger" name="btnEliminar"> <i class="fa fa-trash"
                                    aria-hidden="true"></i> Eliminar</a>
                        </div>
                    </td>
                    <?php else: ?>
                    <td><span class="badge rounded-pill bg-secondary">No Disponible</span></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="<?= base_url('admin/marca/editar/'.$marca['codigo']); ?>" class="btn btn-info">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Editar</a>
                            <a href="<?= base_url('admin/marca/darDeAlta/'.$marca['codigo']); ?>"
                                class="btn btn-success" name="btnDarDeAlta"> <i class="fa-solid fa-thumbs-up"></i></i>
                                Dar de Alta</a>
                            <a href="<?= base_url('admin/marca/eliminar/'.$marca['codigo']); ?>"
                                class="btn btn-danger" name="btnEliminar"> <i class="fa fa-trash"
                                    aria-hidden="true"></i> Eliminar</a>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<?=$footer?>