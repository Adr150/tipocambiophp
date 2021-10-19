<H1>El TC del dia 19/10/2021 es <?php echo consultar_dia(19,10,2021); ?></H1>


<?php

function consultar_dia($dia,$mes, $anio){
// Ejemplo de consumo del servicio del BCN para solicitar el tc diario 

$wsdl = "https://servicios.bcn.gob.ni/Tc_Servicio/ServicioTC.asmx?WSDL"; //URL de nuestro servicio soap

//Parametros
$params = Array(
    "Dia" => $dia,
    "Mes" => $mes,
    "Ano" => $anio
    );



// Esto desactiva los ssl
$opts = array(
    'ssl'   => array(
            'verify_peer' => false
        ),
    'https' => array(
            'curl_verify_ssl_peer' => false,
            'curl_verify_ssl_host' => false
     )
);
$streamContext = stream_context_create($opts);

// agregamos la configuracion
$options = Array(
    "stream_context" => $streamContext,
	"uri"=> $wsdl,
	"style"=> SOAP_RPC,
	"use"=> SOAP_ENCODED,
	"soap_version"=> SOAP_1_2,
	"cache_wsdl"=> WSDL_CACHE_BOTH,
	"connection_timeout" => 30,
	"trace" => false,
	"encoding" => "UTF-8",
	"exceptions" => false,
	);

// Crear cliente con toda la info de arriba
$soap = new SoapClient($wsdl, $options);
$result = $soap->RecuperaTC_Dia($params); //Aquí cambiamos dependiendo de la acción del servicio que necesitemos ejecutar RECORDAR QUE EL MES DEVUELVE UN ARRAY
// var_dump($result);

return $result->RecuperaTC_DiaResult;
}

?>