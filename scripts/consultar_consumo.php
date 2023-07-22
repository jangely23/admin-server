<?php

function consumoServer($server){
	$mes = date("n");

	$consumo = getConsumo($server,$mes);
	echo $consumo;
	if(isset($consumo["total_min_1_1"])){
        	if($consumo["total_min_1_1"]<20000){
               		$valor_pagar = 30000;
        	}else if($consumo["total_min_1_1"]<100000){
               		$valor_pagar = $consumo["total_min_1_1"] * 1.5;
        	}else if($consumo["total_min_1_1"]>100000){
              		$valor_pagar = $consumo["total_min_1_1"] * 1;
		}
		
		return $valor_pagar;
	
	}else{
		 throw new Exception('Error en consulta');
	}		

}



function getConsumo($host, $mes){
	 $curl = curl_init();
	  curl_setopt_array($curl, array(
	       CURLOPT_RETURNTRANSFER => 1,
	       CURLOPT_URL => "http://$host/voip/scripts/consumoLlamadaMes.script.php?mes=$mes",
	       CURLOPT_USERAGENT => "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36"
	  ));

	  $resp = curl_exec($curl);
	  curl_close($curl);

	  return json_decode($resp,TRUE);
}

?>
