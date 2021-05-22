<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h5>Payment Through razorpay</h5>
    <form id="do_payment" action="pay.php" method="POST">
    <table>
        <tr>
            <td>Amount:</td>
            <td><input type="text" name="amount"> </td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name"> </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email"> </td>
        </tr>
        <tr>
            <td>Contact no:</td>
            <td><input type="text" name="contact"> </td>
        </tr>
        <tr>
           
            <td><input type="submit" name="submit" value="Pay"> </td>
        </tr>


    </table>
    </form>
</body>
</html>