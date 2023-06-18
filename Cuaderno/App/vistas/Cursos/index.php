<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>

<div class="container">

    <?php if($datos['usuarioSesion']->id_rol == 3): ?>
        <div class="row mb-5">
            <div class="col-12 d-flex">
                <button class="col-12 btn btn-primary" onclick="modalAdd()"> Añadir Curso </button>
            </div>
        </div>
    <?php endif ?>

    <div class="row col-12 mb-4">
        <div class="col-4">
            <input type="text" class="form-control" id="buscador" onkeyup="busqueda()" placeholder="Buscar"> </input>
        </div>
        <div class="col-2">
            <input type="date" id="buscador_fecha_inicio" onchange="busqueda()" class="form-control"> </input>
        </div>
        <div class="col-2">
            <input type="date" id="buscador_fecha_fin" onchange="busqueda()" class="form-control"> </input>
        </div>
        <div class="col-2">
            <select id="selectanyos" class="form-control" onclick="rellenarSelectAnyos()" onchange="busqueda()">

            </select>
        </div>
    </div>

    <div class="row" id="divrow">

    </div>

    <div class="row">
        <nav class="d-flex justify-content-center" aria-label="Page navigation example">
            <ul class="pagination" id="ulpaginacion">
            </ul>
        </nav>
    </div>

</div>

