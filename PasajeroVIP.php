<?php

class PasajeroVIP extends Pasajero{

    private $nroViajeroFrecuente;
    private $cantMillas;


    public function __construct($nombre, $apellido, $nroDocumento, $telefono, $nroAsiento, $nroTicket, $nroViajeroFrecuente,$cantMillas)
    {
        parent::__construct($nombre, $apellido, $nroDocumento, $telefono, $nroAsiento, $nroTicket);
        $this->nroViajeroFrecuente = $nroViajeroFrecuente;
        $this->cantMillas = $cantMillas;
    }

    /* GETTERS Y SETTERS */

    /**
     * Get the value of nroViajeroFrecuente
     */ 
    public function getNroViajeroFrecuente()
    {
        return $this->nroViajeroFrecuente;
    }

    /**
     * Set the value of nroViajeroFrecuente
     *
     * @return  self
     */ 
    public function setNroViajeroFrecuente($nroViajeroFrecuente)
    {
        $this->nroViajeroFrecuente = $nroViajeroFrecuente;

         
    }

    /**
     * Get the value of cantMillas
     */ 
    public function getCantMillas()
    {
        return $this->cantMillas;
    }

    /**
     * Set the value of cantMillas
     *
     * @return  self
     */ 
    public function setCantMillas($cantMillas)
    {
        $this->cantMillas = $cantMillas;

    }
    /* incrementa el importe en un 35%. 
    Si la cantidad de millas acumuladas supera las 300, se incrementa en 30% */
    public function darPorcentajeIncremento(){
        $porcentaje = parent::darPorcentajeIncremento();
        $porcentaje = 0.35;
        if($this->getCantMillas() > 300){
            $porcentaje = 0.3;
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
                $this->setNroViajeroFrecuente($nuevoDato);
                break;
            case 6:
                $this->setCantMillas($nuevoDato);
                break;
            default:

                break;
        }
    
    }

    public function __toString()
    {
        return parent::__toString()."\n numero de viajero frecuente: ".$this->getNroViajeroFrecuente()."\n".
        "cantidad de millas: ".$this->getCantMillas();
    }
}