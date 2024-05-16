<?php

class ResponsableV extends Persona {
    private $nroEmpleado;
    private $nroLicencia;

    public function __construct($nombre, $apellido, $nroEmpleado, $nroLicencia)
    {      
        parent::__construct($nombre,$apellido);
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
        
    }


    public function getNroEmpleado(){
        return $this->nroEmpleado;        
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
    }

    public function setNroEmpleado($newNroEmpleado){
        $this->nroEmpleado = $newNroEmpleado;
    }
    public function setNroLicencia($newNroLicencia){
        $this->nroLicencia = $newNroLicencia;
    }


    public function __toString()
    {
        return parent::__toString()."\n".
        "numero de empleado: ".$this->getNroEmpleado()."\n".
        "numero de licencia: ".$this->getNroLicencia()."\n";
    }
}