<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div style="width: 600px; padding: 15px; margin: 0 auto; background-color: #fcfdfd; color: #151515;">
    <img src="https://masartgh.com/images/logo.png" style="height: 3rem;">
    <p>
        Dear <?php echo ucfirst($data['name']) ?>,

    </p>

    <p>
        the following are the details of the massage you booked.
    </p>

    <h3>Order Number: <?php echo $data['orderNumber'] ?> </h3>

    Date: <?php echo $data['massageDate'] ?>, <br>
    <?php
        if ($data['massageTime'] == 'first'){
            echo 'Time: 8am - 10am';
        }elseif ($data['massageTime'] == 'second'){
            echo 'Time: 11am - 1pm';
        }elseif ($data['massageTime'] == 'third'){
            echo 'Time: 2pm - 4pm';
        }
    ?><br>

    Duration: <?php echo $data['massageHour'] ?> hr(s)<br>

    District: <?php echo $data['district'] ?> <br>

    <?php

        if ($data['place'] == 'hotel'){
            echo "Place of massage is: ".$data['place_name'];
        }else{
            echo "Place of Massage is: ".$data['place'];
        }

    ?> <br>

    Massage Type: <?php echo $data['productName'] ?> <br>

    Amount Paid: GHS <?php echo number_format($data['amount'],2 )?><br>


    <p>
        Thank you for booking Massage with Masartgh.com. Our therapist has been notified and will contact you as to when they are coming to the
        place chosen for the massage. Please make sure your phone is on for us to contact you for further directions.
    </p>

    <p>Remember this reference number for support and payment clarifications <strong> <?php echo $data['reference_number'] ?> </strong> </p>

    <p>
        Regards <br><br>
        <strong>Artisao Team</strong>
    </p>
</div>
</body>
</html>

