<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>



<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-4">
            <div class="d-flex mt-3">
                <input type="text"> </input>
                <button type="submit" class="btn btn-primary"> <i class="bi bi-search"></i> </button>
            </div>
        </div>
        <div class="col-2"> 
            <button 
            class="btn btn-link"
            onclick="generarModal()">
                <i class="bi bi-person-add fs-1"></i> 
            </button>
        </div>
    </div>

    <div class="mt-5">
        <div class="row d-flex justify-content-end"> 
            <table>
                <tr>
                    <th> Nombre </th>
                    <th> Apellidos </th>
                    <th> Mail </th>
                    <th> Teléfono </th>
                    <th> DNI </th>
                    <th> Acciones </th>
                </tr>
                <?php foreach($datos['Usuarios'] as $usuario): ?>
                    <tr>
                        <td> <?php echo $usuario->nombre ?> </td>
                        <td> <?php echo $usuario->apellidos ?> </td>
                        <td> <?php echo $usuario->mail ?> </td>
                        <td> <?php echo $usuario->telefono ?> </td>
                        <td> <?php echo $usuario->dni ?> </td>
                        <td> 
                            <a href="#" <?php echo "onclick='generarModalEditar(".$usuario->id_persona.")'"?> > <i class="bi bi-pencil-square fs-4"></i> </a> 
                            <a href="#" <?php echo "onclick='generarModalBorrar(".$usuario->id_persona.")'"?> > <i class="bi bi-person-dash fs-4"></i> </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>      
    </div>

</div>

