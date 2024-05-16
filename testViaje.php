<?php
/* 
Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú 
que permita cargar la información del viaje, modificar y ver sus datos.
*/
include 'Persona.php';
include 'Pasajero.php';
include 'PasajeroEspecial.php';
include 'PasajeroVIP.php';
include 'Viaje.php';
include 'ResponsableV.php';

/* ----------------------- VIAJES YA CREADOS ------------------------------- */
$pasajero1 = new Pasajero("jorge", "rodriguez", 45102030, 299123456, 1, 333);
$pasajero2 = new Pasajero("luis", "martinez", 45112233, 298654321, 2, 444);
$pasajero3 = new Pasajero("jose", "ramirez", 42302010, 299101112, 3, 555);
$pasajero4 = new Pasajero("miguel", "marquez", 43908070, 299132333, 4, 666);
$pasajero5 = new Pasajero("ana", "perez", 44192939, 298999897, 5, 777);
$pasajerosV1 = [$pasajero1, $pasajero2, $pasajero3, $pasajero4, $pasajero5];

$responsable1 = new ResponsableV("gerardo", "manuel", 9990, 540540);
$viaje1 = new Viaje("ID3453", "Londres", 8, 400, $pasajerosV1, $responsable1);

$pasajero6 = new Pasajero("daniel", "suarez", 45122232, 299123456, 1, 432);
$pasajero7 = new Pasajero("pedro", "gutierrez", 45142434, 298654321, 2, 321);
$pasajero8 = new Pasajero("leo", "sanchez", 42392919, 299989796, 3, 543);
$pasajero9 = new Pasajero("laura", "hernandez", 43988878, 299132333, 4, 654);
$pasajero10 = new Pasajero("mariana", "vazquez", 44122232, 298999897, 5, 765);
$pasajerosV2 = [$pasajero6, $pasajero7, $pasajero8, $pasajero9, $pasajero10];

$responsable2 = new ResponsableV("blas" ,"campos", 1200, 780010);
$viaje2 = new Viaje("LS8794", "Madrid", 7, 550, $pasajerosV2, $responsable2);

$viajes = [$viaje1, $viaje2];
/* ------------------------------------------------------------------------ */


