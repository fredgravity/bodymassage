<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div style="width: 600px; padding: 15px; margin: 0 auto; background-color: #0a0a0a; color: white;">
    <img src="https://masartgh.com/images/logo.png" style="height: 3rem;">
    <br>
    <?php
    echo "Name: ".$data['name'];
    ?>
    <br>
    <?php
    echo "Email: ".$data['email'];
    ?>
    <br>
    <br>
    <?php
    echo "Organisation: ".$data['organisation'];
    ?>
    <br>
    <?php
    echo "Phone: ".$data['phone'];
    ?>
    <br>
    <br>
    <?php
    echo "Message: ". $data['needs'] ;

    ?>

    <p>
        Regards <br><br>
        <strong>Artisao Team</strong>
    </p>
</div>
</body>
</html>

