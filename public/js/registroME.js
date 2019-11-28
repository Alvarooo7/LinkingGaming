Swal.fire({
    title: '¿Eres mayor de edad?',
    text: "Para poder registrarte, necesitas ser mayor de edad",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí lo soy!',
    cancelButtonText: 'No lo soy'
}).then((result) => {
    if (result.value) {
        Swal.fire(
            'Bienvenido!',
            'Ahora puedes gozar de tu Linkingaming.',
            'success'
        )
    } else {
        window.location = "https://www.youtube.com/watch?v=zQrURkmh-jw";
    }
})