function cargarNuevoViaje(){
    $colObjPasajeros = [];
    echo "ingrese el código de su viaje: \n";
    $codigoViaje = trim(fgets(STDIN));
    echo "ingrese el destino: \n";
    $destino = trim(fgets(STDIN));
    echo "ingrese la  cantidad máxima de pasajeros: \n";
    $cantMax = trim(fgets(STDIN));
    echo "ingrese el costo de viaje: \n";
    $costoViaje = trim(fgets(STDIN));
    echo "desea ingresar los datos del responsable del viaje ? si/no: ";
    $rta = trim(fgets(STDIN));
    /* CARGO DATOS RESPONSABLE */
    if($rta == "si"){
        echo "ingrese los datos del responsable del viaje. \n Comenzando por el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "luego el apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "numero de empleado: ";
        $nroEmpleado = trim(fgets(STDIN));
        echo "y numero de licencia: ";
        $nroLicencia = trim(fgets(STDIN));    
        $respViaje = new ResponsableV($nombre, $apellido, $nroEmpleado, $nroLicencia);
    }else{
        $respViaje = null;
    }
    /* instancio el viaje para poder acceder a métodos de verificar datos duplicados */
    $nuevoViaje = new Viaje($codigoViaje, $destino, $cantMax, $costoViaje, $colObjPasajeros, $respViaje);
    $i = 0;
    echo "desea ingresar los datos de los pasajeros ? si/no: ";
    $rta = trim(fgets(STDIN));
    while($i < $cantMax && strcasecmp($rta,"si")== 0){
        echo "ingrese el nombre del pasajero nro ".($i+1).": ";
        $nombre = trim(fgets(STDIN));
        echo "ahora ingrese el apellido del pasajero: ";
        $apellido = trim(fgets(STDIN));

        do{#bucle para el ingreso de un DNI duplicado
            echo "ingrese su numero de DNI: ";
            $nroDNI = trim(fgets(STDIN));
            
            if((count($colObjPasajeros)>0) && ($nuevoViaje->datoDuplicado($nroDNI, "DNI"))){
                echo "error. El documento ya se encuentra registrado.\n ";
            }
        }while($nuevoViaje->datoDuplicado($nroDNI, "DNI"));

        do{#bucle para el ingreso de un telefono duplicado
            echo "ingrese su numero telefonico: ";
            $nroTelefono = trim(fgets(STDIN));    
            if((count($colObjPasajeros)>0) && ($nuevoViaje->datoDuplicado($nroTelefono, "telefono"))){
                echo "error. El telefono ya se encuentra registrado.\n ";
            }
        }while($nuevoViaje->datoDuplicado($nroTelefono, "telefono"));
        
        do{#bucle para el ingreso de un numero de ticket duplicado
            echo "ingrese el numero de ticket: ";
            $numTicket = trim(fgets(STDIN));
            if((count($colObjPasajeros)>0) && ($nuevoViaje->datoDuplicado($numTicket, "numero de ticket"))){
                echo "error. El numero de ticket ya se encuentra registrado.\n";
            }
        }while($nuevoViaje->datoDuplicado($numTicket, "numero de ticket"));
        echo "----------------------\ningrese '1' si el pasajero tiene necesidades especiales.\n 
        '2' si el pasajero es un pasajero VIP.\n 
        Y '3' si es un pasajero común:\n----------------------\n";
        $rta = trim(fgets(STDIN));
        if($rta == 1){
            $arrNecesidades = [];
            echo "el pasajero necesita de silla de ruedas ? si/no: ";
            $resp = trim(fgets(STDIN));
            if(strcasecmp($resp,"si")== 0){
                $arrNecesidades[] = "silla de ruedas";
            }
            echo "el pasajero necesita de asistencia ? si/no: ";
            $resp = trim(fgets(STDIN));
            if(strcasecmp($resp,"si")== 0){
                $arrNecesidades[] = "asistencia";
            }
            echo "el pasajero necesita de comida especial ? si/no: ";
            $resp = trim(fgets(STDIN));
            if(strcasecmp($resp,"si")== 0){
                $arrNecesidades[] = "comida especial";
            }
            $colObjPasajeros[] = new PasajeroEspecial($nombre, $apellido, $nroDNI, $nroTelefono, ($i+1), $numTicket, $arrNecesidades);
            
        }elseif($rta == 2){
            echo "ingrese el numero de viajero frecuente: ";
            $nroViajeFrecuente = trim(fgets(STDIN));
            echo "ingrese la cantidad de millas: ";
            $cantMillas = trim(fgets(STDIN));
            $colObjPasajeros[] = new PasajeroVIP($nombre, $apellido, $nroDNI, $nroTelefono, ($i+1), $numTicket, $nroViajeFrecuente, $cantMillas);
            
        }else{#comun ($rta == 3)
            $colObjPasajeros[] = new Pasajero($nombre, $apellido, $nroDNI, $nroTelefono, ($i+1), $numTicket);

        } 
        $nuevoViaje->setcolObjPasajeros($colObjPasajeros);
        $i++;
        if($i < $cantMax){
            echo "desea ingresar otro pasajero ? si/no: ";
            $rta = trim(fgets(STDIN));
        }elseif($i == $cantMax){
            echo "viaje lleno."; 
        }
        
    }
    
    return $nuevoViaje;
    
}



