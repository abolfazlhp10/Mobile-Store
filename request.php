<?php
session_start();
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
$Amount = $_SESSION["sum"]; //Amount will be based on Toman - Required
$Description = 'توضیحات'; // Required
$Email = 'UserEmail@Mail.Com'; // Optional
$Mobile = '09123456789'; // Optional
$CallbackURL = 'http://localhost/store of me/verify.php'; // Required


$client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentRequest(
    [
        'MerchantID' => $MerchantID,
        'Amount' => $Amount,
        'Description' => $Description,
        'Email' => $Email,
        'Mobile' => $Mobile,
        'CallbackURL' => $CallbackURL,
    ]
);

//Redirect to URL You can do it also by creating a form
if ($result->Status == 100) {
    Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
} else {
    echo'ERR: '.$result->Status;
}

?>
