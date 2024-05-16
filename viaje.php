<?php

class Viaje{
    private $codigoViaje; #propio del viaje.
    private $destino;   #string
    private $cantMaxPasajeros; #entero
    private $colObjPasajeros; 
    private $objResponsable; #objeto/clase responsableV
    private $costoViaje;
    private $costosAbonados; #suma de los costos abunados por los pasajeros
    #como costos abonados depende de la suma de todos los costos de los pasajeros, no lo incluí en el constroctor
        #sino que lo calculo con la cantidad de pasajeros, lo que deben abonar y lo actualizo con venderPasaje() a medida que se ingresan futuros pasajeros.
    public function __construct($codigoViaje, $destino, $cantMaxPasajeros, $costoViaje, $colObjPasajeros, $objResponsable){
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->costoViaje = $costoViaje;
        $this->colObjPasajeros = $colObjPasajeros;
        $this->objResponsable = $objResponsable; 
    }

    /* GETTERS */
    public function getCodigoViaje(){
        return $this->codigoViaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    } 
    public function getCostoViaje()
    {
        return $this->costoViaje;
    }
    public function getcolObjPasajeros(){
        return $this->colObjPasajeros;
    }
    public function getObjResponsable(){
        return $this->objResponsable;
    }
    public function getCostosAbonados()
    {
        return $this->costosAbonados;
    }
    
    /* SETTERS */
    public function setCodigoViaje($newCodigo){
        $this->codigoViaje = $newCodigo;
    }
    public function setDestino($newDestino){
        $this->destino = $newDestino;
    }
    public function setCantMaxPasajeros($newCantMax){
        $this->cantMaxPasajeros = $newCantMax;
    }
    
    public function setCostoViaje($costoViaje)
    {
        $this->costoViaje = $costoViaje;
    }
    public function setcolObjPasajeros($newPasajeros){
        $this->colObjPasajeros = $newPasajeros;
    }
    public function setObjResponsable($newResponsable){
        $this->objResponsable = $newResponsable;
    }
    public function setCostosAbonados($costosAbonados)
    {
        $this->costosAbonados = $costosAbonados;
    }

    /* método que calcula el valor de costosAbonados */
    public function calcularCostosAbonados(){
        foreach($this->getcolObjPasajeros() as $pasajero){
            
            $costoAbonado = $this->getCostosAbonados();
            $costoAbonado += ($this->getCostoViaje() * (1+$pasajero->darPorcentajeIncremento()));
            $this->setCostosAbonados($costoAbonado);
        }
        return $costoAbonado;
    }

    /* método que actualiza el valor de los costosAbonados */
    public function actualizarCostosAbonados($nuevoPasajero){
        $costoAbonadoActual = $this->calcularCostosAbonados();
        $costoAbonadoActual += ($this->getCostoViaje()* (1+$nuevoPasajero->darPorcentajeIncremento()));
        $this->setCostosAbonados($costoAbonadoActual);
        // return $costoAbonadoActual;
    }

    public function pasajerosArrayToString(){
        $pasajeros = $this->getcolObjPasajeros();
        $pasajerosString = "";
        for($i = 0; $i < count($pasajeros); $i++){
            $pasajerosString .= "\n--------------------------------------------------\n".
            "pasajero numero ".($i+1).":\n".$pasajeros[$i]
            ."\n--------------------------------------------------\n";
        }
        return $pasajerosString;
    }

    /* retorna verdadero si la cantidad de pasajeros es menor a la cantidad máxima.
    False en caso contrario. */

    public function hayPasajesDisponibles(){
        $pasajesDisp = false;
        if($this->getCantMaxPasajeros() > count($this->getcolObjPasajeros())){
            $pasajesDisp = true;
        }
        return !$pasajesDisp;
    }

    /* incorporará al pasajero a la colección solo si hay espacio disponible.
    Actualizar los costos abonados y retornar el costo final que deberá ser abonado por el pasajero. */
    public function venderPasaje($objPasajero){
        
        if($this->hayPasajesDisponibles()){
            $colPasajeros = $this->getcolObjPasajeros();
            $colPasajeros[] = $objPasajero;
            $this->setcolObjPasajeros($colPasajeros);
            $costoFinal = $this->getCostoViaje() * (1+$objPasajero->darPorcentajeIncremento());
            $this->actualizarCostosAbonados($objPasajero);
        }else{
            $costoFinal = -1;
        }
        return $costoFinal;
    }

    /* -------------FUNCION CREADA--------------- */

    /* verifica si un DNI, un teléfono o un numero de ticket están duplicados */
    public function datoDuplicado($dato, $comparacion){
        $duplicado = false;
        $i = 0;
        $colObjPasajeros = $this->getcolObjPasajeros();
        while(($i < count($colObjPasajeros)) && $duplicado == false){
            if(strcasecmp($comparacion,"dni")== 0){
                if($dato == $colObjPasajeros[$i]->getnroDocumento()){
                    $duplicado = true; 
                }
            }elseif(strcasecmp($comparacion,"telefono")== 0){
                if($dato == $colObjPasajeros[$i]->getTelefono()){
                    $duplicado = true; 
                }   
            }else{
                if($dato == $colObjPasajeros[$i]->getNroTicket()){
                    $duplicado = true;
                }
            }
            
            $i++;
        }    
        return $duplicado;
    }
    
    public function modificarDatosPasajero($DNIpasajero, $respuesta, $datoNuevo){
        $pasajeros = $this->getcolObjPasajeros();
        $i = 0;
        $encontrado = false;
        while($i < count($pasajeros) && !$encontrado){
            if($DNIpasajero == $pasajeros[$i]->getNroDocumento()){
                $pasajeros[$i]->modificarDatos($respuesta, $datoNuevo);
                $encontrado = true;
            }
            $i++;
        }
    return $encontrado;
    }

    /* permite modificar los datos de la clase viaje */
    public function modificarDatosViaje($datoNuevo,$respuesta){
        switch($respuesta){

            case 1: #modificar codigo
                $this->setCodigoViaje($datoNuevo);
                break;
            case 2: #modificar destino
                $this->setDestino($datoNuevo);
                break;
            case 3: #modificar cantidad maxima de pasajeros 
                #solo se podrá hacer si la cantidad ingresada es mayor a la cantidad actual de pasajeros
                if($datoNuevo > count($this->getcolObjPasajeros())){
                    $this->setCantMaxPasajeros($datoNuevo);
                }
                break;
            case 4:
                $pasajero = $this->getcolObjPasajeros()[$datoNuevo];
                $pasajero->modificarDatosPasajero();
            default: 
                break;
            }
        return $respuesta;
    }


    public function __toString()
    {
        return "\n--------------------------------------------------\n".
        "codigo de viaje: ".$this->getCodigoViaje()."\n".
        "destino de viaje: ".$this->getDestino()."\n".
        "cantidad máxima de pasajeros: ".$this->getCantMaxPasajeros()."\n".
        "pasajeros del viaje: ".$this->pasajerosArrayToString()."\n".
        "responsable del viaje: \n".$this->getObjResponsable()."\n".
        "costo del viaje: ".$this->getCostoViaje()."\n".
        "costos totales abonados por los pasajeros: ".$this->calcularCostosAbonados();
    }

    
}