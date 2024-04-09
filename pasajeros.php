<?php 

class Pasajero{
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;

    public function __construct($nombre, $apellido, $nroDocumento, $telefono)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroDocumento = $nroDocumento;
        $this->telefono = $telefono;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getnroDocumento(){
        return $this->nroDocumento;
    }
    public function getTelefono(){
        return $this->telefono;
    }

    public function setNombre($newNombre){
        $this->nombre = $newNombre;
    }
    public function setApellido($newApellido){
        $this->apellido = $newApellido;
    }
    public function setNroDocumento($newNroDoc){
        $this->nroDocumento = $newNroDoc;
    }
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }

    public function __toString()
    {
        return "nombre: ".$this->getNombre()."\n".
        "apellido: ".$this->getApellido()."\n".
        "numero de documento: ".$this->getnroDocumento()."\n".
        "numero telefónico: ".$this->getTelefono();   
    }
}