function ingresarPasajeros($viajeX){
    $colPasajeros = $viajeX->getcolObjPasajeros(); 
    $cantPasajeros = count($viajeX->getcolObjPasajeros()); 
    $cantMaxPasajeros = $viajeX->getCantMaxPasajeros();
    if($cantPasajeros < $cantMaxPasajeros){
        for($i = $cantPasajeros; $i<$cantMaxPasajeros; $i++){
            echo "datos del pasajero numero ".($i+1).":"."\n".
            "ingrese el nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "ingrese el apellido: ";
            $apellido = trim(fgets(STDIN));
            do{
                echo "ingrese el numero de DNI: ";
                $nroDNI = trim(fgets(STDIN));
                
                if(($viajeX->datoDuplicado($nroDNI, "dni"))){
                    echo "error. El documento ya se encuentra registrado.\n ";
                }
            }while($viajeX->datoDuplicado($nroDNI, "dni"));

            do{
                echo "ingrese el numero telefonico: ";
                $nroTelefono = trim(fgets(STDIN));    
                if($viajeX->datoDuplicado($nroTelefono, "tel")){
                    echo "error. El telefono ya se encuentra registrado.\n ";
                }
            }while($viajeX->datoDuplicado($nroTelefono, "tel"));

            do{
                echo "ingrese el numero de ticket: ";
                $numTicket = trim(fgets(STDIN));
                if((count($colPasajeros)>0) && ($viajeX->datoDuplicado($numTicket, "numero de ticket"))){
                    echo "error. El numero de ticket ya se encuentra registrado.\n";
                }
            }while($viajeX->datoDuplicado($numTicket, "numero de ticket"));
            echo "----------------------\ningrese '1' si el pasajero tiene necesidades especiales.\n 
            '2' si el pasajero es un pasajero VIP.\n 
            Y '3' si es un pasajero común:\n----------------------\n";
            $rta = trim(fgets(STDIN));
            if($rta == 1){
                $arrNecesidades = [];
                echo "el pasajero necesita de silla de ruedas ? si/no: ";
                $resp = trim(fgets(STDIN));
                if(strcasecmp($resp,"si")== 0){
                    $arrNecesidades[] = "silla de ruedas";
                }
                echo "el pasajero necesita de asistencia ? si/no: ";
                $resp = trim(fgets(STDIN));
                if(strcasecmp($resp,"si")== 0){
                    $arrNecesidades[] = "asistencia";
                }
                echo "el pasajero necesita de comida especial ? si/no: ";
                $resp = trim(fgets(STDIN));
                if(strcasecmp($resp,"si")== 0){
                    $arrNecesidades[] = "comida especial";
                }
                $colPasajeros[] = new PasajeroEspecial($nombre, $apellido, $nroDNI, $nroTelefono, ($i+1), $numTicket, $arrNecesidades);
            }elseif($rta == 2){
                echo "ingrese el numero de viajero frecuente: ";
                $nroViajeFrecuente = trim(fgets(STDIN));
                echo "ingrese la cantidad de millas: ";
                $cantMillas = trim(fgets(STDIN));
                $colPasajeros[] = new PasajeroVIP($nombre, $apellido, $nroDNI, $nroTelefono, ($i+1), $numTicket, $nroViajeFrecuente, $cantMillas);
            }else{#comun ($rta ==3)
                $nuevoPasajero = new Pasajero($nombre, $apellido, $nroDNI, $nroTelefono, ($i+1), $numTicket);
                $colPasajeros[] = $nuevoPasajero;
            }
            
            $viajeX->setcolObjPasajeros($colPasajeros);
        }
    }
    echo "\nEl viaje ya llegó a su capacidad máxima de pasajeros.\n";
    
}


