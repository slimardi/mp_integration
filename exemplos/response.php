<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "lib/mercadopago.php";

$mp = new MP("1779081077221342", "i6U8UZMJSNvhNxm1zFcdhR0b4Fgtit2E");

//print_r($_REQUEST);

$hoje = date("Y_m_d");
$arquivo = fopen("log_tarefa.$hoje.txt", "ab");
$hora = date("H:i:s T");
fwrite($arquivo,  $_REQUEST['card_token_id']." [$hora] Tarefa executada.\r\n");
fclose($arquivo);

$preference = array(
    "amount"=> 100,
    "reason" => "Teste Victor",
     "currency_id" => "BRL",
     "installments" => 1,
    "payment_method_id"=> "visa",
     "card_token_id" => $_REQUEST['card_token_id'],
     "payer_email" => "test_user_70781207@testuser.com",
     "external_reference" => "my_order_1234"
    );

$preferenceResult = $mp->invisible($preference);


//echo "<pre>";
print_r(json_encode($preferenceResult["response"]));
//echo "</pre>";

?>

