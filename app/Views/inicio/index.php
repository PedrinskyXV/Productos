<?=$header?>
<?=$menu?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-5">

    <!-- <pre>
        <?= print_r($session); ?>
    </pre> -->
    <div class="mb-5">
        <div id="GoogleBarChart" style="height: 400px; width: 100%"></div>
    </div>

    <h2 class="display-5 mb-3">Productos</h2>


    <?php helper('number'); ?>

    <div class="table-responsive text-center">
        <table class="table table-striped table-sm">
            <caption>Lista actual de productos</caption>
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Estado</th>
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
                    <?php else: ?>
                    <td><span class="badge rounded-pill bg-secondary">No Disponible</span></td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {
    'packages': ['corechart', 'bar']
});
google.charts.setOnLoadCallback(drawBarChart);

// Bar Chart
google.charts.setOnLoadCallback(showBarChart);

function drawBarChart() {
    var data = google.visualization.arrayToDataTable([
        ['Marca', 'Cantidad'],
        <?php
foreach ($marcas as $row) {
    echo "['" . $row['marca'] . "'," . $row['cantidad'] . "],";
}
?>
    ]);
    var options = {
        title: 'Cantidad de productos por marca',
        is3D: true,
    };
    var chart = new google.visualization.BarChart(document.getElementById('GoogleBarChart'));
    chart.draw(data, options);
}
</script>

<?=$footer?>