function modificarDatos($viajeX){
    /* MODIFICAR DATOS VIAJE */
    echo "desea cambiar el codigo de viaje ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if(strcasecmp($respuesta,"si")== 0){
        echo "ingrese el nuevo codigo: ";
        $newCodigo = trim(fgets(STDIN));
        $viajeX->setCodigoViaje($newCodigo);
    }
    echo "desea modificar el destino del viaje ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if(strcasecmp($respuesta,"si")== 0){
        echo "ingrese el nuevo destino: ";
        $newDestino = trim(fgets(STDIN));
        $viajeX->setDestino($newDestino);
    }
    echo "desea modificar la cantidad maxima de pasajeros permitida ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if(strcasecmp($respuesta,"si")== 0){
        echo "ingrese la nueva cantidad maxima";
        $newCapMaxima = trim(fgets(STDIN));
        $viajeX->setCantMaxPasajeros($newCapMaxima);
    }
    /* MODIFICAR DATOS PASAJERO */
    echo "desea modificar algun dato de los pasajeros a bordo ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if(strcasecmp($respuesta,"si")== 0){
        echo "estos son los datos de los pasajeros a bordo: \n";
        $pasajeros = $viajeX->getcolObjPasajeros();
        for($i = 0; $i < count($pasajeros); $i++){
            echo "\n--------------------------------------------------\n".
            "pasajero numero ".($i+1).":\n".$pasajeros[$i]
            ."\n--------------------------------------------------\n";
        }

        echo "ingrese el numero del pasajero al que quiere modificar sus datos: ";
        $num = trim(fgets(STDIN));
        $num--; #restamos 1 al numero que vemos por consola
        echo "ingrese el nuevo nombre. (Enter para no modificar): ";
        $newNombre = trim(fgets(STDIN));
        if($newNombre != ""){
            $viajeX->getcolObjPasajeros()[$num]->setNombre($newNombre);
        }

        echo "ingrese el nuevo apellido. (Enter para no modificar): ";
        $newApellido = trim(fgets(STDIN));
        if($newApellido != ""){
            $viajeX->getcolObjPasajeros()[$num]->setApellido($newApellido);
        }

        echo "ingrese el nuevo numero de documento. (Enter para no modificar): ";
        $newDNI = trim(fgets(STDIN));
        if($newDNI != ""){
            $viajeX->getcolObjPasajeros()[$num]->setNroDocumento($newDNI);
        }

        echo "ingrese el nuevo numero de telefono. (Enter para no modificar): ";
        $newTel = trim(fgets(STDIN));
        if($newTel != ""){
            $viajeX->getcolObjPasajeros()[$num]->setTelefono($newTel);
        }
    }

    /* MODIFICAR DATOS RESPONSABLE */
    echo "desea modificar algun dato del responsable del viaje ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if($respuesta == "si"){
        echo "ingrese el nuevo numero de empleado (Enter para no modificar): ";
        $newNumEmpleado = trim(fgets(STDIN));
        if($newNumEmpleado != ""){
            $viajeX->getObjEmpleado()->setNroEmpleado($newNumEmpleado);
        }
        echo "ingrese el nuevo numero de licencia (Enter para no modificar): ";
        $newNumLicencia = trim(fgets(STDIN));
        if($newNumLicencia != ""){
            $viajeX->getObjEmpleado()->setNroLicencia($newNumLicencia);
        }
        echo "ingrese el nuevo nombre y apellido (Enter para no modificar): ";
        $newNomYapellido = trim(fgets(STDIN));
        if($newNomYapellido != ""){
            $viajeX->setNombreYapellido($newNomYapellido);
        }
    }

}

