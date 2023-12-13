<?php
require_once 'files/connect/database.php';
$action = new action("store of me", "root", "");
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
$Amount = $_SESSION["sum"]; //Amount will be based on Toman
$Authority = $_GET['Authority'];

if ($_GET['Status'] == 'OK') {

    $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

    $result = $client->PaymentVerification(
        [
            'MerchantID' => $MerchantID,
            'Authority' => $Authority,
            'Amount' => $Amount,
        ]
    );

    if ($result->Status == 100) {
        echo 'Transaction success. RefID:' . $result->RefID;
        $query = "UPDATE bascket SET status=? WHERE userid=?";
        $action->inud($query, [1, $_SESSION['username']]);
        if ($action == true) {
            header("Location:bascket.php?price=success");
        }
    } else {
        echo 'Transaction failed. Status:' . $result->Status;
    }
} else {
    echo 'Transaction canceled by user';
}
