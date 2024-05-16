<?php

class PasajeroEspecial extends Pasajero{

    /* sillas de ruedas, asistencia para el embarque o desembarque
    para personas con alergias o restricciones alimentarias */
    private $ColNecEspeciales;


    public function __construct($nombre, $apellido, $nroDocumento, $telefono, $nroAsiento, $nroTicket,$ColNecEspeciales)
    {
        parent::__construct($nombre, $apellido, $nroDocumento, $telefono, $nroAsiento, $nroTicket);
        $this->ColNecEspeciales = $ColNecEspeciales;

    }

    /* GETTERS Y SETTERS */

    /**
     * Get /* sillas de ruedas, asistencia para el embarque o desembarque
     */ 
    public function getColNecEspeciales()
    {
        return $this->ColNecEspeciales;
    }

    /**
     * Set /* sillas de ruedas, asistencia para el embarque o desembarque
     *
     * @return  self
     */ 
    public function setColNecEspeciales($ColNecEspeciales)
    {
        $this->ColNecEspeciales = $ColNecEspeciales;
    }

    /* si requiere de silla de ruedas, asistencia y comida especial 
    incrementa un 30%. Si solo requiere uno de los servicios prestados 
    el incremento es del 10%. */
    public function darPorcentajeIncremento(){
        $porcentaje = parent::darPorcentajeIncremento();
        if(count($this->getColNecEspeciales()) == 3){
            $porcentaje = 0.3;
        }elseif(count($this->getColNecEspeciales()) == 2){
            $porcentaje = 0.2;
        }else{ #suponemos que solo requiere uno de los servicios
            $porcentaje = 0.15;
        }
        return $porcentaje;
    }

    /* modifica los datos de un determinado pasajero */
    public function modificarDatos($respuesta, $nuevoDato){
        switch($respuesta){
            case 1: #numero de documento
                $this->setNroDocumento($nuevoDato);
                break;
            case 2: #numero de telefono
                $this->setTelefono($nuevoDato);
                break;
            case 3: #numero de asiento
                $this->setNroAsiento($nuevoDato);
                break;
            case 4: #numero de ticket
                $this->setNroTicket($nuevoDato);
                break;
            case 5:
                $this->setColNecEspeciales($nuevoDato);
                break;
            default:

                break;
        }
    
    }

    public function arrayToString($coleccion){
        $string = "";
        foreach($coleccion as $elem){
            $string .= "\n".$elem;
        }
        return $string;
    }

    public function __toString()
    {
        return parent::__toString()."\n servicios especiales requeridos: ".$this->arrayToString($this->getColNecEspeciales());
    }
}