function EmpresaDeViajes($viajes){

    do{
        echo "\n----------------------------------------------------\n".
        "|Qué desea hacer ?"."\n".
        "|1: cargar nuevo Viaje"."\n".
        "|2: ingresar pasajeros a un viaje ya predeterminado"."\n".
        "|3: Modificar los datos de un determinado viaje"."\n".
        "|4: visualizar los datos de un viaje"."\n".
        "|5: salir.".
        "\n----------------------------------------------------\n".
        "Respuesta: "; 
        $respuesta = trim(fgets(STDIN));

        switch($respuesta){
            #cargar nuevo viaje
            case 1:
                $viajeCargado = cargarNuevoViaje();
                echo $viajeCargado;
                $viajes[] = $viajeCargado;
                break;
            case 2:
                #ingresar pasajeros a un viaje ya predeterminado
                $espacioDisponible = false;
                echo "los viajes ya predeterminados con espacio disponible para más pasajeros son: \n";
                foreach($viajes as $index =>$viaje){
                    if($viaje->getCantMaxPasajeros() > count($viaje->getcolObjPasajeros())){
                        $espacioDisponible = true;
                        $lugaresDisponibles = $viaje->getCantMaxPasajeros() - count($viaje->getcolObjPasajeros());
                        echo "el viaje numero ".($index+1).", con ".count($viaje->getcolObjPasajeros())." pasajeros y ".$lugaresDisponibles." lugares disponibles.\n";
                
                    }
                }
                
                if($espacioDisponible == true){
                    echo "ingrese el numero de viaje al que desea ingresar pasajeros: ";
                    $nroViaje = trim(fgets(STDIN));
                    $nroViaje--; #le resto 1 al numero que ve el usuario por consola
                    ingresarPasajeros($viajes[$nroViaje]);
                }else{
                    echo "No se encontraron viajes con espacio disponible. ";
                }   
                break;
            case 3:
                #Modificar los datos de un determinado viaje
                echo "segun su numero, cual de los siguientes viajes desea modificar sus datos ? \n";
                foreach($viajes as $index => $viaje){
                    echo "viaje numero ".($index+1)."\n";
                }
                $viajeElegido = trim(fgets(STDIN));
                $viajeElegido--;
                $viajeX = $viajes[$viajeElegido];
                $pasajeros = $viajeX->getcolObjPasajeros();
                
                do{
                    echo "ingrese '1' si desea modificar el codigo de viaje\n '2' si desea modificar el destino \n'3' si desea modificar la cantida máxima de pasajeros (debe ser mayor a los ".count($viajeX->getcolObjPasajeros())." pasajeros).\n '4' si desea modificar algún pasajero: "; 
                    $respuesta = trim(fgets(STDIN));
                    if($respuesta == 1 || $respuesta == 2 || $respuesta == 3){
                        echo "ingrese el nuevo datOo: \n";
                        $nuevoDato = trim(fgets(STDIN));
                        $viajeX->modificarDatosViaje($nuevoDato, $respuesta);
                    }else{
                        echo "estos son los pasajeros a bordo:\n ";
                        for($i = 0; $i < count($pasajeros); $i++){
                            echo "\n--------------------------------------------------\n".
                            "pasajero numero ".($i+1).":\n".$pasajeros[$i]
                            ."\n--------------------------------------------------\n";
                        }
                        echo "ingrese el numero del pasajero al que quiere modificar sus datos: ";
                        $num = trim(fgets(STDIN));
                        $num--; #restamos 1 al numero que vemos por consola
                        $pasajero = $pasajeros[$num];
                        if($pasajero instanceof Pasajero){
                            echo "ingrese '1' si desea modificar el num de documento. \n '2' si desea modificar el numero de telefono. \n '3' si desea modificar el numero de asiento. \n '4' si desea modificar el numero de ticket. ";
                            $respuesta = trim(fgets(STDIN));
                            echo "ingrese el nuevo dato: \n";
                            $nuevoDato = trim(fgets(STDIN));
                        }elseif($pasajero instanceof PasajeroEspecial){
                            echo "ingrese '1' si desea modificar el num de documento. \n '2' si desea modificar el numero de telefono. \n '3' si desea modificar el numero de asiento. \n '4' si desea modificar el numero de ticket. \n '5' si desea modificar la coleccion de necesidades especiales. ";
                            $respuesta = trim(fgets(STDIN));
                            if($respuesta == 5){
                                $arrNecesidades = [];
                                echo "el paciente necesita de silla de ruedas ? si/no: \n";
                                $resp = trim(fgets(STDIN));
                                if(strcasecmp($resp,"si")== 0){
                                    $arrNecesidades[] = "silla de ruedas";
                                }
                                echo "el pasajero necesita de asistencia ? si/no: ";
                                $resp = trim(fgets(STDIN));
                                if(strcasecmp($resp,"si")== 0){
                                    $arrNecesidades[] = "asistencia";
                                }
                                echo "el pasajero necesita de comida especial ? si/no: ";
                                $resp = trim(fgets(STDIN));
                                if(strcasecmp($resp,"si")== 0){
                                    $arrNecesidades[] = "comida especial";
                                }
                            $nuevoDato = $arrNecesidades;
                            }
                        }else{
                            echo "ingrese '1' si desea modificar el num de documento. \n '2' si desea modificar el numero de telefono. \n '3' si desea modificar el numero de asiento. \n '4' si desea modificar el numero de ticket. \n '5' si desea modificar el numero de viajero frecuente y '6' si desea modificar la cantidad de millas. ";
                            $respuesta = trim(fgets(STDIN));
                            echo "ingrese el nuevo dato: \n";
                            $nuevoDato = trim(fgets(STDIN));
                        }
                        $pasajero->modificarDatos($respuesta, $nuevoDato);
                    }
                    echo "Desea realizar alguna otra modificación ? si/no ";
                    $rta = trim(fgets(STDIN));
                    
                }while(strcasecmp($rta,"si")== 0);
                
                break;
            case 4: 
                #visualizar los datos de un viaje.
                echo "ingrese el numero del viaje del que desea ver sus datos: \n";
                foreach($viajes as $index => $viaje){
                    echo "viaje numero ".($index+1)."\n";
                }
                $viajeNum = trim(fgets(STDIN));
                $viajeNum--;
                
                echo $viajes[$viajeNum];
                break;
            default:
                if($respuesta!=5){
                    echo "opcion no valida.";
                }
                
                break;
        }

    }while($respuesta !=5);
}

echo EmpresaDeViajes($viajes);