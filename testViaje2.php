<?php
/* 
Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú 
que permita cargar la información del viaje, modificar y ver sus datos.
*/
include 'Persona.php';
include 'Pasajero.php';
include 'Viaje.php';
include 'ResponsableV.php';

                /* VIAJES YA CREADOS */
$pasajero1 = new Pasajero("jorge", "rodriguez", 45102030, 299123456);
$pasajero2 = new Pasajero("luis", "martinez", 45112233, 298654321);
$pasajero3 = new Pasajero("jose", "ramirez", 42302010, 299101112);
$pasajero4 = new Pasajero("miguel", "marquez", 43908070, 299132333);
$pasajero5 = new Pasajero("ana", "perez", 44192939, 298999897);
$pasajerosV1 = [$pasajero1, $pasajero2, $pasajero3, $pasajero4, $pasajero5];

$responsable1 = new ResponsableV("gerardo", "manuel", 9990, 540540);
$viaje1 = new Viaje("ID3453", "Londres", 8, $pasajerosV1, $responsable1);

$pasajero6 = new Pasajero("daniel", "suarez", 45122232, 299123456);
$pasajero7 = new Pasajero("pedro", "gutierrez", 45142434, 298654321);
$pasajero8 = new Pasajero("leo", "sanchez", 42392919, 299989796);
$pasajero9 = new Pasajero("laura", "hernandez", 43988878, 299132333);
$pasajero10 = new Pasajero("mariana", "vazquez", 44122232, 298999897);
$pasajerosV2 = [$pasajero6, $pasajero7, $pasajero8, $pasajero9, $pasajero10];

$responsable2 = new ResponsableV("blas" ,"campos", 1200, 780010);
$viaje2 = new Viaje("LS8794", "Madrid", 7, $pasajerosV2, $responsable2);



$viajes = [$viaje1, $viaje2];



function DNIduplicado($elem,$colObjPasajeros){
    $duplicado = false;
    $i = 0;
    while(($i < count($colObjPasajeros)) && $duplicado == false){
        if($elem == $colObjPasajeros[$i]->getnroDocumento()){
            $duplicado = true; 
        }
        $i++;
    }    
    return $duplicado;
}

function TelDuplicado($elem, $colObjPasajeros){
    $duplicado = false;
    $i = 0;
    while(($i < count($colObjPasajeros)) && $duplicado == false){
        if($elem == $colObjPasajeros[$i]->getTelefono()){
            $duplicado = true; 
        }
        $i++;
    }
    return $duplicado;
}

function cargarNuevoViaje(){
    $colObjPasajeros = [];
    echo "ingrese el código de su viaje: \n";
    $codigoViaje = trim(fgets(STDIN));
    echo "ingrese el destino: \n";
    $destino = trim(fgets(STDIN));
    echo "ingrese la  cantidad máxima de pasajeros: \n";
    $cantMax = trim(fgets(STDIN));
    echo "ingrese los datos del responsable del viaje. \n Comenzando por el nombre y apellido: ";
    $nombre = trim(fgets(STDIN));
    echo " apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "numero de empleado: ";
    $nroEmpleado = trim(fgets(STDIN));
    echo "numero de licencia: ";
    $nroLicencia = trim(fgets(STDIN));
    
    $respViaje = new ResponsableV($nombre, $apellido, $nroEmpleado,  $nroLicencia,);
    $i = 0;
    while($i < $cantMax){
        
        echo "ingrese el nombre del pasajero nro ".($i+1).": ";
        $nombre = trim(fgets(STDIN));
        echo "ahora ingrese el apellido del pasajero: ";
        $apellido = trim(fgets(STDIN));

        do{#bucle para el ingreso de un DNI duplicado
            echo "ingrese su numero de DNI: ";
            $nroDNI = trim(fgets(STDIN));
            
            if((count($colObjPasajeros)>0) && (DNIduplicado($nroDNI, $colObjPasajeros))){
                echo "error. El documento ya se encuentra registrado.\n ";
            }
        }while(DNIduplicado($nroDNI, $colObjPasajeros));

        do{#bucle para el ingreso de un telefono duplicado
            echo "ingrese su numero telefonico: ";
            $nroTelefono = trim(fgets(STDIN));    
            if((count($colObjPasajeros)>0) && (TelDuplicado($nroTelefono, $colObjPasajeros))){
                echo "error. El telefono ya se encuentra registrado.\n ";
            }
        }while(TelDuplicado($nroTelefono, $colObjPasajeros));
         
        $colObjPasajeros[] = new Pasajero($nombre, $apellido, $nroDNI, $nroTelefono);
        $i++;
    }
    $nuevoViaje = new Viaje($codigoViaje, $destino, $cantMax, $colObjPasajeros, $respViaje);
    return $nuevoViaje;
    
}



