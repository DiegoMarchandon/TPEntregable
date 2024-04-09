<?php

class Viaje{
    private $codigoViaje; #propio del viaje.
    private $destino;   #string
    private $cantMaxPasajeros; #entero
    private $colObjPasajeros; #colObjPersona
    private $objEmpleado; #objeto/clase responsableV

    public function __construct($codigoViaje, $destino, $cantMaxPasajeros, $colObjPasajeros, $objEmpleado){
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->colObjPasajeros = $colObjPasajeros;
        $this->objEmpleado = $objEmpleado;
    }
    public function getCodigoViaje(){
        return $this->codigoViaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function getcolObjPasajeros(){
        return $this->colObjPasajeros;
    }
    public function getObjEmpleado(){
        return $this->objEmpleado;
    }
    
    public function setCodigoViaje($newCodigo){
        $this->codigoViaje = $newCodigo;
    }
    public function setDestino($newDestino){
        $this->destino = $newDestino;
    }
    public function setCantMaxPasajeros($newCantMax){
        $this->cantMaxPasajeros = $newCantMax;
    }
    public function setcolObjPasajeros($newPasajeros){
        $this->colObjPasajeros = $newPasajeros;
    }
    public function setObjEmpleado($newEmpleado){
        $this->objEmpleado = $newEmpleado;
    }

    public function pasajerosArrayToString(){
        $pasajeros = $this->getcolObjPasajeros();
        $pasajerosString = "";
        for($i = 0; $i < count($pasajeros); $i++){
            $pasajerosString .= "\n--------------------------------------------------\n".
            $pasajeros[$i]
            ."\n--------------------------------------------------\n";
        }
        return $pasajerosString;
    }
     
    public function __toString()
    {
        return "\n--------------------------------------------------\n".
        "codigo de viaje: ".$this->getCodigoViaje()."\n".
        "destino de viaje: ".$this->getDestino()."\n".
        "cantidad máxima de pasajeros: ".$this->getCantMaxPasajeros()."\n".
        "pasajeros del viaje: ".$this->pasajerosArrayToString()."\n".
        "responsable del viaje: \n".$this->getObjEmpleado();
    }
}