<?php
require '../session.php';

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (!isCustomer()) {
    $_SESSION['msg'] = "Access denied";
    
    if (isAdmin()) {
        header('location: ../admin/index.php');
    } elseif (isStaff()) {
        header('location: ../staff/index.php');
    } else {
        header('location: ../login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            border: black;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"/>
    <title>TT</title>
</head>
<body>
    <center>
        <table>
            <tr>
                <th><img src="../img/tapir_logo.png" width="25%"/></th>
            </tr>
            <tr>
                <th><h3>TapirTapau</h3></th>
            </tr>
        </table>
    </center>

    <?php if (isset($_SESSION['user'])) : ?>
    <strong><?php echo $_SESSION['user']['username']; ?></strong>
    
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="order.php">Order</a></li>
        <li><a href="account.php">My Account</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul><br>

    <center>
        <b>Pelanggan (Aisyah)</b><br>
        menguruskan senarai - pembelian pelanggan<br>

        <table border="1">
            <?php
            $sqlF = "SELECT * FROM fooddb WHERE typeFood='food'";
            if ($result = $mysqli->query($sqlF)) {
                while ($row = $result->fetch_array()) {
            ?>

            <tr>
                <th colspan="2">Food</th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Price (RM)</th>
            </tr>
            <tr>
                <td><?php echo $row['nameFood']; ?></td>
                <td><?php echo $row['priceFood']; ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </table>

        <table border="1">
            <?php 
            $sqlD = "SELECT * FROM fooddb WHERE typeFood='drink'";
            if ($result = $mysqli->query($sqlD)) {
                while ($row = $result->fetch_array()) {
            ?>
            <tr>
                <th colspan="2">Drinks</th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Price (RM)</th>
            </tr>
            <tr>
                <td><?php echo $row['nameFood']; ?></td>
                <td><?php echo $row['priceFood']; ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </table>
    </center>
    <?php endif ?>
</body>
</html>