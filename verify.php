<?php

require('config.php');
session_start();
//db connection
$conn=mysqli_connect($host,$username,$password,$dbname);
if($conn)
{
    echo"db connection success";
}


require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $razorpay_order_id=$_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $email=$_SESSION['email'];
    $amount=$_SESSION['amount'];
    $sql="INSERT INTO `payment_details` (`order_id`, `payment_id`,`email`,`amount`,`status`) VALUES ('$razorpay_order_id', '$razorpay_payment_id', '$email','$amount', 'success')";
    if(mysqli_query($conn,$sql))
    {
        echo "payment details inserted in db";
    }
    else
    {
        echo mysqli_error($conn);
    }

    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
