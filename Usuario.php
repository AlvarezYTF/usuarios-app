<?php 
require_once 'Database.php';
class Usuario extends Database { 
    public $id;
    public $primerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $fecha_nacimiento;
    public $telefono;

    public function __construct($id, $primerNombre,$segundoNombre,$primerApellido,$segundoApellido, $fecha_nacimiento, $telefono) {
        $this->id = $id;
        $this->primerNombre = $primerNombre;
        $this->segundoNombre = $segundoNombre;    
        $this->primerApellido=$primerApellido;
        $this->segundoApellido=$segundoApellido;    
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->telefono = $telefono;
    }

    public function Crear($id, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono){
        try {            
            $sql = "INSERT INTO usuarios (id, primerNombre, segundoNombre, primerApellido, segundoApellido, edad, telefono)VALUES (:id, :primerNmbre, :segundoNmbre, :primerApellido, :segundoApellido, :fecha_nacimiento, :telefono)";
            $con = $this->getConexion() ->prepare($sql);                     
            $con->bindParam(':id', $id);
            $con->bindParam(':primerNmbre', $primerNombre);
            $con->bindParam(':segundoNmbre', $segundoNombre);   
            $con->bindParam(':primerApellido', $primerApellido);
            $con->bindParam(':segundoApellido', $segundoApellido);
            $con->bindParam(':fecha_nacimiento', $fecha_nacimiento); 
            $con->bindParam(':telefono', $telefono);
            $con->execute();
            return true;
    
        }catch (PDOException $e) {
            echo "Error:" . $e ->getMessage();
            return false;
        }
    }
}