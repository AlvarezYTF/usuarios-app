<?php
class Database
{
    protected $server = "localhost";
    protected $user = "root";
    protected $pass = "";
    protected $conn;

    public function __construct()
    {
        $this->conexion();
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

    public function getConexion()
    {
        return $this->conn;
    }
}