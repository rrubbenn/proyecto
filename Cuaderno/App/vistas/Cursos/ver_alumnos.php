<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>



<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row">
        <?php if($datos['usuarioSesion']->id_rol == 3): ?>
            <div class="col-2"> 
                <button 
                class="btn btn-link"
                <?php echo "onclick='generarModal(".$datos['cursoactual'].")'" ?>>
                    <i class="bi bi-person-add fs-1"></i> 
                </button>
            </div>
        <?php endif ?>
    </div>

    <div class="mt-5">
        <div class="row d-flex justify-content-end"> 
            <table>
                <tr>
                    <th> Nombre </th>
                    <th> Apellidos </th>
                    <th> Mail </th>
                    <th> Teléfono </th>
                    <?php if($datos['usuarioSesion']->id_rol == 3): ?>
                        <th> Acciones </th>
                    <?php endif ?>
                </tr>
                <?php foreach($datos['alumnos'] as $alumno): ?>
                    <tr>
                        <td> <?php echo $alumno->nombre ?> </td>
                        <td> <?php echo $alumno->apellidos ?> </td>
                        <td> <?php echo $alumno->mail ?> </td>
                        <td> <?php echo $alumno->telefono ?> </td>
                        <?php if($datos['usuarioSesion']->id_rol == 3): ?>
                            <td> 
                                <a 
                                href="#"
                                <?php echo "onclick='generarModalBorrar(".$datos['cursoactual'].",".$alumno->id_persona.")'" ?> > 
                                    <i class="bi bi-person-dash fs-4"></i> 
                                </a>
                            </td>
                        <?php endif ?>
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
    let input_idalumno = document.createElement("input");
    let labeldni = document.createElement("label");
    let labelnombre = document.createElement("label");
    let labelapellidos = document.createElement("label");
    let labelmail = document.createElement("label");
    let labeltelefono = document.createElement("label");
    let selectdni = document.createElement("select");
    let inputnombre = document.createElement("input");
    let inputapellidos = document.createElement("input");
    let inputmail = document.createElement("input");
    let inputtelefono = document.createElement("input");
    let inputboton = document.createElement("input");
    let modalbotoncerrar = document.createElement("button");
    let modalh5 = document.createElement("h5");
    let br = document.createElement("br");


    function generarModal(id_curso) {
        
        //Modal
        modal.classList.add("modal-manual");

        //Contenido
        modalcontenido.classList.add("modal-contenido");

        //Header
        modalheader.classList.add("modal-header");

        //Body
        modalbody.classList.add("modal-body");

        //Form
        ruta_url = <?php echo json_encode(RUTA_URL) ?>;
        ruta_addnota = "/curso/add_alumno_curso/" + id_curso;
        ruta = ruta_url+ruta_addnota;
        
        form.method = "post";
        form.action = ruta;
        form.id = "formulario";

        //H5 y botoncerrar

        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Añadir Alumno";
        modalbotoncerrar.classList.add("btn-close");

        //Inputs
        labeldni.innerHTML = "DNI";
        labeldni.classList.add("mt-2");

        labelnombre.innerHTML = "Nombre";
        labelnombre.classList.add("mt-2");

        labelapellidos.innerHTML = "Apellidos";
        labelapellidos.classList.add("mt-2");

        labelmail.innerHTML = "Mail";
        labelmail.classList.add("mt-2");

        labeltelefono.innerHTML = "Telefono";
        labeltelefono.classList.add("mt-2");



        selectdni.type = "text";
        selectdni.classList.add("form-control");
        selectdni.classList.add("mb-3");
        selectdni.name = "dni";
        selectdni.id = "dni";
        selectdni.setAttribute("onchange", "rellenarFormularioDNI()");

        inputnombre.type = "text";
        inputnombre.classList.add("form-control");
        inputnombre.classList.add("mb-3");
        inputnombre.name = "nombre";
        inputnombre.disabled = true;

        inputapellidos.type = "text";
        inputapellidos.classList.add("form-control");
        inputapellidos.classList.add("mb-3");
        inputapellidos.name = "apellidos";
        inputapellidos.disabled = true;

        inputmail.type = "text";
        inputmail.classList.add("form-control");
        inputmail.classList.add("mb-3");
        inputmail.name = "mail";
        inputmail.disabled = true;

        inputtelefono.type = "text";
        inputtelefono.classList.add("form-control");
        inputtelefono.classList.add("mb-3");
        inputtelefono.name = "telefono";
        inputtelefono.disabled = true;

        input_idalumno.name = "id_alumno";
        input_idalumno.id = "id_alumno";
        input_idalumno.style.display = "none";

        input_idcurso.name = "id_curso";
        input_idcurso.id = "id_curso";
        input_idcurso.value = id_curso;
        input_idcurso.style.display = "none";

        //Boton Guardar
        inputboton.type = "submit";
        inputboton.id = "botonguardar";
        inputboton.value = "Guardar";
        inputboton.classList.add("btn");
        inputboton.classList.add("btn-success");
        inputboton.disabled = "true";
        
        
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
        modalbody.appendChild(form);
        form.appendChild(labeldni);
        form.appendChild(selectdni);
        form.appendChild(labelnombre);
        form.appendChild(inputnombre);
        form.appendChild(labelapellidos);
        form.appendChild(inputapellidos);
        form.appendChild(labelmail);
        form.appendChild(inputmail);
        form.appendChild(labeltelefono);
        form.appendChild(inputtelefono);
        form.appendChild(input_idalumno);
        form.appendChild(input_idcurso);
        form.appendChild(inputboton);

        rellenarSelect(id_curso);

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();
            
            while (selectdni.options.length) selectdni.remove(0);
            input_idalumno.value = "";
            inputnombre.value = "";
            inputapellidos.value = "";
            inputmail.value = "";
            inputtelefono.value = "";
            
            modal.remove();

        });

    }

    async function rellenarSelect(id_curso){

        await fetch(`<?php echo RUTA_URL?>/curso/rellenarSelectAlumno/${id_curso}`, {
            headers: {
                "Content-Type": "application/json"
            },
            credentials: 'include'
        })
            .then((resp) => resp.json())
            .then(function(data) {

                let dnis = data;

                selectdni.options.add(new Option("Selecciona un DNI", 0, true, true));
                selectdni.options[0].setAttribute("style", "display: none");

                dnis.forEach(function (dni) {

                    selectdni.options.add(new Option(dni.dni+" - "+dni.nombre+" "+dni.apellidos, dni.dni));

                });

                
            })
    }

    async function rellenarFormularioDNI(){

        let selectdni = document.getElementById("dni").value;
        let botonguardar = document.getElementById("botonguardar");

        await fetch(`<?php echo RUTA_URL?>/curso/rellenarFormularioDNI/${selectdni}`, {
            headers: {
                "Content-Type": "application/json"
            },
            credentials: 'include'
        })
            .then((resp) => resp.json())
            .then(function(data) {

                let datos = data;

                datos.forEach(function(dato){

                    input_idalumno.value = dato.id_persona;
                    inputnombre.value = dato.nombre;
                    inputapellidos.value = dato.apellidos;
                    inputmail.value = dato.mail;
                    inputtelefono.value = dato.telefono;

                });

                botonguardar.removeAttribute("disabled");
                
            })
    }

    //Modal BORRAR

    let modalborrar = document.createElement("div");
    let modalborrarcontenido = document.createElement("div");
    let modalborrarheader = document.createElement("div");
    let modalborrarbody = document.createElement("div");
    let modalborrarfooter = document.createElement("div");
    let borrarform = document.createElement("form");
    let borrarinputpersona = document.createElement("input");
    let borrarinputcurso = document.createElement("input");
    let borrarinputboton = document.createElement("input");
    let borrarmodalbotoncerrar = document.createElement("button");
    let borrarmodalh5 = document.createElement("h5");

    function generarModalBorrar(id_curso, id_persona) {

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

        ruta_addnota = "/curso/delete_alumno_curso/" + id_curso;

        ruta = ruta_url+ruta_addnota;

        borrarform.method = "post";
        borrarform.action = ruta;

        //H5 y botoncerrar
        borrarmodalh5.classList.add("fs-6");
        borrarmodalh5.innerHTML = "Borrar Persona";
        borrarmodalbotoncerrar.classList.add("btn-close");

        //Inputs

        borrarinputcurso.value = id_curso;
        borrarinputcurso.classList.add("d-none");
        borrarinputcurso.name = "id_curso";

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
        borrarform.appendChild(borrarinputcurso);
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