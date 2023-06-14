<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-6">
            <h4 class="mb-4"> Evaluados </h4>
            <div class="row">
                <?php foreach($datos["materialRealizado"] as $alumno): ?>
                    <p class="col-10"> <?php echo $alumno->nombre ?>  </p>
                    <?php if($datos['usuarioSesion']->id_rol == 1): ?>
                        <button 
                        type="button" 
                        class="btn btn-primary col-1" 
                        <?php echo "onclick='generarModal(".$datos['material']->id_material.",".$alumno->id_persona.", 1)'" ?>> 
                            <i class="bi bi-pencil-square"></i> 
                        </button>
                        <button 
                        type="button" 
                        class="btn btn-primary col-1"
                        <?php echo "onclick='generarModalVer(".$datos["material"]->id_material.",".$alumno->id_persona.")'" ?>>
                            <i class="bi bi-eye"></i>
                        </button>
                    <?php endif ?>
                <?php endforeach ?>
            </div> 
        </div>

        <div class="col-6">
            <h4 class="mb-4"> No Evaluados </h4>
                <div class="row">
                    <?php foreach($datos["materialNoRealizado"] as $alumno): ?>
                        <p class="col-10"> <?php echo $alumno->nombre ?> </p>
                        <?php if($datos['usuarioSesion']->id_rol == 1): ?>
                            <button 
                            type="button" 
                            class="btn btn-primary col-1" 
                            <?php echo "onclick='generarModal(".$datos['material']->id_material.",".$alumno->id_persona.", 0)'" ?>> 
                                <i class="bi bi-pencil-square"></i> 
                            </button>
                        <?php endif ?>
                    <?php endforeach ?> 
                </div>
        </div>
    </div>
</div>


