<?php
class Database
{
    protected $server = "localhost";
    protected $user = "root";
    protected $pass = "";
    protected $conn;

    public function __construct()
    {
        try {
            $this->conexion();
        } catch (PDOException $e) {
            echo "Conexión no valida porqué: " . $e->getMessage();
        }
    }

    protected function conexion()
    {
        $this->conn = new PDO("mysql:host=$this->server", $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConexion()
    {
        return $this->conn;
    }
}
