<?php
	$us_name      = "Армен Акопян-client9";
	$us_name_rev  = strrev ($us_name . "-spasem-mir");
	$symb_arr = str_split($us_name_rev);
	
	$len = count($symb_arr);
	$sum = 0;
	for ($i=0; $i < $len; ++$i)
	{
		$sum += ord($symb_arr[$i]);
	}
	$passw = strval($sum);
	
    $data = array(
        'amount' => intval("100"),
		'orderNumber' => strval("4"),
		'password' => $passw,
		'userName' => $us_name,        
		'returnUrl' => 'https://github.com/YakubAtayew/zadaniye/index.php'
    );
	
    $curl = curl_init(); // Инициализируем запрос
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://attest.turkmen-tranzit.com/payment/rest/register.do" , // Полный адрес при регистрации платежа
        CURLOPT_RETURNTRANSFER => true, // Возвращать ответ
        CURLOPT_POST => true, // Метод POST
        CURLOPT_POSTFIELDS => http_build_query($data), // Данные в запросе
    ));

    $response = curl_exec($curl); // Выполняем запрос
     
    $response = json_decode($response, true); // Декодируем из JSON в массив
    curl_close($curl); // Закрываем соединение
	
	print($bool . "<br>");
	echo "Код ошибки: " . $response['errorCode'] . "<br>";
	echo "Описание ошибки: " . $response['errorMessage'] . "<br>";
	echo "Номер заказа: " . $response['orderId'] . "<br>";
	echo "URL возврата: " . $response['formUrl'] . "<br>";
	
?>