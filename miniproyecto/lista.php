<?php
// agenda/lista.php

class Contacto {
    public $nombre;
    public $telefono;
    public $email;
    public $next;

    public function __construct($nombre, $telefono, $email) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->next = null;
    }
}

class ListaEnlazada {
    private $head;

    public function __construct() {
        $this->head = null;
    }

    public function insertar($nombre, $telefono, $email) {
        $nuevo = new Contacto($nombre, $telefono, $email);
        if ($this->head === null) {
            $this->head = $nuevo;
        } else {
            $temp = $this->head;
            while ($temp->next !== null) $temp = $temp->next;
            $temp->next = $nuevo;
        }
    }

    public function eliminar($nombre) {
        if ($this->head === null) return false;

        if (strcasecmp($this->head->nombre, $nombre) === 0) {
            $this->head = $this->head->next;
            return true;
        }

        $temp = $this->head;
        while ($temp->next !== null && strcasecmp($temp->next->nombre, $nombre) !== 0) {
            $temp = $temp->next;
        }

        if ($temp->next !== null) {
            $temp->next = $temp->next->next;
            return true;
        }

        return false;
    }

    public function obtenerTodos() {
        $result = [];
        $temp = $this->head;
        while ($temp !== null) {
            $result[] = $temp;
            $temp = $temp->next;
        }
        return $result;
    }
}
