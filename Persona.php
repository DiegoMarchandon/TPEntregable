<?php

class Persona{
    private $nombre;
    private $apellido;

    public function __construct($nombre,$apellido)
    {
        $this->nombre=$nombre;
        $this->apellido=$apellido;
    }

    /* GETTERS Y SETTERS */
    

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;


    }

    /**
     * Get the value of apellido
     */ 
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */ 
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;


    }


    public function __toString()
    {
        return "nombre: ".$this->getNombre()."\n".
        "apellido: ".$this->getApellido()."\n";
    }
}