<?php

function sendNotification( $apiKey, $registrationIdsArray, $messageData )
{   
    $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $apiKey);
    $data = array(
        'data' => $messageData,
        'registration_ids' => $registrationIdsArray
    );
 
    $ch = curl_init();
 
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers ); 
    curl_setopt( $ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send" );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data) );
 
    $response = curl_exec($ch);
    curl_close($ch);
 
    return $response;
}


// MENSAGEM
$message      = 'Mensagem';
$title = "Testando";
$exemploParam = "Exemplo como passar parametro.";


//CODIGO GERADO PELO GOOGLE PARA O DEVICE - O IDEAL É GUARDAR ESSE CÓDIGO NO BANCO E GERAR UM LOOP AQUI PARA O ENVIO.
// PARA PROJETOS GRANDES ACONSELHO UTILIZAR UM CRON PARA AGENDAMENTO DOS ENVIOS 
    
$registrationId = "REGISTRO DO DEVICE GERADO PELO APLICATIVO";

//API KEY GERADA PELO GOOGLE
$apiKey = "API KEY AQUI";
 
$response = sendNotification(
                $apiKey, 
                array($registrationId), 
                array('message' => $message, 
					  'exemploParam' => $exemploParam,
					  'title' => $title,
				));

?>