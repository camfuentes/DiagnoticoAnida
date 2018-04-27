<?php 
include('variables.php');

/*
$HOST ="{
    \"jsonrpc\": \"2.0\",
    \"method\": \"host.get\",
    \"params\": {
        \"output\": \"extend\",
        \"filter\": {
            \"host\": [
                \"$NOMBRE\"
            ]
        }
    },
    \"auth\": \"$AUTH_TOKEN\",
    \"id\": 1
}"; */

//$respuesta0 = sendJSON($HOST,$URL);
//$HOSTID=$respuesta0[result][0][hostid];

$ITEMS= "{
    \"jsonrpc\": \"2.0\",
    \"method\": \"item.get\",
    \"params\": {
        \"output\": \"extend\",
        \"host\": \"$NOMBRE\",
        \"sortfield\": \"name\"
    },
    \"auth\": \"$AUTH_TOKEN\",
    \"id\": 1
}";

$TRIGGERS= "{
    \"jsonrpc\": \"2.0\",
    \"method\": \"trigger.get\",
    \"params\": {
        \"output\": \"extend\",
	\"host\": \"$NOMBRE\",
	\"selectFunctions\": \"extend\", 
        \"filter\": {
            \"value\": 1
        },
        \"sortfield\": \"lastchange\",
        \"sortorder\": \"DESC\"
    },
    \"auth\": \"$AUTH_TOKEN\",
    \"id\": 1
}";

/*
$HISTORIAL = "{
    \"jsonrpc\": \"2.0\",
    \"method\": \"event.get\",
    \"params\": {
        \"output\": \"extend\",
        \"hostid\": \"$HOSTID\",
	\"source\": \"0\",
	\"value\" : \"1\",
	\"sortfield\": \"clock\",
	\"sortorder\": \"DESC\",
	\"limit\" : \"20\"
    },
    \"auth\": \"$AUTH_TOKEN\",
    \"id\": 1
}";

$TRIGGER= "{
    \"jsonrpc\": \"2.0\",
    \"method\": \"trigger.get\",
    \"params\": {
        \"output\": \"extend\",
	\"triggerids\": \"38548\",
	\"selectFunctions\": \"extend\"
    },
    \"auth\": \"$AUTH_TOKEN\",
    \"id\": 1
}";*/

//$aux = sendJSON($TRIGGER,$URL);
 

$respuesta= sendJSON($ITEMS,$URL);
$respuesta2= sendJSON($TRIGGERS, $URL);
//$respuesta3= sendJSON($HISTORIAL, $URL);

$USOMEMORIA =  getItemValue($respuesta,$ITEM_USOMEMORIA);
$USOCPU =  getItemValue($respuesta,$ITEM_USOCPU);
//$LOCALTIME = getItemValue($respuesta,$ITEM_LOCALTIME);
$UPTIME = getItemValue($respuesta,$ITEM_UPTIME);
$PROCESOS = getItemValue($respuesta,$ITEM_PROCESOS);
$UPTIME = formatoTiempo($UPTIME);

if($SO=='Windows'){
$USOMEMORIA_T = getseverity($respuesta2,getidonitem($respuesta,$ITEM_MEMORIAT));
}
if($SO=='Linux'){
$USOMEMORIA_T = getseverity($respuesta2,getidonitem($respuesta,$ITEM_USOMEMORIA));
}
$USOCPU_T = getseverity($respuesta2,getidonitem($respuesta,$ITEM_USOCPU));
$UPTIME_T = getseverity($respuesta2,getidonitem($respuesta,$ITEM_UPTIME));
$PROCESOS_T = getseverity($respuesta2,getidonitem($respuesta,$ITEM_PROCESOS)); 

if($SO=='Linux'){shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/linux.sh \"$IP\"");}
//$LISTA = listarHistorial($respuesta3);



// Funciones

function listarHistorial($array){
	foreach($array[result] as $r){
		$lista .= date('d/m/Y H:i:s',$r[clock]). " "; 
		$lista .= "Objeto :".$r[objectid]."</br>";
	}
	return $lista;
}

function getseverity($array,$id){
        foreach($array[result] as $r){
                foreach($r[functions] as $r2){
                        if($r2[itemid]==$id){return $r[priority];}
                }
        }
	return "0"; 
};

function getidonitem($array,$nombre){
	foreach($array[result] as $r){
        	if($r[name]==$nombre){
                        return $r[itemid];
                }
        }
}

function getidontrigger($array,$id){
        foreach($array[result] as $r){
                foreach($r[functions] as $r2){
                	if($r2[itemid]==$id){return true;}
                }
        }
	return false;
};

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function getItemValue($array,$nombre){
	foreach($array[result] as $r){
        	if($r[name]==$nombre){
                	return $r[lastvalue];
        	}
	}
}

function sendJSON($DATA,$URL) {
	$curl = curl_init($URL);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $DATA);

	$json_response = curl_exec($curl);
	curl_close($curl);

	$response = json_decode($json_response, true);
	return $response;
	}

function formatoTiempo($seconds) {
   	$dtF = new \DateTime('@0');
       	$dtT = new \DateTime("@$seconds");
     	return $dtF->diff($dtT)->format(' %a dias, %h horas y %i minutos');
}

?>
