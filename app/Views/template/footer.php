</div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"
    integrity="sha512-cyAbuGborsD25bhT/uz++wPqrh5cqPh1ULJz4NSpN9ktWcA6Hnh9g+CWKeNx2R0fgQt+ybRXdabSBgYXkQTTmA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url('/plugins/validetta/validetta.js');?>"></script>
<script src="<?= base_url('/js/app.js');?>"></script>

<script>
$(window).on("load", function() {
    let url = "<?= current_url() ?>";

    $("nav a.nav-link").each(function() { //Lo que se complica el menu
        let itemMenu = $(this).attr('href');

        if (url.includes(itemMenu)) {
            console.log('nell');
            $("a.nav-link.active").removeClass("active");
            $(this).addClass("active");
        }
    })
});
</script>
<?php
    if(isset(session()->getFlashdata('alert')['msg']))
    {
        $alert_msg = session()->getFlashdata('alert')['msg'];
    }

    if(isset(session()->getFlashdata('alert')['icon']))
    {
        $alert_icon = session()->getFlashdata('alert')['icon'];
    }    
?>

<?php if(isset($alert_msg) && isset($alert_icon)): ?>
    <script>
        mostrarAlerta('<?= $alert_icon ?>', '<?= $alert_msg ?>');
    </script>
<?php endif; ?>

</body>


</html>