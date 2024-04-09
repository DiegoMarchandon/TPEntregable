<?php

class ResponsableV {
    private $nroEmpleado;
    private $nroLicencia;
    private $nombreYapellido;

    public function __construct($nroEmpleado, $nroLicencia, $nombreYapellido)
    {      
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
        $this->nombreYapellido = $nombreYapellido;
    }


    public function getNroEmpleado(){
        return $this->nroEmpleado;        
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
    }
    public function getNombreYapellido(){
        return $this->nombreYapellido;
    }

    public function setNroEmpleado($newNroEmpleado){
        $this->nroEmpleado = $newNroEmpleado;
    }
    public function setNroLicencia($newNroLicencia){
        $this->nroLicencia = $newNroLicencia;
    }
    public function setNombreYapellido($newNombreYapellido){
        $this->nombreYapellido = $newNombreYapellido;
    }


    public function __toString()
    {
        return "nombre y apellido: ".$this->getNombreYapellido()."\n".
        "numero de empleado: ".$this->getNroEmpleado()."\n".
        "numero de licencia: ".$this->getNroLicencia()."\n";
    }
}