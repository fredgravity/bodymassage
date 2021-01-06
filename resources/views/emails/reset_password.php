<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div style="width: 600px; padding: 15px; margin: 0 auto; background-color: #ffffff; color: #000000;">
    <img src="https://masartgh.com/images/logo.png" style="height: 3rem;">
    <br>
    Dear <?php echo $data['username']; ?>,

    <br>
    <br>

    <p>This email is to confirm that you have reset your account password with Body Massage.</p>
    <p>These are your details for your new account</p>
    <ul>
        <li>New Login Password: <?php echo ' ' . $data['password']; ?></li>
    </ul>
    <p>Please remember to change your login password in your user dashboard</p>
    <p>If you would like to find out more about artisao, please do not hesitated to contact us on our Contact Us page of our website</p>

    <p>
        Regards <br><br>
        <strong>Artisao Team</strong>
    </p>

<!--    <p><a href=" --><?php //getenv('APP_ENV'); ?><!--/termsandconditions">Terms and Conditions</a></p>-->
</div>
</body>
</html>