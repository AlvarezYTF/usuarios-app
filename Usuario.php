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

    public function Listar()
    {
        if (!$this->conn) {
            echo "Database connection not established.";
            return false;
        }
        try {
            $sql = "SELECT primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono FROM usuarios";
            $con = $this->conn->prepare($sql);
            $con->execute();
            $usuarios = $con->fetchAll(PDO::FETCH_ASSOC);

            $usuariosConDatos = array_map(function ($usuario) {
                $usuario['nombre_completo'] = trim("{$usuario['primer_nombre']} {$usuario['segundo_nombre']} {$usuario['primer_apellido']} {$usuario['segundo_apellido']}");
                $usuario['edad'] = $this->calcularEdad($usuario['fecha_nacimiento']);
                return [
                    'nombre_completo' => $usuario['nombre_completo'],
                    'edad' => $usuario['edad'],
                    'telefono' => $usuario['telefono']
                ];
            }, $usuarios);

            return $usuariosConDatos;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    private function calcularEdad($fechaNacimiento)
    {
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        return $edad;
    }
    public function Actualizar($id, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono)
    {
        if (!$this->conn) {
            echo "Database connection not established.";
            return false;
        }


        try {
            $sqlCheck = "SELECT * FROM usuarios WHERE id = :id";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':id', $id);
            $stmtCheck->execute();
            $usuario = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                echo "El usuario con ID $id no existe.\n";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al verificar el usuario: " . $e->getMessage();
            return false;
        }

        try {
            $sql = "UPDATE usuarios 
                SET primer_nombre = :primer_nombre, 
                    segundo_nombre = :segundo_nombre, 
                    primer_apellido = :primer_apellido, 
                    segundo_apellido = :segundo_apellido, 
                    fecha_nacimiento = :fecha_nacimiento, 
                    telefono = :telefono 
                WHERE id = :id";
            $con = $this->conn->prepare($sql);
            $con->bindParam(':id', $id);
            $con->bindParam(':primer_nombre', $primerNombre);
            $con->bindParam(':segundo_nombre', $segundoNombre);
            $con->bindParam(':primer_apellido', $primerApellido);
            $con->bindParam(':segundo_apellido', $segundoApellido);
            $con->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $con->bindParam(':telefono', $telefono);
            $con->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar el usuario: " . $e->getMessage();
            return false;
        }
    }
    public function Eliminar($id)
    {
        if (!$this->conn) {
            echo "Database connection not established.";
            return false;
        }

        try {

            $sqlCheck = "SELECT * FROM usuarios WHERE id = :id";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':id', $id);
            $stmtCheck->execute();
            $usuario = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                echo "El usuario con ID $id no existe.\n";
                return false;
            }

            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al eliminar el usuario: " . $e->getMessage();
            return false;
        }
    }
}
