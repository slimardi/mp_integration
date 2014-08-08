<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Pagar</title>
  </head>
  <body>
    
  <form action="response.php" method="post" id="form-pagar-mp">
    <p>Número do cartão: <input data-checkout="cardNumber" type="text" /></p>
    <p>Código de segurança: <input data-checkout="securityCode" type="text"  /></p>
    <p>Mês de vencimento: <input data-checkout="cardExpirationMonth" type="text"  /></p>
    <p>Ano de vencimento: <input data-checkout="cardExpirationYear" type="text" /></p>
    <p>Titular do cartão: <input data-checkout="cardholderName" type="text" /></p>
    <p>Número do documento: <input data-checkout="docNumber" type="text" /></p>
    <input data-checkout="paymentMethod" type="hidden" name="paymentMethod" />
    <input data-checkout="docType" type="hidden" value="CPF"/>
    <input data-checkout="siteId" type="hidden" value="MLB"/>
    <p><input type="submit" value="Concluir pagamento"></p>
</form>  
    
    
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://secure.mlstatic.com/org-img/checkout/custom/0.6/checkout.js"></script>
  <script type="text/javascript">
    Checkout.setPublishableKey("2944885d-d35c-470f-8dba-9e15d622b1c1");
    
     $("input[data-checkout='cardNumber']").bind("keyup",function(){
      var bin = $(this).val().replace(/ /g, '').replace(/-/g, '').replace(/\./g, '');
      if (bin.length == 6){
        Checkout.getPaymentMethod(bin,setPaymentMethodInfo);
      }
    });

    //Estabeleça a informação do meio de pagamento obtido
    function setPaymentMethodInfo(status, result){
      $.each(result, function(p, r){
          $.each(r.labels, function(pos, label){
              if (label == "recommended_method") {
                  $("input[data-checkout='paymentMethod']").attr("value", r.id)
                  return;
              }
          });
      });
     };
    
    $("#form-pagar-mp").submit(function( event ) {
    var $form = $(this);
    Checkout.createToken($form, mpResponseHandler);
    event.preventDefault();
    return false;
    });

var mpResponseHandler = function(status, response) {
  var $form = $('#form-pagar-mp');

  if (response.error) {
    console.log (response.error);
    alert("Ocorreu um erro");
  } else {
    var card_token_id = response.id;
    $form.append($('<input type="hidden" id="card_token_id" name="card_token_id"/>').val(card_token_id));
    $form.get(0).submit();
  }
};
    
    
  </script>
  </body>
</html>