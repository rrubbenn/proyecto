<?php

class CursoModelo {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    ////////////////RELACIONADO CON index ///////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function getCursosProfesor($id_persona){
        
        $this->db->query("SELECT C.* FROM Curso C INNER JOIN Participar_Profesor P ON C.id_curso = P.id_curso WHERE P.id_profesor = :id_profesor");
        
        $this->db->bind(':id_profesor',trim($id_persona));

        return $this->db->registros();
    }

    public function getCursosAlumno($id_persona){
        
        $this->db->query("SELECT C.* FROM Curso C INNER JOIN Participar_Alumno P ON C.id_curso = P.id_curso WHERE P.id_alumno = :id_alumno");
        
        $this->db->bind(':id_alumno',trim($id_persona));

        return $this->db->registros();
    }

    public function getCursosAdmin(){
        
        $this->db->query("SELECT C.* FROM Curso C");

        return $this->db->registros();
    }

    public function addCurso($datos) {

        $this->db->query("INSERT INTO Curso(nombre, fecha_inicio, fecha_fin, anyo)
                                    VALUES (:nombre, :fecha_inicio, :fecha_fin, :anyo)");

        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':fecha_inicio',$datos['fecha_inicio']);
        $this->db->bind(':fecha_fin',$datos['fecha_fin']);
        $this->db->bind(':anyo',$datos['anyo']);
        
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return $this->db->getLastId();

        } else {

            return false;

        }
    }

    public function delCurso($id_curso) {

        $this->db->query("DELETE FROM Curso WHERE id_curso = :id_curso");

        $this->db->bind(':id_curso',$id_curso);
            
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    /////////////RELACIONADO CON ver_curso //////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function getEvaluables($id_curso){
        
        $this->db->query("SELECT * FROM Material m INNER JOIN Evaluable e WHERE m.id_curso = :id_curso AND m.id_material = e.id_evaluable;");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

    public function getNoEvaluables($id_curso){
        
        $this->db->query("SELECT * FROM Material m INNER JOIN Noevaluable n WHERE m.id_curso = :id_curso AND m.id_material = n.id_noevaluable;");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    ///////////RELACIONADO CON ver_profesores////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function getProfesores($id_curso){
        
        $this->db->query("SELECT Per.* FROM Persona Per 
                        INNER JOIN Profesor Pro 
                        INNER JOIN Participar_Profesor P 
                        WHERE Pro.id_profesor = P.id_profesor AND P.id_curso = :id_curso AND Per.id_persona=Pro.id_profesor");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

    public function addProfesorCurso($datos) {

        $this->db->query("INSERT INTO Participar_Profesor(id_profesor, id_curso)
                                    VALUES (:id_profesor, :id_curso)");

        $this->db->bind(':id_profesor',$datos['id_profesor']);
        $this->db->bind(':id_curso',$datos['id_curso']);
            
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function deleteProfesorCurso($datos) {

        $this->db->query("DELETE FROM Participar_Profesor WHERE id_profesor = :id_profesor AND id_curso = :id_curso");
        
        $this->db->bind(':id_profesor',$datos['id_persona']);
        $this->db->bind(':id_curso',$datos['id_curso']);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function getProfesorSelectDNI($id_curso){
        
        $this->db->query("SELECT P.dni, P.nombre, P.apellidos FROM Persona P 
                            WHERE EXISTS (SELECT * FROM Profesor Pr WHERE P.id_persona = Pr.id_profesor)
                            AND NOT EXISTS (SELECT * FROM Participar_Profesor PP WHERE P.id_persona = PP.id_profesor AND PP.id_curso = :id_curso)");

        $this->db->bind(':id_curso',$id_curso);

        return $this->db->registros();
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    /////////////RELACIONADO CON ver_alumnos/////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function getAlumnos($id_curso){
        
        $this->db->query("SELECT Per.* FROM Persona Per 
                        INNER JOIN Alumno A 
                        INNER JOIN Participar_Alumno P 
                        WHERE A.id_alumno = P.id_alumno AND P.id_curso = :id_curso AND Per.id_persona=A.id_alumno");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

    public function addAlumnoCurso($datos) {

        $this->db->query("INSERT INTO Participar_Alumno(id_alumno, id_curso)
                                    VALUES (:id_alumno, :id_curso)");

        $this->db->bind(':id_alumno',$datos['id_alumno']);
        $this->db->bind(':id_curso',$datos['id_curso']);
            
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function deleteAlumnoCurso($datos) {

        $this->db->query("DELETE FROM Participar_Alumno WHERE id_alumno = :id_alumno AND id_curso = :id_curso");
        
        $this->db->bind(':id_alumno',$datos['id_persona']);
        $this->db->bind(':id_curso',$datos['id_curso']);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function getAlumnoSelectDNI($id_curso){
        
        $this->db->query("SELECT P.dni, P.nombre, P.apellidos FROM Persona P 
                            WHERE EXISTS (SELECT * FROM Alumno A WHERE P.id_persona = A.id_alumno)
                            AND NOT EXISTS (SELECT * FROM Participar_Alumno PA WHERE P.id_persona = PA.id_alumno AND PA.id_curso = :id_curso)");

        $this->db->bind(':id_curso',$id_curso);

        return $this->db->registros();
    }
    
    // FUNCION PARA ver_alumnos Y ver_profesores
    public function getDatosDNI($dni) {

        $this->db->query("SELECT P.id_persona, P.nombre, P.apellidos, P.mail, P.telefono 
                        FROM Persona P WHERE P.dni = :dni");

        $this->db->bind(':dni',$dni);

        return $this->db->registros();

    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    /////////////RELACIONADO CON ver_material////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function getMaterial($id_material) {

        $this->db->query("SELECT * FROM Material WHERE id_material = :id_material");

        $this->db->bind(':id_material',trim($id_material));

        return $this->db->registro();

    }

    public function getCursoMaterial($id_material){
        
        $this->db->query("SELECT M.id_curso FROM Curso C INNER JOIN Material M WHERE C.id_curso = M.id_curso AND M.id_material = :id_material");
        
        $this->db->bind(':id_material',trim($id_material));

        return $this->db->registroIndividual();
    }

    public function getAlumnosRealizados($id_material){
        
        $this->db->query("SELECT P.id_persona, P.nombre FROM Realizar R INNER JOIN Persona P WHERE R.id_evaluable = :id_material AND R.id_alumno = P.id_persona");
        
        $this->db->bind(':id_material',trim($id_material));

        return $this->db->registros();
    }
    
    public function getAlumnosNoRealizados($id_material){
        
        $this->db->query("SELECT P.id_persona, P.nombre
                        FROM Alumno A INNER JOIN Persona P
                        LEFT JOIN Realizar R ON A.id_alumno = R.id_alumno AND R.id_evaluable = :id_material
                        WHERE R.id_alumno IS NULL AND A.id_alumno = P.id_persona");
        
        $this->db->bind(':id_material',trim($id_material));

        return $this->db->registros();
    }

    public function addNotas($datos) {

        $this->db->query("INSERT INTO Realizar(id_alumno, id_evaluable, nota, observaciones)
                                    VALUES (:id_alumno, :id_evaluable, :nota, :observaciones)");

        $this->db->bind(':id_alumno',$datos['id_alumno']);
        $this->db->bind(':id_evaluable',$datos['id_material']);
        $this->db->bind(':nota',$datos['nota']);
        $this->db->bind(':observaciones',$datos['observacion']);
            
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }

    }

    public function editNotas($datos) {

        $this->db->query("UPDATE Realizar SET nota = :nota, observaciones = :observaciones WHERE id_alumno = :id_alumno AND id_evaluable = :id_evaluable");

        $this->db->bind(':id_alumno',$datos['id_alumno']);
        $this->db->bind(':id_evaluable',$datos['id_material']);
        $this->db->bind(':nota',$datos['nota']);
        $this->db->bind(':observaciones',$datos['observacion']);
            
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }

    }

    public function deleteNotas($datos) {

        $this->db->query("DELETE FROM Realizar WHERE id_alumno = :id_alumno AND id_evaluable = :id_evaluable");

        $this->db->bind(':id_alumno',$datos['id_alumno']);
        $this->db->bind(':id_evaluable',$datos['id_material']);


        print_r($datos);
            
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }

    }

    public function getNotas($datos) {

        $this->db->query("SELECT * FROM Realizar WHERE id_evaluable = :id_material AND id_alumno = :id_alumno");

        $this->db->bind(':id_material',$datos['id_material']);
        $this->db->bind(':id_alumno',$datos['id_alumno']);

        return $this->db->registro();

    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    ////////////////RELACIONADO CON ver_curso////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function addEvaluable($datos) {

        $this->db->query("INSERT INTO Material(nombre, descripcion, id_curso)
                                    VALUES (:nombre, :descripcion, :id_curso)");

        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':descripcion',$datos['descripcion']);
        $this->db->bind(':id_curso',$datos['id_curso']);

        $id_evaluable = $this->db->executeLastId();

        $this->db->query("INSERT INTO Evaluable(id_evaluable)
                                    VALUES (:id_evaluable)");

        $this->db->bind(':id_evaluable',$id_evaluable);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function addNoEvaluable($datos) {

        $this->db->query("INSERT INTO Material(nombre, descripcion, id_curso)
                                    VALUES (:nombre, :descripcion, :id_curso)");

        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':descripcion',$datos['descripcion']);
        $this->db->bind(':id_curso',$datos['id_curso']);

        $id_noevaluable = $this->db->executeLastId();

        $this->db->query("INSERT INTO Noevaluable(id_noevaluable)
                                    VALUES (:id_noevaluable)");

        $this->db->bind(':id_noevaluable',$id_noevaluable);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function updateMaterial($datos) {

        $this->db->query("UPDATE Material SET nombre = :nombre, descripcion = :descripcion WHERE id_material = :id_material");

        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':descripcion',$datos['descripcion']);
        $this->db->bind(':id_material',$datos['id_material']);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function deleteMaterial($datos) {

        $this->db->query("DELETE FROM Material WHERE id_material = :id_material");
        
        $this->db->bind(':id_material',$datos['id_material']);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function getDatosMaterial($datos) {

        $this->db->query("SELECT nombre, descripcion FROM Material WHERE id_material = :id_material");

        $this->db->bind(':id_material',$datos['id_material']);

        return $this->db->registro();

    }


        // public function getNombreCurso($id_curso) {

    //     $this->db->query("SELECT nombre FROM Curso WHERE id_curso = :id_curso");

    //     $this->db->bind(':id_curso',trim($id_curso));

    //     return $this->db->registro();
        
    // }
}