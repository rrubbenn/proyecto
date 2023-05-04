<?php

class CursoModelo {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getCursos($id_persona){
        
        $this->db->query("SELECT C.* FROM Curso C INNER JOIN Participar_Profesor P ON C.id_curso = P.id_curso WHERE P.id_profesor = :id_profesor");
        
        $this->db->bind(':id_profesor',trim($id_persona));

        return $this->db->registros();
    }

    public function getAlumnos($id_curso){
        
        $this->db->query("SELECT Per.* FROM Persona Per 
                        INNER JOIN Alumno A 
                        INNER JOIN Participar_Alumno P 
                        WHERE A.id_alumno = P.id_alumno AND P.id_curso = :id_curso AND Per.id_persona=A.id_alumno");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

    public function getProfesores($id_curso){
        
        $this->db->query("SELECT Per.* FROM Persona Per 
                        INNER JOIN Profesor Pro 
                        INNER JOIN Participar_Profesor P 
                        WHERE Pro.id_profesor = P.id_profesor AND P.id_curso = :id_curso AND Per.id_persona=Pro.id_profesor");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

    public function getNombreCurso($id_curso) {

        $this->db->query("SELECT nombre FROM Curso WHERE id_curso = :id_curso");

        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registro();
        
    }

    public function getEvaluables($id_curso){
        
        $this->db->query("SELECT * FROM material m INNER JOIN evaluable e WHERE m.id_curso = :id_curso AND m.id_material = e.id_evaluable;");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

    public function getNoEvaluables($id_curso){
        
        $this->db->query("SELECT * FROM material m INNER JOIN noevaluable n WHERE m.id_curso = :id_curso AND m.id_material = n.id_noevaluable;");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }


    public function getMaterial($id_material) {

        $this->db->query("SELECT * FROM Material WHERE id_material = :id_material");

        $this->db->bind(':id_material',trim($id_material));

        return $this->db->registro();

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

    public function getCursoMaterial($id_material){
        
        $this->db->query("SELECT M.id_curso FROM Curso C INNER JOIN Material M WHERE C.id_curso = M.id_curso AND M.id_material = :id_material");
        
        $this->db->bind(':id_material',trim($id_material));

        return $this->db->registroIndividual();
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

    public function getNotas($id_material) {

        $this->db->query("SELECT * FROM Realizar WHERE id_evaluable = :id_material");

        $this->db->bind(':id_material',$datos['id_material']);

        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

    public function updateNotas($datos) {

        

    }

    public function addEvaluable($datos) {

        $this->db->query("INSERT INTO Material(nombre, descripcion, archivo, id_curso)
                                    VALUES (:nombre, :descripcion, :archivo, :id_curso)");

        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':descripcion',$datos['descripcion']);
        $this->db->bind(':archivo',$datos['archivo']);
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

        $this->db->query("INSERT INTO Material(nombre, descripcion, archivo, id_curso)
                                    VALUES (:nombre, :descripcion, :archivo, :id_curso)");

        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':descripcion',$datos['descripcion']);
        $this->db->bind(':archivo',$datos['archivo']);
        $this->db->bind(':id_curso',$datos['id_curso']);

        $id_noevaluable = $this->db->executeLastId();

        $this->db->query("INSERT INTO noevaluable(id_noevaluable)
                                    VALUES (:id_noevaluable)");

        $this->db->bind(':id_noevaluable',$id_noevaluable);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }
    }

}