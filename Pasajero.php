<?php 

class Pasajero extends Persona{
    
    private $nroDocumento;
    private $telefono;
    private $nroAsiento;
    private $nroTicket;


    public function __construct($nombre, $apellido, $nroDocumento, $telefono, $nroAsiento, $nroTicket)
    {
        parent::__construct($nombre,$apellido);
        $this->nroDocumento = $nroDocumento;
        $this->telefono = $telefono;
        $this->nroAsiento = $nroAsiento;
        $this->nroTicket = $nroTicket;
    }

    /* GETTERS */
    public function getnroDocumento(){
        return $this->nroDocumento;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getNroAsiento(){
        return $this->nroAsiento;
    }
    public function getNroTicket(){
        return $this->nroTicket;
    }

    /* SETTERS */
    public function setNroDocumento($newNroDoc){
        $this->nroDocumento = $newNroDoc;
    }
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }
    public function setNroAsiento($newNroAsiento){
        $this->nroAsiento = $newNroAsiento;
    }
    public function setNroTicket($newNroTicket){
        $this->nroTicket = $newNroTicket;
    }

    /* retorna el porcentaje que debe aplicarse como incremento según 
    las características del pasajero. */
    public function darPorcentajeIncremento(){
        return 0.1;
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
                default:
                    break;
            }
        
    }

    public function __toString()
    {
        return parent::__toString()."\n".
        "numero de documento: ".$this->getnroDocumento()."\n".
        "numero telefónico: ".$this->getTelefono()."\n".
        "numero de asiento: ".$this->getNroAsiento()."\n".
        "numero de ticket: ".$this->getNroTicket(); 
    }
}