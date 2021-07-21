<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact - Business Casual - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand">PVI BANK</div>

    <!-- Navigation -->
    <?php require_once 'nav.php';?>

    <div class="container">
		<div class="row">
            <div class="box">
                <div class="col-lg-12">
					<table class='table'>
									
							<?php
							$servername = "localhost";
							$username = "root";
							$password = "";
							$dbname = "bank";

							// Create connection
							$conn = new mysqli($servername, $username, $password, $dbname);

							// Check connection
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							} 

							$sql = "SELECT sno, sender, reciever, amount FROM transaction";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
							// output data of each row
								echo "
									<table class='table'>
									<tr>
									<td><strong>Sender</strong></td>
									<td><strong>Receiver</strong></td>
									<td><strong>Amount</strong></td>
									</tr>";
									while($row = $result->fetch_assoc()) {
									echo"<tr>
									<td>" . $row["sender"]. "</td>
									<td> ". $row["reciever"]."</td>
									<td>" . $row["amount"]. "</td>";
							}
							} else {
							echo "0 results";
							}

							$conn->close();
							?>
							</table>
						</table>
   
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Disclaimer:Intern Project<br/>&copy; Harsha Veena R N 2021</p>
                </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
