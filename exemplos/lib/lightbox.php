<?php
require_once "lib/mercadopago.php";
$mp = new MP("5706579694766937", "KJsSfaqhcGjphxB3ZCDwPhaC4g7LmLTq");

$preference = array(
    'items'=> 
		array(array(
        'id'=> '1234',
        'title'=> 'Integrando PHP',
        'description'=> 'Teste de PHP',
        'quantity'=> 1,
	'category_id'=> 'coupons',
        'unit_price'=> 500,
        'currency_id'=> 'BRL',
        'picture_url'=> 'https=>//www.mercadopago.com/org-img/MP3/home/logomp3.gif'
  		)
		),
    
	'external_reference'=> 'Reference_1234',
	
	'payer'=> array(
        'name'=> 'Victor',
        'surname'=> 'Vasconcellos',
        'email'=> 'teste@ig.com.br',
	'date_created'=>'2012-05-28T10:59:00.000-04:00' 
		),
	'shipments' => array( 
            'RECEIVER_ADDRESS' => array(
	    'ZIP_CODE'=> '06541005',
	    'STREET_NUMBER'=> 536
            )),
	'back_urls'=> 
		array(
        'success'=> 'https=>//www.success.com',
        'failure'=> 'http=>//www.failure.com',
        'pending'=> 'http=>//www.pending.com'
		),
	'payment_methods'=> 
		array(
          'excluded_payment_methods'=>array(array( 
            
			'id'=> 'bolbradesco'
           
            )
        ),'excluded_payment_types'=>array(array( 
            
            'id'=> 'ticket'
            )
        ),'installments'=> 12
		)
);

$preferenceResult = $mp->create_preference($preference);

echo "<BR>".$preferenceResult["response"]["id"]."<BR>";

echo "<br> get pref<br>";

print_r ($mp->get_preference($preferenceResult["response"]["id"]));

echo "<br> result pref<br>";


print_r($preferenceResult);

?>

<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>
		<a href=<?php echo $preferenceResult["response"]["sandbox_init_point"]; ?> name="MP-Checkout" class="green-L-Rn" mp-mode="modal">Pagar</a>
		

		<script type="text/javascript">
		
		(function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
		s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";
		var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}
		window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
		</script>
    </body>
</html>
