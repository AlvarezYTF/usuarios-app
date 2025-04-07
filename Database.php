<?php
class Database
{
    protected $server = "localhost";
    protected $user = "root";
    protected $db = "usuario";
    protected $pass = "";
    protected $conn;

    public function __construct()
    {
        $this->conexion();
        $this->crearDb();
        $this->crearTabla();
    }

    protected function conexion()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("La conexión falló porque: " . $e->getMessage());
        }
    }

    private function crearDb()
    {
        try {
            $sql = "CREATE DATABASE $this->db";
            $this->query($sql);
        } catch (PDOException $e) {
            throw new Exception("No se puede crear la base porqué:" . "\n" . $e->getMessage());
        }
    }

    private function crearTabla()
    {
        try {
            $db = "USE $this->db";
            $this->query($db);
            $sql = "CREATE TABLE usuarios ( 
            id INT AUTO_INCREMENT PRIMARY KEY, 
            primer_nombre VARCHAR(50) NOT NULL,
            segundo_nombre VARCHAR(50) NULL,
            primer_apellido VARCHAR(50) NOT NULL,
            segundo_apellido VARCHAR(50) NULL,
            fecha_nacimiento DATE NOT NULL,
            telefono VARCHAR(10) NOT NULL
            )";
            $this->query($sql);
        } catch (PDOException $e) {
            throw new Exception("No se puede crear la tabla porqué:" . "\n" . $e->getMessage());
        }
    }

    private function query($sql)
    {
        $this->conn->exec($sql);
    }
}
