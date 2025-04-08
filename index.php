<?php

require_once('Usuario.php');

class Interfaz extends Usuario
{
    private $usuario;

    public function __construct()
    {
        parent::__construct();
        $this->usuario = new Usuario();
    }

    public function menu()
    {

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

    private function mostrarMenu()
    {
        $this->menu();
    }

    private function crearUsuario()
    {
        echo "Ingrese el primer nombre: ";
        $primerNombre = trim(fgets(STDIN));
        if (empty($primerNombre)) {
            echo "El primer nombre no puede estar vacío. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }

        echo "Ingrese el segundo nombre: ";
        $segundoNombre = trim(fgets(STDIN));

        echo "Ingrese el primer apellido: ";
        $primerApellido = trim(fgets(STDIN));
        if (empty($primerApellido)) {
            echo "El primer apellido no puede estar vacío. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }

        echo "Ingrese el segundo apellido: ";
        $segundoApellido = trim(fgets(STDIN));

        echo "Ingrese la fecha de nacimiento (YYYY-MM-DD): ";
        $fecha_nacimiento = trim(fgets(STDIN));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_nacimiento)) {
            echo "Formato de fecha inválido. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }

        echo "Ingrese el teléfono: ";
        $telefono = trim(fgets(STDIN));
        if (!preg_match('/^\d{10}$/', $telefono)) {
            echo "El teléfono debe tener 10 dígitos. Intenta de nuevo.\n";
            return $this->crearUsuario();
        }

        // Intentar crear el usuario en la base de datos
        if ($this->usuario->Crear($primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono)) {
            echo "Usuario creado exitosamente.\n";
        } else {
            echo "Error al crear el usuario.\n";
        }

        $this->mostrarMenu();
    }

    private function listarUsuarios()
    {
        $usuarios = $this->usuario->Listar();
        if ($usuarios === false) {
            echo "Error al obtener la lista de usuarios.\n";
        } elseif (empty($usuarios)) {
            echo "No se encontraron usuarios.\n";
        } else {
            echo "Lista de usuarios:\n";
            foreach ($usuarios as $usuario) {
                echo "Nombre Completo: {$usuario['nombre_completo']}, ";
                echo "Edad: {$usuario['edad']} años, ";
                echo "Teléfono: {$usuario['telefono']}\n";
            }
        }
        $this->mostrarMenu();
    }

    private function buscarUsuarioPorID()
    {
        echo "Función no implementada aún.\n";
        $this->mostrarMenu();
    }

    private function eliminarUsuarioPorID()
    {
        echo "Función no implementada aún.\n";
        $this->mostrarMenu();
    }
}

// Iniciar la interfaz
$interfaz = new Interfaz();
$interfaz->menu();