<script type='text/javascript'>

    //Modal INSERT

    let modal = document.createElement("div");
    let modalcontenido = document.createElement("div");
    let modalheader = document.createElement("div");
    let modalbody = document.createElement("div");
    let modalfooter = document.createElement("div");
    let form = document.createElement("form");
    let input_idcurso = document.createElement("input");
    let labeldni = document.createElement("label");
    let labelclave = document.createElement("label");
    let labelnombre = document.createElement("label");
    let labelapellidos = document.createElement("label");
    let labelmail = document.createElement("label");
    let labeltelefono = document.createElement("label");
    let labelrol = document.createElement("label");
    let inputdni = document.createElement("input");
    let inputclave = document.createElement("input");
    let inputnombre = document.createElement("input");
    let inputapellidos = document.createElement("input");
    let inputmail = document.createElement("input");
    let inputtelefono = document.createElement("input");
    let inputrol = document.createElement("input");
    let inputboton = document.createElement("input");
    let modalbotoncerrar = document.createElement("button");
    let modala = document.createElement("a");
    let modalh5 = document.createElement("h5");
    let br = document.createElement("br");

    function generarModal() {
        
        //Modal
        modal.classList.add("modal-manual");

        //Contenido
        modalcontenido.classList.add("modal-contenido");

        //Header
        modalheader.classList.add("modal-header");

        //Body
        modalbody.classList.add("modal-body");

        //Form
        form.method = "post";


        //H5 y botoncerrar

        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Añadir";
        modalbotoncerrar.classList.add("btn-close");

        //Inputs

        labeldni.innerHTML = "DNI";
        labeldni.classList.add("form-label");
        labelnombre.innerHTML = "Nombre";
        labelnombre.classList.add("form-label");
        labelapellidos.innerHTML = "Apellidos";
        labelapellidos.classList.add("form-label");
        labelclave.innerHTML = "Clave";
        labelclave.classList.add("form-label");
        labelmail.innerHTML = "Mail";
        labelmail.classList.add("form-label");
        labeltelefono.innerHTML = "Telefono";
        labeltelefono.classList.add("form-label");
        labelrol.innerHTML = "Rol";
        labelrol.classList.add("form-label");

        inputdni.classList.add("form-control");
        inputdni.name = "dni";
        inputdni.id = "dni";
        inputdni.maxLength = 9;
        inputnombre.classList.add("form-control");
        inputnombre.name = "nombre";
        inputnombre.id = "nombre";
        inputapellidos.classList.add("form-control");
        inputapellidos.name = "apellidos";
        inputapellidos.id = "apellidos";
        inputclave.classList.add("form-control");
        inputclave.name = "clave";
        inputclave.id = "clave";
        inputclave.type = "password";
        inputmail.classList.add("form-control");
        inputmail.name = "mail";
        inputmail.id = "mail"
        inputtelefono.classList.add("form-control");
        inputtelefono.name = "telefono";
        inputtelefono.id = "telefono";
        inputtelefono.maxLength = 9;
        inputrol.classList.add("form-control");
        inputrol.name = "rol";
        inputrol.id = "rol";

        //Boton Guardar
        inputboton.type = "submit";
        inputboton.value = "Guardar";
        inputboton.id = "botonguardar";
        inputboton.classList.add("btn");
        inputboton.classList.add("btn-success");
        inputboton.classList.add("mt-4");
        inputboton.disabled = true;

        //Footer
        modalfooter.classList.add("modal-footer");
        
        document.body.appendChild(modal);
        modal.appendChild(modalcontenido);
        modalcontenido.appendChild(modalheader);
        modalcontenido.appendChild(modalbody);
        modalcontenido.appendChild(modalfooter);
        modalheader.appendChild(modalh5);
        modalheader.appendChild(modalbotoncerrar);
        modalbody.appendChild(br);
        modalbody.appendChild(modala);
        modalbody.appendChild(form);
        form.appendChild(labeldni);
        form.appendChild(inputdni);
        form.appendChild(labelnombre);
        form.appendChild(inputnombre);
        form.appendChild(labelapellidos);
        form.appendChild(inputapellidos);
        form.appendChild(labelclave);
        form.appendChild(inputclave);
        form.appendChild(labelmail);
        form.appendChild(inputmail);
        form.appendChild(labeltelefono);
        form.appendChild(inputtelefono);
        form.appendChild(labelrol);
        form.appendChild(inputrol);
        form.appendChild(inputboton);

        //rellenarRol();

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();
            modal.remove();

        });

        // VALIDACIONES

        const validacionDNI = document.querySelector('#dni');

        let DNIvalidado = false;
        
        var DNIregex = /^\d{8}[a-zA-Z]$/;

        let letras = 'TRWAGMYFPDXBNJZSQVHLCKET';

        validacionDNI.addEventListener('keyup', (e)=> {

            let substring = validacionDNI.value.substring(0,8);
            let letrainput = validacionDNI.value.slice(-1).toUpperCase();

            let pos = substring % 23;

            let letracorrecta = letras.charAt(pos);

            if (DNIregex.test(validacionDNI.value) && letrainput == letracorrecta) {

                validacionDNI.classList.remove("is-invalid");
                validacionDNI.classList.add("is-valid");
                DNIvalidado = true;

            } else {

                validacionDNI.classList.remove("is-valid");
                validacionDNI.classList.add("is-invalid");
                DNIvalidado = false;

            }

        });

        const validacionMail = document.querySelector('#mail'); 

        let Mailvalidado = false;

        var MailRegex = /^([a-zA-Z0-9_.+-]+)@[a-zA-Z0-9_.+-]+\.[a-zA-Z]{2,4}$/;

        validacionMail.addEventListener('keyup', (e)=> {

            if (MailRegex.test(validacionMail.value)) {

                validacionMail.classList.remove("is-invalid");
                validacionMail.classList.add("is-valid");
                Mailvalidado = true;

            } else {

                validacionMail.classList.remove("is-valid");
                validacionMail.classList.add("is-invalid");
                Mailvalidado = false;

            }

        });

        const validacionNombre = document.querySelector('#nombre');
        const validacionApellidos = document.querySelector('#apellidos');
        const validacionClave = document.querySelector('#clave');
        const validacionTelefono = document.querySelector('#telefono');
        const validacionRol = document.querySelector('#rol');
        const botonguardar = document.querySelector('#botonguardar');

        validacionNombre.addEventListener('keyup', (e)=> {

            if (validacionNombre.value!="") {

                validacionNombre.classList.remove("is-invalid");
                validacionNombre.classList.add("is-valid");

            } else {

                validacionNombre.classList.remove("is-valid");
                validacionNombre.classList.add("is-invalid");

            }
        });

        validacionApellidos.addEventListener('keyup', (e)=> {

            if (validacionApellidos.value!="") {

                validacionApellidos.classList.remove("is-invalid");
                validacionApellidos.classList.add("is-valid");

            } else {

                validacionApellidos.classList.remove("is-valid");
                validacionApellidos.classList.add("is-invalid");

            }
        });

        validacionClave.addEventListener('keyup', (e)=> {

            if (validacionClave.value!="") {

                validacionClave.classList.remove("is-invalid");
                validacionClave.classList.add("is-valid");

            } else {

                validacionClave.classList.remove("is-valid");
                validacionClave.classList.add("is-invalid");

            }
        });

        validacionTelefono.addEventListener('keyup', (e)=> {

            if (validacionTelefono.value!="") {

                validacionTelefono.classList.remove("is-invalid");
                validacionTelefono.classList.add("is-valid");

            } else {

                validacionTelefono.classList.remove("is-valid");
                validacionTelefono.classList.add("is-invalid");

            }
        });

        validacionRol.addEventListener('onchange', (e)=> {

            if (validacionRol.value!="Seleccione un Rol") {

                validacionRol.classList.remove("is-invalid");
                validacionRol.classList.add("is-valid");

            } else {

                validacionRol.classList.remove("is-valid");
                validacionRol.classList.add("is-invalid");

            }
        });

        document.addEventListener('keyup', (e)=> {

            if (DNIvalidado === true && Mailvalidado === true 
            && validacionNombre.value!="" && validacionApellidos.value!="" && validacionClave.value!="" && validacionTelefono.value!="" && validacionRol.value!="") {

                botonguardar.removeAttribute("disabled");

            } else {

                botonguardar.disabled = "true";

            }

        });

    }

    // async function rellenarRol(){

    //     await fetch(`<?php //echo RUTA_URL?>/curso/rellenarSelectProfesor`, {
    //         headers: {
    //             "Content-Type": "application/json"
    //         },
    //         credentials: 'include'
    //     })
    //         .then((resp) => resp.json())
    //         .then(function(data) {

    //             let dnis = data;

    //             selectdni.options.add(new Option("Selecciona un DNI", 0, true, true));
    //             selectdni.options[0].setAttribute("style", "display: none");

    //             dnis.forEach(function (dni) {

    //                 selectdni.options.add(new Option(dni.dni, dni.dni));

    //             });

                
    //         })
    // }

    
    //MODAL EDITAR MATERIAL
    let modaleditar = document.createElement("div");
    let modaleditarcontenido = document.createElement("div");
    let modaleditarheader = document.createElement("div");
    let modaleditarbody = document.createElement("div");
    let modaleditarfooter = document.createElement("div");
    let editarform = document.createElement("form");

    let editarlabeldni = document.createElement("label");
    let editarlabelnombre = document.createElement("label");
    let editarlabelapellidos = document.createElement("label");
    let editarlabelclave = document.createElement("label");
    let editarlabelmail = document.createElement("label");
    let editarlabeltelefono = document.createElement("label");
    let editarlabelrol = document.createElement("label");

    let editarinputdni = document.createElement("input");
    let editarinputnombre = document.createElement("input");
    let editarinputapellidos = document.createElement("input");
    let editarinputclave = document.createElement("input");
    let editarinputmail = document.createElement("input");
    let editarinputtelefono = document.createElement("input");
    let editarinputrol = document.createElement("input");
    let editarinputpersona = document.createElement("input");

    let editarinputboton = document.createElement("input");
    let editarmodalbotoncerrar = document.createElement("button");
    let editarmodalh5 = document.createElement("h5");
    let editarbr = document.createElement("br");


    function generarModalEditar(id_persona) {
        
        //Modal
        modaleditar.classList.add("modal-manual");

        //Contenido
        modaleditarcontenido.classList.add("modal-contenido");

        //Header
        modaleditarheader.classList.add("modal-header");

        //Body
        modaleditarbody.classList.add("modal-body");

        //Form
        ruta_url = <?php echo json_encode(RUTA_URL) ?>;

        ruta_updatepersona = "/usuario/editar_usuario";

        ruta = ruta_url+ruta_updatepersona;

        editarform.method = "post";
        editarform.action = ruta;
        editarform.id = "formulario";

        //H5 y botoncerrar
        editarmodalh5.classList.add("fs-6");
        editarmodalh5.innerHTML = "Editar Persona";
        editarmodalbotoncerrar.classList.add("btn-close");

        //Inputs
        editarlabeldni.innerHTML = "DNI";
        editarlabeldni.classList.add("form-label");

        editarlabelnombre.innerHTML = "Nombre";
        editarlabelnombre.classList.add("form-label");

        editarlabelapellidos.innerHTML = "Apellidos";
        editarlabelapellidos.classList.add("form-label");

        editarlabelclave.innerHTML = "Clave";
        editarlabelclave.classList.add("form-label");

        editarlabelmail.innerHTML = "Mail";
        editarlabelmail.classList.add("form-label");

        editarlabeltelefono.innerHTML = "Telefono";
        editarlabeltelefono.classList.add("form-label");

        editarlabelrol.innerHTML = "Rol";
        editarlabelrol.classList.add("form-label");



        editarinputdni.id = "dni";
        editarinputdni.type = "text";
        editarinputdni.classList.add("form-control");
        editarinputdni.name = "dni";

        editarinputnombre.id = "nombre";
        editarinputnombre.type = "text";
        editarinputnombre.classList.add("form-control");
        editarinputnombre.name = "nombre";

        editarinputapellidos.id = "apellidos";
        editarinputapellidos.type = "text";
        editarinputapellidos.classList.add("form-control");
        editarinputapellidos.name = "apellidos";

        editarinputclave.id = "clave";
        editarinputclave.type = "text";
        editarinputclave.classList.add("form-control");
        editarinputclave.name = "clave";

        editarinputmail.id = "mail";
        editarinputmail.type = "text";
        editarinputmail.classList.add("form-control");
        editarinputmail.name = "mail";

        editarinputtelefono.id = "telefono";
        editarinputtelefono.type = "text";
        editarinputtelefono.classList.add("form-control");
        editarinputtelefono.name = "telefono";

        editarinputrol.id = "rol";
        editarinputrol.type = "text";
        editarinputrol.classList.add("form-control");
        editarinputrol.name = "rol";

        editarinputpersona.value = id_persona;
        editarinputpersona.classList.add("d-none");
        editarinputpersona.name = "id_persona";

        //Boton Guardar
        editarinputboton.type = "submit";
        editarinputboton.value = "Guardar";
        editarinputboton.classList.add("btn");
        editarinputboton.classList.add("btn-success");
        editarinputboton.classList.add("mt-4");
        editarinputboton.id = "guardar";

        //Footer
        modaleditarfooter.classList.add("modal-footer");

        //Appends
        document.body.appendChild(modaleditar);
        modaleditar.appendChild(modaleditarcontenido);
        modaleditarcontenido.appendChild(modaleditarheader);
        modaleditarcontenido.appendChild(modaleditarbody);
        modaleditarcontenido.appendChild(modaleditarfooter);
        modaleditarheader.appendChild(editarmodalh5);
        modaleditarheader.appendChild(editarmodalbotoncerrar);
        modaleditarbody.appendChild(editarbr);
        modaleditarbody.appendChild(editarform);
        editarform.appendChild(editarlabeldni);
        editarform.appendChild(editarinputdni);
        editarform.appendChild(editarlabelnombre);
        editarform.appendChild(editarinputnombre);
        editarform.appendChild(editarlabelapellidos);
        editarform.appendChild(editarinputapellidos);
        editarform.appendChild(editarlabelclave);
        editarform.appendChild(editarinputclave);
        editarform.appendChild(editarlabelmail);
        editarform.appendChild(editarinputmail);
        editarform.appendChild(editarlabeltelefono);
        editarform.appendChild(editarinputtelefono);
        editarform.appendChild(editarlabelrol);
        editarform.appendChild(editarinputrol);
        
        editarform.appendChild(editarinputpersona);
        editarform.appendChild(editarinputboton);

        rellenarModal();

        //Cerrar Modal
        const closeModalEditar = document.querySelector('.btn-close');

        closeModalEditar.addEventListener('click', (e)=> {

            e.preventDefault();
            modaleditar.remove();

        });

        

    }

    async function rellenarModal(){

        const datosForm = new FormData(document.getElementById("formulario"))

        await fetch(`<?php echo RUTA_URL?>/usuario/get_datosusuario`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {

                let datosmaterial = data;

                // Relleno los datos del formulario
                document.getElementById("dni").value = datosmaterial.dni;
                document.getElementById("nombre").value = datosmaterial.nombre;
                document.getElementById("apellidos").value = datosmaterial.apellidos;
                document.getElementById("clave").value = datosmaterial.apellidos;
                document.getElementById("mail").value = datosmaterial.mail;
                document.getElementById("telefono").value = datosmaterial.telefono;
                document.getElementById("rol").value = datosmaterial.id_rol;
                
            })
    }

    //MODAL BORRAR
    let modalborrar = document.createElement("div");
    let modalborrarcontenido = document.createElement("div");
    let modalborrarheader = document.createElement("div");
    let modalborrarbody = document.createElement("div");
    let modalborrarfooter = document.createElement("div");
    let borrarform = document.createElement("form");
    let borrarinputpersona = document.createElement("input");
    let borrarinputboton = document.createElement("input");
    let borrarmodalbotoncerrar = document.createElement("button");
    let borrarmodalh5 = document.createElement("h5");

    function generarModalBorrar(id_persona) {

        //Modal
        modalborrar.classList.add("modal-manual");

        //Contenido
        modalborrarcontenido.classList.add("modal-contenido");

        //Header
        modalborrarheader.classList.add("modal-header");

        //Body
        modalborrarbody.classList.add("modal-body");

        //Form
        ruta_url = <?php echo json_encode(RUTA_URL) ?>;

        ruta_addnota = "/usuario/delete_usuario";

        ruta = ruta_url+ruta_addnota;

        borrarform.method = "post";
        borrarform.action = ruta;

        //H5 y botoncerrar
        borrarmodalh5.classList.add("fs-6");
        borrarmodalh5.innerHTML = "Borrar Persona";
        borrarmodalbotoncerrar.classList.add("btn-close");

        //Inputs

        borrarinputpersona.value = id_persona;
        borrarinputpersona.classList.add("d-none");
        borrarinputpersona.name = "id_persona";

        //Boton Guardar
        borrarinputboton.type = "submit";
        borrarinputboton.value = "Borrar";
        borrarinputboton.classList.add("btn");
        borrarinputboton.classList.add("btn-danger");
        borrarinputboton.id = "borrar";

        //Footer
        modalborrarfooter.classList.add("modal-footer");

        //Appends
        document.body.appendChild(modalborrar);
        modalborrar.appendChild(modalborrarcontenido);
        modalborrarcontenido.appendChild(modalborrarheader);
        modalborrarcontenido.appendChild(modalborrarbody);
        modalborrarcontenido.appendChild(modalborrarfooter);
        modalborrarheader.appendChild(borrarmodalh5);
        modalborrarheader.appendChild(borrarmodalbotoncerrar);
        modalborrarbody.appendChild(borrarform);
        borrarform.appendChild(borrarinputpersona);
        borrarform.appendChild(borrarinputboton);

        //Cerrar Modal
        const closeModalBorrar = document.querySelector('.btn-close');

        closeModalBorrar.addEventListener('click', (e)=> {

            e.preventDefault();
            modalborrar.remove();

        });

    }

</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>