<script>

    let modal = document.createElement("div");
    let modalcontenido = document.createElement("div");
    let modalheader = document.createElement("div");
    let modalbody = document.createElement("div");
    let modalfooter = document.createElement("div");
    let form = document.createElement("form");
    let input_idcurso = document.createElement("input");
    let labelnombre = document.createElement("label");
    let labelfecha_inicio = document.createElement("label");
    let labelfecha_fin = document.createElement("label");
    let labelanyo = document.createElement("label");
    let inputnombre = document.createElement("input");
    let inputfecha_inicio = document.createElement("input");
    let inputfecha_fin = document.createElement("input");
    let inputanyo = document.createElement("input");
    let inputboton = document.createElement("input");
    let modalbotoncerrar = document.createElement("button");
    let modalh5 = document.createElement("h5");

    function modalAdd() {
        
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
        form.action = "javascript:addCurso()";
        form.id = "formulario";

        //H5 y botoncerrar

        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Añadir";
        modalbotoncerrar.classList.add("btn-close");

        //Inputs

        labelnombre.innerHTML = "Nombre";
        labelnombre.classList.add("form-label");
        labelfecha_inicio.innerHTML = "Fecha Inicio";
        labelfecha_inicio.classList.add("form-label");
        labelfecha_fin.innerHTML = "Fecha Fin";
        labelfecha_fin.classList.add("form-label");
        labelanyo.innerHTML = "Año";
        labelanyo.classList.add("form-label");

        inputnombre.classList.add("form-control");
        inputnombre.name = "nombre";
        inputnombre.id = "nombre";
        inputnombre.minLength = "4";
        inputfecha_inicio.classList.add("form-control");
        inputfecha_inicio.name = "fecha_inicio";
        inputfecha_inicio.id = "fecha_inicio";
        inputfecha_inicio.type = "date";
        inputfecha_inicio.min = "2023-8-19";

        inputfecha_fin.classList.add("form-control");
        inputfecha_fin.name = "fecha_fin";
        inputfecha_fin.id = "fecha_fin";
        inputfecha_fin.type = "date";
        inputanyo.classList.add("form-control");
        inputanyo.name = "anyo";
        inputanyo.id = "anyo"
        inputanyo.maxLength = "4";

        //Boton Guardar
        inputboton.type = "submit";
        inputboton.value = "Guardar";
        inputboton.id = "botonguardar";
        inputboton.classList.add("btn");
        inputboton.classList.add("btn-success");
        inputboton.classList.remove("btn-danger");
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
        modalbody.appendChild(form);
        form.appendChild(labelnombre);
        form.appendChild(inputnombre);
        form.appendChild(labelfecha_inicio);
        form.appendChild(inputfecha_inicio);
        form.appendChild(labelfecha_fin);
        form.appendChild(inputfecha_fin);
        form.appendChild(labelanyo);
        form.appendChild(inputanyo);
        form.appendChild(inputboton);

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();

            labelnombre.remove();
            labelfecha_inicio.remove();
            labelfecha_fin.remove();
            labelanyo.remove();

            inputnombre.value = "";
            inputnombre.remove();
            inputfecha_inicio.value = "";
            inputfecha_inicio.remove();
            inputfecha_fin.value = "";
            inputfecha_fin.remove();
            inputanyo.value = "";
            inputanyo.remove();

            campoNombre.classList.remove("is-invalid");
            campoNombre.classList.remove("is-valid");
            campoFechaInicio.classList.remove("is-valid");
            campoFechaInicio.classList.remove("is-invalid");
            campoFechaFin.classList.remove("is-invalid");
            campoFechaFin.classList.remove("is-valid");
            campoAnyo.classList.remove("is-invalid");
            campoAnyo.classList.remove("is-valid");

            modal.remove();

        });

        // VALIDACIONES

        let nombreValidado = false;
        let fechaValidado = false;
        let anyoValidado = false;

        const campoNombre = document.querySelector('#nombre');

        campoNombre.addEventListener('keyup', (e)=> {

            if (campoNombre.value!="") {

                campoNombre.classList.remove("is-invalid");
                campoNombre.classList.add("is-valid");
                nombreValidado = true;

            } else {

                campoNombre.classList.remove("is-valid");
                campoNombre.classList.add("is-invalid");
                nombreValidado = false;

            }

        });

        const campoFechaInicio = document.querySelector('#fecha_inicio'); 
        const campoFechaFin = document.querySelector('#fecha_fin'); 

        campoFechaFin.disabled = "true";

        campoFechaInicio.addEventListener('change', (e)=> {

                if (campoFechaInicio.value <= campoFechaFin.value && campoFechaInicio.value != "" && campoFechaFin.value != "") {

                    campoFechaInicio.classList.add("is-valid");
                    campoFechaInicio.classList.remove("is-invalid");
                    campoFechaFin.classList.add("is-valid");
                    campoFechaFin.classList.remove("is-invalid");
                    fechaValidado = true;

                } else {

                    campoFechaInicio.classList.remove("is-valid");
                    campoFechaInicio.classList.add("is-invalid");
                    campoFechaFin.classList.remove("is-valid");
                    campoFechaFin.classList.add("is-invalid");
                    fechaValidado = false;

                }

                campoFechaFin.removeAttribute("disabled");

        });

        campoFechaFin.addEventListener('change', (e)=> {

                if (campoFechaInicio.value <= campoFechaFin.value && campoFechaInicio.value != "" && campoFechaFin.value != "" )  {

                    campoFechaInicio.classList.add("is-valid");
                    campoFechaInicio.classList.remove("is-invalid");
                    campoFechaFin.classList.add("is-valid");
                    campoFechaFin.classList.remove("is-invalid");
                    fechaValidado = true;

                } else {

                    campoFechaInicio.classList.remove("is-valid");
                    campoFechaInicio.classList.add("is-invalid");
                    campoFechaFin.classList.remove("is-valid");
                    campoFechaFin.classList.add("is-invalid");
                    fechaValidado = false;

                }
        });

        const campoAnyo = document.querySelector('#anyo');

        campoAnyo.addEventListener('keyup', (e)=> {

            if(campoAnyo.value <= 2000) {

                campoAnyo.classList.add("is-invalid")
                campoAnyo.classList.remove("is-valid");
                anyoValidado = false;
                

            } else {

                campoAnyo.classList.add("is-valid");
                campoAnyo.classList.remove("is-invalid");
                anyoValidado = true;

            }


        });

        const botonguardar = document.querySelector('#botonguardar');

        document.addEventListener('keyup', (e)=> {

            if (nombreValidado === true && anyoValidado === true && fechaValidado === true) {

                botonguardar.removeAttribute("disabled");

            } else {

                botonguardar.disabled = "true";

            }

        });

        document.addEventListener('change', (e)=> {

            if (nombreValidado === true && anyoValidado === true && fechaValidado === true) {

                botonguardar.removeAttribute("disabled");

            } else {

                botonguardar.disabled = "true";

            }

        });

    }

    async function addCurso(){

        const datosForm = new FormData(document.getElementById("formulario"));

        await fetch(`<?php echo RUTA_URL?>/curso/add_curso`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {

                if(data){

                    const entrada = {}

                    if (elementos.length >= 12) {

                        entrada["id_curso"] = parseInt(data);

                        for (var pair of datosForm.entries()) {
                            entrada[pair[0]] = pair[1]; 
                            
                        }

                        elementos.push(entrada);

                    } else {

                        let divrow = document.getElementById("divrow");

                        let div1 = document.createElement("div");
                        let div2 = document.createElement("div");
                        let div3 = document.createElement("div");
                        let a1 = document.createElement("a");
                        let div4 = document.createElement("div");
                        let p1 = document.createElement("p");
                        let div5 = document.createElement("div");
                        let p2 = document.createElement("p");
                        let div6 = document.createElement("div");
                        let a2 = document.createElement("a");
                        let i1 = document.createElement("i");

                        div1.classList.add("col-6");
                        div1.classList.add("d-flex");
                        div1.id = data;
                        
                        div2.classList.add("card");
                        div2.classList.add("col-12");

                        div3.classList.add("row");
                        div3.classList.add("card-body");

                        a1.classList.add("text-decoration-none");
                        a1.classList.add("text-dark");
                        a1.classList.add("row");
                        a1.classList.add("col-9");
                        a1.href = "/Cuaderno/curso/ver_curso/"+data;

                        div4.classList.add("col-6");

                        p1.innerHTML = datosForm.get("nombre");

                        div5.classList.add("col-6");
                        div5.classList.add("d-flex");
                        div5.classList.add("justify-content-end");

                        p2.innerHTML = datosForm.get("anyo");

                        div6.classList.add("col-1");
                        div6.classList.add("offset-2");

                        a2.classList.add("col-12");
                        a2.classList.add("text-decoration-none");
                        a2.classList.add("text-dark");
                        a2.classList.add("d-flex");
                        a2.classList.add("justify-content-end");
                        a2.href = "#";
                        a2.setAttribute("onclick", "modalBorrar("+data+")");

                        i1.classList.add("bi");
                        i1.classList.add("bi-trash");
                        i1.classList.add("fs-4");

                        divrow.appendChild(div1);
                        div1.appendChild(div2);
                        div2.appendChild(div3);
                        div3.appendChild(a1);
                        a1.appendChild(div4);
                        a1.appendChild(div5);
                        div4.appendChild(p1);
                        div5.appendChild(p2);
                        div3.appendChild(div6);
                        div6.appendChild(a2);
                        a2.appendChild(i1);

                    }

                    labelnombre.remove();
                    labelfecha_inicio.remove();
                    labelfecha_fin.remove();
                    labelanyo.remove();

                    inputnombre.value = "";
                    inputnombre.remove();
                    inputfecha_inicio.value = "";
                    inputfecha_inicio.remove();
                    inputfecha_fin.value = "";
                    inputfecha_fin.remove();
                    inputanyo.value = "";
                    inputanyo.remove();

                    inputnombre.classList.remove("is-invalid");
                    inputnombre.classList.remove("is-valid");
                    inputfecha_inicio.classList.remove("is-valid");
                    inputfecha_inicio.classList.remove("is-invalid");
                    inputfecha_fin.classList.remove("is-invalid");
                    inputfecha_fin.classList.remove("is-valid");
                    inputanyo.classList.remove("is-invalid");
                    inputanyo.classList.remove("is-valid");

                    modal.remove(); 

                    actualizarVariables();

                } else {

                    console.log("Fail");

                }

            })
            .catch((error) => {
                console.log(error)
                // const toast = document.getElementById("toastKO")
                // const bootToast = new bootstrap.Toast(toast)
                // bootToast.show()
            })
    }

    let inputidcurso = document.createElement("input");

    function modalBorrar(idcurso) {

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
        form.action = "javascript:delCurso()";
        form.id = "formularioborrar";

        // Inputs

        inputidcurso.name = "id_curso";
        inputidcurso.id = "curso";
        inputidcurso.value = ""+idcurso;
        inputidcurso.classList.add("d-none");


        //H5 y botoncerrar

        modalh5.classList.add("fs-6");
        modalh5.innerHTML = "Borrar";
        modalbotoncerrar.classList.add("btn-close");

        //Boton Guardar
        inputboton.type = "submit";
        inputboton.value = "Borrar";
        inputboton.id = "botonborrar";
        inputboton.classList.add("btn");
        inputboton.classList.add("btn-danger");
        inputboton.classList.add("mt-4");
        inputboton.disabled = false;

        //Footer
        modalfooter.classList.add("modal-footer");
        
        document.body.appendChild(modal);
        modal.appendChild(modalcontenido);
        modalcontenido.appendChild(modalheader);
        modalcontenido.appendChild(modalbody);
        modalcontenido.appendChild(modalfooter);
        modalheader.appendChild(modalh5);
        modalheader.appendChild(modalbotoncerrar);
        modalbody.appendChild(form);
        form.appendChild(inputidcurso);
        form.appendChild(inputboton);

        const closeModal = document.querySelector('.btn-close');

        closeModal.addEventListener('click', (e)=> {

            e.preventDefault();

            inputidcurso.value = "";
            inputidcurso.remove();

            modal.remove();

        });

    }

    async function delCurso(){

        const datosForm = new FormData(document.getElementById("formularioborrar"));

        await fetch(`<?php echo RUTA_URL?>/curso/del_curso`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {

                if(data){

                    if (elementos.length >= 1) {

                        pagActual = pagActual-1;

                    }

                    if (elementos.length >= 12) {
                        
                        elementos = elementos.filter(curso => curso.id_curso != datosForm.get('id_curso'));

                    } else { 

                        document.getElementById(datosForm.get('id_curso')).remove();

                    }

                    inputidcurso.value = "";
                    inputidcurso.remove();

                    modal.remove();

                    actualizarVariables();

                } else {

                    console.log("no se ha borrado");

                }

            })
            .catch((error) => {

                console.log(error)

            })
    }


