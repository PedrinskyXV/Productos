function mostrarAlerta(icono, titulo) {
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: toast => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: icono,
        title: titulo
    });
}

$(function() {
    console.log( "ready!" );

    $("form").validetta({
        realTime : true,
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        callback: {
            precio: {
                callback:  function( el, value ) {
                    if ( value >= 0.01 ){
                        return true
                    }
                    
                    return false
                },
                errorMessage: "El precio tiene que ser igual o mayor a 0.01 centavos."
            }
        }
    });

    $('button[name="btnModificar"], button[name="btnEliminar"]').on('click', function (e) {
        e.preventDefault();
        
        var form =  $(this).parent().parent();            
        console.log(form);
        //$(form).trigger("submit");
        Swal.fire({
            title: '¿Está seguro?',
            text: "Esto no se podrá revertir!.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {                
                $(form).submit();
            }
        });
    });

    $('a[name="btnDarDeAlta"], a[name="btnDarDeBaja"], a[name="btnEliminar"]').on('click', function (e) {
        e.preventDefault();
        
        var ref =  $(this).attr('href');
        var name = $(this).attr('name');
        var textoAlert = "Esto no se podrá revertir!.";
        console.log(name);
        if(!name.includes("btnEliminar"))
        {
            textoAlert = "Esto puede afectar a otros usuario."
        }
                
        Swal.fire({
            title: '¿Está seguro?',
            text: textoAlert,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                window.location.href = ref;
            }
        });
    });
});