<?php
class alumno{
    private $id;
    private $fields;
    private static $prefixSP = "sp_alumno_";
    
    public function __construct(){
        $this-> id = null;
        $this-> fields = array (
                        'codigo' => '',
                        'paterno' => '',
                        'materno' => '',
                        'nombres' => '',
                        'dni' => '',
                        'email'=>'',          
                        'telefono'=>'',
                        'celular'=>'',
                        'direccion'=>'',
                        'dni_padre'=>'',
                        'dni_madre'=>'');
    }
    
    public function __get($field){
        if ($field == 'id'){
            return $this-> id;
        }
        else{
            return $this-> fields[$field];
        }
    }

    public static function getAll(){
        global $mysqliP;
        $alumno = new alumno();
        $alumnos = array();
        $query = " SELECT
                    id,
                    codigo,
                    paterno,
                    materno,
                    nombres,
                    dni,
                    email,
                    telefono,
                    celular,
                    direccion,
                    dni_padre,
                    dni_madre
                  FROM `alumno` 
                  WHERE id > 1
                  ORDER BY `alumno`.`id` ASC LIMIT 20";
        $result = $mysqliP->query($query);
        $num_total_records = $result->num_rows;
        if($num_total_records>0){
            while($row = $result->fetch_assoc()){
                $alumnos[] = array( 
                  'id' => intval($row["id"]), 
                  'codigo' => intval($row['codigo']),
                  'paterno' => $row['paterno'],
                  'materno' => $row['materno'],
                  'nombres' => $row['nombres'],
                  'dni' => $row['dni'],
                  'email' => $row['email'],
                  'telefono' => $row['telefono'],
                  'celular' => $row['celular'],
                  'direccion' => $row['direccion'],
                  'dni_padre' => $row['dni_padre'],
                  'dni_madre' => $row['dni_madre']
                );
            }
        }
        clearStoredResultsP($mysqliP);
        return $alumnos;
    }
    
}