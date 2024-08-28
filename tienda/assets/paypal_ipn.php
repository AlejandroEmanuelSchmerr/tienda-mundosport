<?php
// Obtén los datos enviados por PayPal
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = [];
foreach ($raw_post_array as $keyval) {
    $keyval = explode('=', $keyval);
    if (count($keyval) == 2) {
        $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
}

// Verifica la respuesta con PayPal
$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array_merge($myPost, ['cmd' => '_notify-validate'])));
$response = curl_exec($ch);
curl_close($ch);

if ($response == 'VERIFIED') {
    
    $transactionId = $myPost['txn_id'];
    $amount = $myPost['mc_gross'];
    $paymentStatus = $myPost['payment_status'];

    
    $pdo = new PDO('mysql:host=localhost;dbname=tienda_online', 'root', '');
    $stmt = $pdo->prepare("UPDATE ventas SET metodo_pago = :metodo_pago WHERE transaction_id = :transaction_id");
    $stmt->execute([
        ':estado_pago' => $paymentStatus,
        ':transaction_id' => $transactionId
    ]);
}

