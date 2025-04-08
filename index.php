<?php

require_once('Usuario.php');

class Interfaz {
    private $usuario;

    public function __construct() {
    }

    public function menu() {
        echo "\nSelecciona una opción:\n";
        echo "1. Crear usuario\n";
        echo "2. Listar usuarios\n";
        echo "3. Buscar usuario por ID\n";
        echo "4. Eliminar usuario por ID\n";
        echo "5. Salir\n";

        $option = trim(fgets(STDIN));

        switch ($option) {
            case 1:
                $this->crearUsuario();
                break;
            case 2:
                $this->listarUsuarios();
                break;
            case 3:
                $this->buscarUsuarioPorID();
                break;
            case 4:
                $this->eliminarUsuarioPorID();
                break;
            case 5:
                echo "Saliendo...\n";
                exit;
            default:
                echo "Opción no válida. Intenta de nuevo.\n";
                $this->mostrarMenu();
        }
    }

    private function mostrarMenu() {
        $this->menu();
    }

    private function crearUsuario() {
        echo "Ingrese el primer nombre: ";
        $primerNombre = (readline("Ingrese el primer nombre: "));
        if (empty($primerNombre)) {
            echo "El primer nombre no puede estar vacío. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }
        $segundoNombre = (readline("Ingrese el segundo nombre: "));
        $primerApellido = (readline("Ingrese el primer apellido: "));
        if (empty($primerApellido)) {
            echo "El primer apellido no puede estar vacío. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }
        $segundoApellido = (readline("Ingrese el segundo apellido: "));
        $fecha_nacimiento = (readline("Ingrese la fecha de nacimiento (YYYY-MM-DD): "));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_nacimiento)) {
            echo "Formato de fecha inválido. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }
        $telefono = (readline("Ingrese el teléfono: "));
        if (!preg_match('/^\d{10}$/', $telefono)) {
            echo "El teléfono debe tener 10 dígitos. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }
        
        $this->usuario = new Usuario(null, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono);

        if ($this->usuario->Crear($this->usuario->id, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono)) {
            echo "Usuario creado exitosamente.\n";
        } else {
            echo "Error al crear el usuario.\n";
        }

        $this->mostrarMenu();
    }

    private function listarUsuarios() {
        echo "Función no implementada aún.\n";
        $this->mostrarMenu();
    }

    private function buscarUsuarioPorID() {
        echo "Función no implementada aún.\n";
        $this->mostrarMenu();
    }

    private function eliminarUsuarioPorID() {
        echo "Función no implementada aún.\n";
        $this->mostrarMenu();
    }
}

// Iniciar la interfaz
$interfaz = new Interfaz();
$interfaz->menu();