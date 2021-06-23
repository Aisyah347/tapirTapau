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
        <li><a href="index.php">Home</a></li>
        <li><a href="order.php">Order</a></li>
        <li><a class="active" href="account.php">My Account</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul><br>

    <center>
        <form method="post" action="editAccount.php">
            <table border="1">
                <?php
                $username = $_SESSION['user']['username'];
                $sql = "SELECT * FROM userdb WHERE username='$username'";
                if ($result = $mysqli->query($sql)) {
                    while ($row = $result->fetch_array()) {
                ?>
                
                <tr>
                    <th>Password</th>
                    <td><input type="password" name="userPassword" value="<?php echo $row['userPassword']; ?>" required /></td>
                </tr>
                <tr>
                    <th>noPhone</th>
                    <td><input type="text" name="noPhone" value="<?php echo $row['noPhone']; ?>" required /></td>
                </tr>
                    <th colspan="2">
                        <a href="editCustomer.php?id=<?php echo $row['id']; ?>" >Edit</a>
                    </th>

                <?php
                    }
                }
                ?>
            </table>
        </form>
    </center>
    <?php endif ?>
</body>
</html>