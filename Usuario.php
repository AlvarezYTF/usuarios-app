<?php
require_once 'Database.php';
class Usuario extends Database
{
    public $primerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $fecha_nacimiento;
    public $telefono;

    public function __construct($primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono)
    {

        $this->primerNombre = $primerNombre;
        $this->segundoNombre = $segundoNombre;
        $this->primerApellido = $primerApellido;
        $this->segundoApellido = $segundoApellido;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->telefono = $telefono;
    }

    public function Crear()
    {
        try {
            $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono)VALUES (primer_nombre, segundo_nombre, primer_apellido,segundo_apellido,fecha_nacimiento, telefono)";
            $con = $this->conn->prepare($sql);
            $con->bindParam('primer_nombre', $this->primerNombre);
            $con->bindParam('segundo_nombre', $this->segundoNombre);
            $con->bindParam('primer_apellido', $this->primerApellido);
            $con->bindParam('segundo_apellido', $this->segundoApellido);
            $con->bindParam('fecha_nacimiento', $this->fecha_nacimiento);
            $con->bindParam('telefono', $this->telefono);
            $con->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            return false;
        }
    }
}
