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
    public $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }


    public function Crear($primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono)
    {
        if (!$this->conn) {
            echo "Database connection not established.";
            return false;
        } {
            try {
                $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono)
                    VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, :telefono)";
                $con = $this->conn->prepare($sql);
                $con->bindParam(':primer_nombre', $primerNombre);
                $con->bindParam(':segundo_nombre', $segundoNombre);
                $con->bindParam(':primer_apellido', $primerApellido);
                $con->bindParam(':segundo_apellido', $segundoApellido);
                $con->bindParam(':fecha_nacimiento', $fecha_nacimiento);
                $con->bindParam(':telefono', $telefono);
                $con->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
}
