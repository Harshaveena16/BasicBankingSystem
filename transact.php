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
									
if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $bal = $_POST['bal'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($conn,$sql);
    $sen = mysqli_fetch_array($query); 

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn,$sql);
    $rec = mysqli_fetch_array($query);



    if($bal == 0){

         echo "<script type='text/javascript'>";
         echo "alert(' Amount should not be zero')";
         echo "</script>";
   
    }
    else if($bal > $sen['amount']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")'; 
        echo '</script>';
    }
    else  if (($bal)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Amount should not be negative")';
        echo '</script>'; 
     }
    else {
        
                
                $newamount = $sen['amount'] - $bal;
                $sql = "UPDATE customers set amount=$newamount where id=$from";
                mysqli_query($conn,$sql);
             

                
                $newamount = $rec['amount'] + $bal;
                $sql = "UPDATE customers set amount=$newamount where id=$to";
                mysqli_query($conn,$sql);
                          $sender = $sen['name'];
						  $reciever = $rec['name'];
						  $sql = "INSERT INTO transaction(sender,reciever,amount) VALUES (' $sender',' $reciever','$bal')";
                         $query=mysqli_query($conn,$sql);
                          if ($conn->query($sql) === TRUE) {
                     echo "<script> alert('Transaction Successful');
                                     window.location='transhis.php';
                           </script>";
                    
                }

                $newamount= 0;
                $bal =0;
        }
    
}				
?>					

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog - Business Casual - Start Bootstrap Theme</title>

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
					<hr>
                    <h2 class="intro-text text-center">
                        <strong>TRANSACTION</strong>
                    </h2>
                    <hr>
                    
                            <div class="form-group col-lg-6">
                                <label>Sender</label>
							</div>
						
                <?php
               
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customers where id='$sid'";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
				        <select class="form-control">
							<option><?php echo $rows['name'] ?> (<?php echo $rows['amount'] ?>)<option>
				        </select>
           
								</div>
								
                            <div class="form-group col-lg-6">
                                <label>Reciever</label>
                                <select name="to"  class="form-control">
								
										<option  value="0" selected disabled>Select </option>
									    <?php
										$sid=$_GET['id'];
										$sql = "SELECT * FROM customers where id!=$sid";
										$result=mysqli_query($conn,$sql);
										if(!$result)
										{
											echo "Error ".$sql."<br>".mysqli_error($conn);
										}
										while($rows = mysqli_fetch_assoc($result)) {
									?>
										<option class="table" value="<?php echo $rows['id'];?>" >
										
											<?php echo $rows['name'] ;?> 
											(<?php echo $rows['amount'] ;?> ) 
									   
										</option>
									<?php 
										} 
									?>
									</select>
                            </div>
						
                            <div class="form-group col-lg-6">
                                <label>Amount</label>
                                <input type="number" class="form-control" name="bal">
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="form-group col-lg-6">
                                <button type="submit" name="submit" class="btn btn-default" >Transfer</button>
                            </div>
                       
                   </form>
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
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