<script type='text/javascript'>

    async function rellenarModal(){

        const datosForm = new FormData(document.getElementById("formulario"));

        await fetch(`<?php echo RUTA_URL?>/curso/get_notas`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {

                let notas = data

                if(notas == "") {

                    // Relleno los datos del formulario
                    document.getElementById("inputNota").value = "";
                    document.getElementById("inputObservacion").value = "";

                } else {

                    // Relleno los datos del formulario
                    document.getElementById("inputNota").value = notas.nota;
                    document.getElementById("inputObservacion").value = notas.observaciones;

                }
                
            })
    }

    let modal = document.createElement("div");
    let modalcontenido = document.createElement("div");
    let modalheader = document.createElement("div");
    let modalbody = document.createElement("div");
    let modalfooter = document.createElement("div");
    let form = document.createElement("form");
    let input_idalumno = document.createElement("input");
    let input_idmaterial = document.createElement("input");
    let inputnota = document.createElement("input");
    let inputobservacion = document.createElement("textarea");
    let inputboton = document.createElement("input");
    let modalbotoncerrar = document.createElement("button");
    let modalh5 = document.createElement("h5");
    let labelnota = document.createElement("label");
    let labelobservacion = document.createElement("label");
    let br = document.createElement("br");

    function generarModal(id_material, id_persona, evaluado) {

        //Modal
        modal.classList.add("modal-manual");

        //Contenido
        modalcontenido.classList.add("modal-contenido");

        //Header
        modalheader.classList.add("modal-header");

        //Body
        modalbody.classList.add("modal-body");

        //Form

        if (evaluado == 0) {

            ruta_url = <?php echo json_encode(RUTA_URL) ?>;
            ruta_addnota = "/curso/add_notas/" + id_material;
            ruta = ruta_url+ruta_addnota;
            
            form.id = "formulario";
            form.method = "post";
            form.action = ruta;

        } else {

            ruta_url = <?php echo json_encode(RUTA_URL) ?>;
            ruta_editnota = "/curso/edit_notas/" + id_material;
            ruta = ruta_url+ruta_editnota;
            
            form.id = "formulario";
            form.method = "post";
            form.action = ruta;

        }

        //H5 y botoncerrar

        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Evaluar: ";
        modalbotoncerrar.classList.add("btn-close");

        //Inputs
        labelnota.innerHTML = "Nota";
        labelnota.classList.add("form-label");
        inputnota.id = "inputNota";
        inputnota.type = "text";
        inputnota.classList.add("form-control");
        inputnota.classList.add("mb-3");
        inputnota.name = "nota";

        labelobservacion.innerHTML = "Observaciones";
        labelobservacion.classList.add("form-label");
        inputobservacion.id = "inputObservacion";
        inputobservacion.classList.add("form-control");
        inputobservacion.classList.add("mb-5");
        inputobservacion.style.height = "100px";
        inputobservacion.name = "observacion";

        input_idalumno.id = "id_alumno";
        input_idalumno.name = "id_alumno";
        input_idalumno.value = id_persona;
        input_idalumno.style.display = "none";

        input_idmaterial.id = "id_material";
        input_idmaterial.name = "id_material";
        input_idmaterial.value = id_material;
        input_idmaterial.style.display = "none";

        //Boton Guardar
        inputboton.type = "submit";
        inputboton.value = "Guardar";
        inputboton.classList.add("btn");
        inputboton.classList.add("btn-success");
        inputboton.id = "guardar";
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
        form.appendChild(labelnota);
        form.appendChild(inputnota);
        form.appendChild(labelobservacion);
        form.appendChild(inputobservacion);
        form.appendChild(input_idalumno);
        form.appendChild(input_idmaterial);
        form.appendChild(inputboton);

        rellenarModal();

        let regexNota = /^[1-9]\d*(\.\d+)?$/;

        let notaValidada = false;

        const campoNota = document.querySelector('#inputNota');

        campoNota.addEventListener('keyup', (e)=> {

            if (regexNota.test(campoNota.value)) {

                campoNota.classList.remove("is-invalid");
                campoNota.classList.add("is-valid");
                notaValidada = true;

            } else {

                campoNota.classList.remove("is-valid");
                campoNota.classList.add("is-invalid");
                notaValidada = false;

            }

        });

        const botonguardar = document.querySelector('#guardar');

        document.addEventListener('keyup', (e)=> {

            if (notaValidada === true) {

                botonguardar.removeAttribute("disabled");

            } else {

                botonguardar.disabled = "true";

            }

        });

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();

            campoNota.classList.remove("is-invalid");
            campoNota.classList.remove("is-valid");


            modal.remove();

        });

        

    }

    async function rellenarModalVer(){

        const datosForm = new FormData(document.getElementById("formulario"))

        await fetch(`<?php echo RUTA_URL?>/curso/get_notas`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {

                let notas = data

                if(notas == "") {

                    // Relleno los datos del formulario
                    document.getElementById("inputNota").value = "";
                    document.getElementById("inputObservacion").value = "";

                } else {

                    // Relleno los datos del formulario
                    document.getElementById("inputNota").value = notas.nota;
                    document.getElementById("inputObservacion").value = notas.observaciones;

                }
            })
    }

    let vermodal = document.createElement("div");
    let vermodalcontenido = document.createElement("div");
    let vermodalheader = document.createElement("div");
    let vermodalbody = document.createElement("div");
    let vermodalfooter = document.createElement("div");
    let verform = document.createElement("form");
    let verinput_idalumno = document.createElement("input");
    let verinput_idmaterial = document.createElement("input");
    let verinputnota = document.createElement("input");
    let verinputobservacion = document.createElement("textarea");
    let verinputboton = document.createElement("input");
    let vermodalbotoncerrar = document.createElement("button");
    let vermodalh5 = document.createElement("h5");
    let verlabelnota = document.createElement("label");
    let verlabelobservacion = document.createElement("label");
    let verbr = document.createElement("br");

    function generarModalVer(id_material, id_persona) {

        //Modal
        vermodal.classList.add("modal-manual");

        //Contenido
        vermodalcontenido.classList.add("modal-contenido");

        //Header
        vermodalheader.classList.add("modal-header");

        //Body
        vermodalbody.classList.add("modal-body");

        //Form
        verform.id = "formulario";

        //H5 y botoncerrar

        vermodalh5.classList.add("fs-6");
        vermodalh5.innerHTML = "Evaluar: ";
        vermodalbotoncerrar.classList.add("btn-close");

        //Inputs
        verlabelnota.innerHTML = "Nota";
        verlabelnota.classList.add("form-label");
        verinputnota.id = "inputNota";
        verinputnota.type = "text";
        verinputnota.classList.add("form-control");
        verinputnota.classList.add("mb-3");
        verinputnota.name = "nota";
        verinputnota.readOnly = true; 

        verlabelobservacion.innerHTML = "Observaciones";
        verlabelobservacion.classList.add("form-label");
        verinputobservacion.id = "inputObservacion";
        verinputobservacion.classList.add("form-control");
        verinputobservacion.classList.add("mb-5");
        verinputobservacion.style.height = "100px";
        verinputobservacion.name = "observacion";
        verinputobservacion.readOnly = true; 

        verinput_idalumno.id = "id_alumno";
        verinput_idalumno.name = "id_alumno";
        verinput_idalumno.value = id_persona;
        verinput_idalumno.style.display = "none";

        verinput_idmaterial.id = "id_material";
        verinput_idmaterial.name = "id_material";
        verinput_idmaterial.value = id_material;
        verinput_idmaterial.style.display = "none";

        //Footer
        vermodalfooter.classList.add("modal-footer");

        document.body.appendChild(vermodal);
        vermodal.appendChild(vermodalcontenido);
        vermodalcontenido.appendChild(vermodalheader);
        vermodalcontenido.appendChild(vermodalbody);
        vermodalcontenido.appendChild(vermodalfooter);
        vermodalheader.appendChild(vermodalh5);
        vermodalheader.appendChild(vermodalbotoncerrar);
        vermodalbody.appendChild(verbr);
        vermodalbody.appendChild(verform);
        verform.appendChild(verlabelnota);
        verform.appendChild(verinputnota);
        verform.appendChild(verlabelobservacion);
        verform.appendChild(verinputobservacion);
        verform.appendChild(verinput_idalumno);
        verform.appendChild(verinput_idmaterial);

        rellenarModalVer();

        const vercloseModal = document.querySelector('.btn-close');

        vercloseModal.addEventListener('click', (e)=> {

            e.preventDefault();
            vermodal.remove();

        });
    }

</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>