function ingresarPasajeros($viajeX){
    $colPasajeros = $viajeX->getcolObjPasajeros(); 
    $cantPasajeros = count($viajeX->getcolObjPasajeros()); 
    $cantMaxPasajeros = $viajeX->getCantMaxPasajeros();
    for($i = $cantPasajeros; $i<$cantMaxPasajeros; $i++){
        echo "datos del pasajero numero ".($i+1).":"."\n".
        "ingrese el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "ingrese el apellido: ";
        $apellido = trim(fgets(STDIN));
        do{
            echo "ingrese el numero de DNI: ";
            $nroDNI = trim(fgets(STDIN));
            
            if((DNIduplicado($nroDNI, $colPasajeros))){
                echo "error. El documento ya se encuentra registrado.\n ";
            }
        }while(DNIduplicado($nroDNI, $colPasajeros));
        
        do{
            echo "ingrese el numero telefonico: ";
            $nroTelefono = trim(fgets(STDIN));    
            if(TelDuplicado($nroTelefono, $colPasajeros)){
                echo "error. El telefono ya se encuentra registrado.\n ";
            }
        }while(TelDuplicado($nroTelefono, $colPasajeros));
        
        $nuevoPasajero = new Pasajero($nombre, $apellido, $nroDNI, $nroTelefono);
        $colPasajeros[] = $nuevoPasajero;
        $viajeX->setcolObjPasajeros($colPasajeros);
    }
    echo "\nEl viaje ya llegó a su capacidad máxima de pasajeros.\n";
    // return $colPasajeros;
}

function modificarDatos($viajeX){
    echo "desea cambiar el codigo de viaje ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if($respuesta == "si"){
        echo "ingrese el nuevo codigo: ";
        $newCodigo = trim(fgets(STDIN));
        $viajeX->setCodigoViaje($newCodigo);
    }
    echo "desea modificar el destino del viaje ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if($respuesta == "si"){
        echo "ingrese el nuevo destino: ";
        $newDestino = trim(fgets(STDIN));
        $viajeX->setDestino($newDestino);
    }
    echo "desea modificar la cantidad maxima de pasajeros permitida ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if($respuesta == "si"){
        echo "ingrese la nueva cantidad maxima";
        $newCapMaxima = trim(fgets(STDIN));
        $viajeX->setCantMaxPasajeros($newCapMaxima);
    }
    echo "desea modificar algun dato de los pasajeros a bordo ? si/no: ";
    $respuesta = trim(fgets(STDIN));
    if($respuesta == "si"){
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
                    $nroViaje--; #le resto 1 al numero que ve el usuario final
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
                echo modificarDatos($viajes[$viajeElegido]);
                break;
            case 4: 
                #visualizar los datos de un viaje.
                echo "ingrese el numero del viaje del que desea ver sus datos: \n";
                foreach($viajes as $index => $viaje){
                    echo "viaje numero ".($index+1)."\n";
                }
                $viajeNum = trim(fgets(STDIN));
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