</script>

<script>

    ///////////////////////////////////////////////////////////////////////// PAGINACION Y FILTROS //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    const objporpagina = 12;
    let pagActual = 1;
    let numpaginas;

    let elementos;

    let datosUsuario = <?php echo json_encode($datos['usuarioSesion']) ?>;

    if (datosUsuario.id_rol == 1) {

        elementos = <?php echo json_encode($datos['CursosProfesor'])?>;

    } else if (datosUsuario.id_rol == 2) {
    
        elementos = <?php echo json_encode($datos['CursosAlumno'])?>;

    } else if (datosUsuario.id_rol == 3) {

        elementos = <?php echo json_encode($datos['CursosAdmin'])?>;

    }
    
    let elementoscopia = elementos;

    window.onload = actualizarVariables();

    function busqueda() {

        var input = document.getElementById("buscador");
        let selectanyos = document.getElementById("selectanyos");
        let fecha_inicio = document.getElementById("buscador_fecha_inicio");
        let fecha_fin = document.getElementById("buscador_fecha_fin");

        if (selectanyos.value != "" && fecha_inicio.value != "" && fecha_fin.value != "") {

            elementos = elementoscopia.filter(
                o => o.nombre.toUpperCase().includes(input.value.toUpperCase()) 
                && o.anyo == selectanyos.value 
                && o.fecha_inicio == fecha_inicio.value 
                && o.fecha_fin == fecha_fin.value);

        } else if (selectanyos.value != "" && fecha_inicio.value != "") {

            elementos = elementoscopia.filter(
                o => o.nombre.toUpperCase().includes(input.value.toUpperCase()) 
                && o.anyo == selectanyos.value 
                && o.fecha_inicio == fecha_inicio.value );

        } else if (fecha_inicio.value != "" && fecha_fin.value != "") {

            elementos = elementoscopia.filter(
                o => o.nombre.toUpperCase().includes(input.value.toUpperCase()) 
                && o.fecha_inicio == fecha_inicio.value 
                && o.fecha_fin == fecha_fin.value );

        } else if (selectanyos.value != "" && fecha_fin.value != "") {

            elementos = elementoscopia.filter(
                o => o.nombre.toUpperCase().includes(input.value.toUpperCase()) 
                && o.anyo == selectanyos.value 
                && o.fecha_fin == fecha_fin.value );

        } else if (fecha_inicio.value != "") {

            elementos = elementoscopia.filter(
                o => o.fecha_inicio == fecha_inicio.value);

        } else if (fecha_fin.value != "") {

            elementos = elementoscopia.filter(
                o => o.fecha_fin == fecha_fin.value);

        } else if (selectanyos.value != "") {

            elementos = elementoscopia.filter(
                o => o.nombre.toUpperCase().includes(input.value.toUpperCase()) 
                && o.anyo == selectanyos.value);

        } else {

            elementos = elementoscopia.filter(o => o.nombre.toUpperCase().includes(input.value.toUpperCase()));
            
        }

        actualizarVariables();

    }


    function actualizarVariables() {

        numpaginas = Math.ceil(elementos.length / 12);
        
        generarNumPag(numpaginas);

        paginar(pagActual);

    }

    function generarNumPag(numpaginas) {

        let ulpaginacion = document.getElementById("ulpaginacion");

        if (ulpaginacion.hasChildNodes()) {

            while (ulpaginacion.firstChild) {
                ulpaginacion.removeChild(ulpaginacion.lastChild);
            }
        
        }

        let anterior = document.createElement("li");
        let aanterior = document.createElement("a");

        anterior.classList.add("page-item");
        anterior.id = "anteriorpag";
        anterior.setAttribute("onclick", "anteriorpag()");
        aanterior.classList.add("page-link");
        aanterior.innerHTML = "<";

        ulpaginacion.appendChild(anterior);
        anterior.appendChild(aanterior);
        
        for (let i = 1; i<=numpaginas; i++) {

            let numpag = document.createElement("li");
            let a = document.createElement("a");

            numpag.classList.add("page-item");
            numpag.setAttribute("onclick", "paginar("+i+")");

            a.classList.add("page-link");
            a.innerHTML = i;

            ulpaginacion.appendChild(numpag);
            numpag.appendChild(a);

        }

        let next = document.createElement("li");
        let anext = document.createElement("a");

        next.classList.add("page-item");
        next.id = "siguientepag";
        next.setAttribute("onclick", "siguientepag()");
        anext.classList.add("page-link");
        anext.innerHTML = ">";

        ulpaginacion.appendChild(next);
        next.appendChild(anext);

    }

    generarNumPag(numpaginas);

    function siguientepag() {

        pagActual = pagActual + 1;

        if (pagActual > numpaginas) {

            pagActual = numpaginas;

        }

        paginar(pagActual);

    };

    function anteriorpag() {

        pagActual = pagActual - 1;

        if (pagActual < 1) {

            pagActual = 1;

        }

        paginar(pagActual);

    };

    function paginar (pagina) {

        pagActual = pagina;

        let inicio = (pagActual-1) * objporpagina;
        let final = inicio + objporpagina;

        elementospag = elementos.slice(inicio, final);

        let curso = document.querySelectorAll(".objetocurso");

        if (curso !== null) {

            curso.forEach(element => {
                
                element.remove();

            });

        } 

        elementospag.forEach((elemento) => {

            let divrow = document.getElementById("divrow");
            let div1 = document.createElement("div");
            let div2 = document.createElement("div");
            let div3 = document.createElement("div");
            let a1 = document.createElement("a");
            let div4 = document.createElement("div");
            let p1 = document.createElement("p");
            let div5 = document.createElement("div");
            let p2 = document.createElement("p");
            let div6 = document.createElement("div");
            let a2 = document.createElement("a");
            let i1 = document.createElement("i");

            div1.classList.add("objetocurso");
            div1.classList.add("col-6");
            div1.classList.add("d-flex");
            div1.id = elemento.id_curso;
                
            
            div2.classList.add("card");
            div2.classList.add("col-12");

            div3.classList.add("row");
            div3.classList.add("card-body");

            a1.classList.add("text-decoration-none");
            a1.classList.add("text-dark");
            a1.classList.add("row");
            a1.classList.add("col-12");

            if (datosUsuario.id_rol == 3) {

                a1.classList.remove("col-12");
                a1.classList.add("col-9");

            }

            a1.href = "/Cuaderno/curso/ver_curso/"+elemento.id_curso;

            div4.classList.add("col-6");

            p1.innerHTML = elemento.nombre;

            div5.classList.add("col-6");
            div5.classList.add("d-flex");
            div5.classList.add("justify-content-end");

            p2.innerHTML = elemento.anyo;

            div6.classList.add("col-1");
            div6.classList.add("offset-2");

            a2.classList.add("col-12");
            a2.classList.add("text-decoration-none");
            a2.classList.add("text-dark");
            a2.classList.add("d-flex");
            a2.classList.add("justify-content-end");
            a2.href = "#";
            a2.setAttribute("onclick", "modalBorrar("+elemento.id_curso+")");

            i1.classList.add("bi");
            i1.classList.add("bi-trash");
            i1.classList.add("fs-4");

            divrow.appendChild(div1);
            div1.appendChild(div2);
            div2.appendChild(div3);
            div3.appendChild(a1);
            a1.appendChild(div4);
            a1.appendChild(div5);
            div4.appendChild(p1);
            div5.appendChild(p2);
            

            if (datosUsuario.id_rol == 3) {

                div3.appendChild(div6);
                div6.appendChild(a2);
                a2.appendChild(i1);

            }

        });
        
    }

</script>

<script>

    let addedanyos = [""];

    function rellenarSelectAnyos() {

        let selectanyos = document.getElementById("selectanyos");

        while (selectanyos.options.length) selectanyos.remove(0);

        elementos.forEach(function (elemento) {

            if (!addedanyos.includes(elemento.anyo)) {

                addedanyos.push(elemento.anyo);

            }

        });

        addedanyos.sort();
        
        addedanyos.forEach(function (anyo) {
            
            selectanyos.options.add(new Option(anyo));

        });

    }

</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>