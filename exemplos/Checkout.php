<?php
require_once "lib/mercadopago.php";
$mp = new MP("1779081077221342", "i6U8UZMJSNvhNxm1zFcdhR0b4Fgtit2E");

/*$data = new DateTime('2013-10-11 14:56:39');
//$data= $data->format('Y-m-d\TH:m:s.000P');
//echo $data->format("c").'<br>';
$data = date("YYYY-MM-DDThh:mm:ssZ000.-4",$data);
echo '<br>'. $data . '<br>';*/

echo "=======";


$preference = array(
    "external_reference"=> "Reference_1234",
    //"expires"=> true,
    //"expiration_date_to" =>"2014-06-13T16:31:55.663-04:00",
    "auto_return" => "all",
    "items"=> array(array(
        "id"=> "1234",
        "title"=> "titulo1234",
        "description"=> "Teste de PHP",
        "quantity"=> 1, 
        "unit_price"=> 200,
	"category_id"=>"tickets",
        "currency_id"=> "BRL",
        "picture_url"=> "https://www.mercadopago.com/org-img/MP3/home/logomp3.gif"
  	 )),
    
	"payer" => array(
                    "name" => "VICTOR",
                    "surname" => "VASCONCELLOS",
                    "email" => "test_user_70781207@testuser.com",
                    "phone" => array(
                        "area_code" => "5511",
                        "number" => "4141-4141"),
                    "address" => array(
                        "zip_code" => "05303-090",
                        "street_name" => "consolacao",
                        "street_number" => "123"),
		    "identification"=>array(
			"type"=>"CPF",
			"number"=>"19119119100"
		    ),
                    "date_created" => "2013-08-13T12:00:21-03:00"
                ),
	    
	"shipments" => array( 
            "receiver_address" =>
	    array("zip_code" => "49010620",
		  "street_number" => 124,
		  "street_name"=>"Avenida Mamede Paes Mendonça",
		  "floor"=>"4",
		   "apartment"=>"C"
	    
            )),
	
	'back_urls'=> 
		array(
        'success'=> 'http://localhost/exemplos',
        'failure'=> 'http://www.mercadolivre.com.br',
        'pending'=> 'http://www.mercadolibre.com.ar'
		),
	'payment_methods'=> 
		array(
          'excluded_payment_methods'=>array(array( 
            
			'id'=> ''
           
            )
        ),'excluded_payment_types'=>array(array( 
            
            'id'=> ''
            )
        ),'installments'=> 8
		)
);

$preferenceResult = $mp->create_preference($preference);

?>

<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>
	<?php
	echo "<pre>";
	print_r($preferenceResult);
	echo "</pre>";
	?>
		<br><br>
                
                <a href="<?php echo $preferenceResult["response"]["sandbox_init_point"]; ?>" name="MP-Checkout" class="lightblue-L-Rn-BrOn" mp-mode="modal" >LIGHTBOX</a>
                
                <br><br>
                
                <a href="<?php echo $preferenceResult["response"]["sandbox_init_point"]; ?>" name="MP-Checkout" class="lightblue-L-Rn-BrOn" mp-mode="redirect">REDIRECT</a>
                
               <br><br>
                
		<iframe src="<?php echo $preferenceResult["response"]["sandbox_init_point"]; ?>" id="Checkout" name="MP-Checkout" width="740" height="600" frameborder="1"></iframe>

		<script type="text/javascript">
	    	(function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
		s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";
		var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}
		window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
		</script>
    </body>
</html>

