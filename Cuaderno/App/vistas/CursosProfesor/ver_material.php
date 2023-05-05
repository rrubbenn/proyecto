<?php require_once RUTA_APP.'/vistas/inc/header_curso.php'; ?>

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <?php print_r($datos["material"]); ?>

    <div class="row mt-4">
        <div class="col-6">
            <h4 class="mb-4"> Evaluados </h4>
            <div class="row">
                <?php foreach($datos["materialRealizado"] as $alumno): ?>
                    <p class="col-10"> <?php echo $alumno->nombre ?>  </p>
                    <button 
                    type="button" 
                    class="btn btn-primary col-1" 
                    <?php echo "onclick='generarModal(".$datos['material']->id_material.",".$alumno->id_persona.")'" ?>> 
                        <i class="bi bi-pencil-square"></i> 
                    </button>
                <?php endforeach ?>
            </div> 
        </div>

        <div class="col-6">
            <h4 class="mb-4"> No Evaluados </h4>
                <div class="row">
                    <?php foreach($datos["materialNoRealizado"] as $alumno): ?>
                        <p class="col-10"> <?php echo $alumno->nombre ?> </p>
                        <button 
                        type="button" 
                        class="btn btn-primary col-1" 
                        <?php echo "onclick='generarModal(".$datos['material']->id_material.",".$alumno->id_persona.")'" ?>> 
                            <i class="bi bi-pencil-square"></i> 
                        </button>
                    <?php endforeach ?> 
                </div>
        </div>
    </div>
</div>


<script type='text/javascript'>

    async function rellenarModal(id){

        // Marcamos el boton como cargando ... y lo deshabilitamos
        let botonGuardar = document.getElementById("guardar");
        botonGuardar.innerHTML='<span class="spinner-border spinner-border-sm"></span> Loading...';
        //botonGuardar.disabled = true;
        await fetch(`<?php echo RUTA_URL?>/curso/get_notas/${id}`, {
            headers: {
                "Content-Type": "application/json"
            },
            credentials: 'include'
        })
            .then((resp) => resp.json())
            .then(function(data) {

                console.log(data);
                let notas = data

                // Relleno los datos del formulario
                
                document.getElementById("linkArchivo").innerHTML = notas.entrega_alumno;
                document.getElementById("inputNota").value = notas.nota;
                document.getElementById("inputObservacion").value = notas.observaciones;

                // Activamos de nuevo el boton, despues de un delay
                setTimeout(() => {
                    botonGuardar.innerHTML='Guardar'
                    botonGuardar.disabled = false
                }, 1000);
                
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
    let linkarchivo = document.createElement("a");
    let modalh5 = document.createElement("h5");
    let labelnota = document.createElement("label");
    let labelobservacion = document.createElement("label");
    let labelarchivo = document.createElement("label");
    let br = document.createElement("br");

    function generarModal(id_material, id_persona, nombre) {
        
        console.log(id_material);

        //Modal
        modal.classList.add("modal-manual");

        //Contenido
        modalcontenido.classList.add("modal-contenido");

        //Header
        modalheader.classList.add("modal-header");

        //Body
        modalbody.classList.add("modal-body");

        //Archivo
        labelarchivo.innerHTML = "Archivo";
        linkarchivo.id = "linkArchivo";
        linkarchivo.innerHTML = "Holaa";
        linkarchivo.classList.add("fs-6");
        linkarchivo.href = "#";

        //Form
        ruta_url = <?php echo json_encode(RUTA_URL) ?>;
        ruta_addnota = "/curso/add_notas/" + id_material;
        ruta = ruta_url+ruta_addnota;
        
        form.method = "post";
        form.action = ruta;

        //H5 y botoncerrar

        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Evaluar: ";
        modalbotoncerrar.classList.add("btn-close");

        //Inputs
        labelnota.innerHTML = "Nota";
        labelnota.classList.add("mt-2");
        inputnota.id = "inputNota";
        inputnota.type = "text";
        inputnota.classList.add("form-control");
        inputnota.classList.add("mb-3");
        inputnota.name = "nota";

        labelobservacion.innerHTML = "Observaciones";
        inputobservacion.id = "inputObservacion";
        inputobservacion.classList.add("form-control");
        inputobservacion.classList.add("mb-5");
        inputobservacion.style.height = "100px";
        inputobservacion.name = "observacion";

        input_idalumno.name = "id_alumno";
        input_idalumno.value = id_persona;
        input_idalumno.style.display = "none";

        input_idmaterial.name = "id_material";
        input_idmaterial.value = id_material;
        input_idmaterial.style.display = "none";

        //Boton Guardar
        inputboton.type = "submit";
        inputboton.value = "Guardar";
        inputboton.classList.add("btn");
        inputboton.classList.add("btn-success");
        inputboton.id = "guardar";

        //Footer
        modalfooter.classList.add("modal-footer");
        
        document.body.appendChild(modal);
        modal.appendChild(modalcontenido);
        modalcontenido.appendChild(modalheader);
        modalcontenido.appendChild(modalbody);
        modalcontenido.appendChild(modalfooter);
        modalheader.appendChild(modalh5);
        modalheader.appendChild(modalbotoncerrar);
        modalbody.appendChild(labelarchivo);
        modalbody.appendChild(br);
        modalbody.appendChild(linkarchivo);
        modalbody.appendChild(form);
        form.appendChild(labelnota);
        form.appendChild(inputnota);
        form.appendChild(labelobservacion);
        form.appendChild(inputobservacion);
        form.appendChild(input_idalumno);
        form.appendChild(input_idmaterial);
        form.appendChild(inputboton);

        rellenarModal(id_material);

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();
            modal.remove();

        });

    }

</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>