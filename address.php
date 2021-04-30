<?php
require 'dbconfig/config.php';

@$address_id="";
@$address="";
@$city_id="";
@$phone="";
@$postal_code="";
@$address2="";
@$loops = 0;
$currentTime = date("Y-m-d H:i:s", strtotime('+8 hours'));
echo $currentTime;
?>

<!DOCTYPE html>
<html>
<head>

	<title>Database</title>
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Webpage Style -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style_mobile.css">
	
	<!-- Metadata -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body style="background-color:#bdc3c7">

        <div class="row"><div class="col-12"><h2>Address (Select / Insert / Update/ Delete)</h2></div></div>

        <div class="inner_container">

            <form action="address.php" method="post" enctype="multipart/form-data">

				<div class="row">
					<div class="col-2">
						<label>Address ID (Insert / Update) (0 for NULL) </label>
					</div>
					<div class="col-4">
						<input type="number" placeholder="Enter Address ID" name="address_id" value="<?php echo $address_id;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch_btn" type="submit">Select</button>
					</div>
				</div>

				<div class="row">
					<div class="col-2">
						<label>Address (insert / change to)</label>
					</div>
					<div class="col-4">
						<input type="text" placeholder="Enter Address" name="address" value="<?php echo $address;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch1_btn" type="submit">Select</button>
					</div>
				</div>

				<div class="row">
					<div class="col-2">
						<label>Address2 (insert / change to) (- for NULL)</label>
					</div>
					<div class="col-4">
						<input type="text" placeholder="Enter address2" name="address2" value="<?php echo $address2;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch5_btn" type="submit">Select</button>
					</div>
				</div>
                
				<div class="row">
					<div class="col-2">
						<label>City ID (insert / change to)</label>
					</div>
					<div class="col-4">
						<input type="number" placeholder="Enter City ID" name="city_id" value="<?php echo $city_id;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch2_btn" type="submit">Select</button>
					</div>
				</div>
                
				<div class="row">
					<div class="col-2">
						<label>Postal Code (insert / change to) (0 for NULL)</label><br>
					</div>
					<div class="col-4">
						<input type="number" placeholder="Enter Postal Code" name="postal_code" value="<?php echo $postal_code;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch3_btn" type="submit">Select</button>
					</div>
				</div>
				
				<div class="row">
					<div class="col-2">
						<label>Phone (insert / change to) (- for NULL)</label>
					</div>
					<div class="col-4">
						<input type="text" placeholder="Enter Phone Number" name="phone" value="<?php echo $phone;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch4_btn" type="submit">Select</button>
					</div>
				</div>


                <div class="row">
					<div class="col-12">
						<center>
							<button id="btn_insert" name="insert_btn" type="submit"><i class="fa fa-plus-square"></i> Insert</button>
							<button id="btn_update" name="update_btn" type="submit"><i class="fa fa-edit"></i> Update</button>
							<button id="btn_delete" name="delete_btn" type="submit"><i class="fa fa-trash"></i> Delete</button>
						</center>
					</div>
				</div>
            </form>

            <div class="row">
				<div class="col-12">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" align="center">
						<label for="table">Choose a table from the list:</label>
						<input list="tables" name="table" id="table">
							<datalist id="tables">
								<option value="actor">
								<option value="address">
								<option value="category">
								<option value="city">
								<option value="country">
								<option value="customer">
								<option value="district">
								<option value="film">
								<option value="film_actor">
								<option value="film_category">
								<option value="film_rental">
								<option value="film_special_features">
								<option value="film_text">
								<option value="inventory">
								<option value="language">
								<option value="payment">
								<option value="rental">
								<option value="staff">
								<option value="staff_login">
								<option value="store">
							</datalist>
						<input type="submit">
					</form>
				</div>
            </div>

            <?php
                if(isset($_POST['insert_btn']))
                {
                    @$address_id=$_POST['address_id'];
                    @$city_id=$_POST['city_id'];
                    @$address=$_POST['address'];
                    @$postal_code=$_POST['postal_code'];
                    @$phone=$_POST['phone'];
                    @$address2=$_POST['address2'];

                    if($address_id=="" || $city_id=="" || $postal_code=="" || $address=="")
                    {
                        echo '<script type="text/javascript">alert("Insert values in all fields")</script>';
                    }
                    else{
                        if($address2 == "-"){
                            $address2=NULL;
                        }
                        if($phone == "-"){
                            $phone=NULL;
                        }
                        if($postal_code == "0"){
                            $postal_code='NULL';
                        }
                        if(empty($phone) && empty($address2)){
                            $query = "insert into address values ($address_id,'$address',NULL,$city_id,$postal_code,NULL,'$currentTime')";
                        }else if(empty($phone)){
                            $query = "insert into address values ($address_id,'$address','$address2',$city_id,$postal_code,NULL,'$currentTime')";
                        }else if(empty($address2)){
                            $query = "insert into address values ($address_id,'$address',NULL,$city_id,$postal_code,'$phone','$currentTime')";
                        }else{
                            $query = "insert into address values ($address_id,'$address','$address2',$city_id,$postal_code,'$phone','$currentTime')";
                        }
                        $query_run=mysqli_query($con,$query);
                        if($query_run)
                        {
                            echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
                        }
                        else{
                            echo '<script type="text/javascript">alert("Values NOT inserted")</script>';
                        }
                    }
                }

                else if(isset($_POST['update_btn']))
				{
					@$address_id=$_POST['address_id'];
                    @$city_id=$_POST['city_id'];
                    @$address=$_POST['address'];
                    @$postal_code=$_POST['postal_code'];
                    @$phone=$_POST['phone'];
                    @$address2=$_POST['address2'];
						
                    if($address_id != ""){
                        $query = "select * from address where address_id=$address_id";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            if(mysqli_num_rows($query_run)>0)
							{
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
							}
                            if($city_id == ""){
                                $city_id=$row['city_id'];
                            }
                            if($address == ""){
                                $address=$row['address'];
                            }
                            if($address2 == "-"){
                                $address2=NULL;
                            }else if($address2 == ""){
                                $address2=$row['address2'];
                            }else if($address2 == ""){
                                $address2=NULL;
                            }
                            if($phone == "-"){
                                $phone=NULL;
                            }else if($phone == ""){
                                $phone=$row['phone'];
                            }else if($phone == ""){
                                $phone=NULL;
                            }
                            if($postal_code == "0"){
                                $postal_code='NULL';
                            }else if($postal_code == ""){
                                $postal_code=$row['postal_code']; 
                            }
							if (empty($postal_code)){
								$postal_code='NULL';
							}	
                        }
                        if(empty($phone) && empty($address2)){
                            $query = "UPDATE `address` SET `address`='$address',`city_id`=$city_id,`postal_code`=$postal_code,`phone`=NULL,`address2`=NULL,`last_update`='$currentTime' WHERE `address_id`=$address_id";
                        }else if(empty($phone)){
                            $query = "UPDATE `address` SET `address`='$address',`city_id`=$city_id,`postal_code`=$postal_code,`phone`=NULL,`address2`='$address2',`last_update`='$currentTime' WHERE `address_id`=$address_id";
                        }else if(empty($address2)){
                            $query = "UPDATE `address` SET `address`='$address',`city_id`=$city_id,`postal_code`=$postal_code,`phone`=NULL,`address2`=NULL,`last_update`='$currentTime' WHERE `address_id`=$address_id";
                        }else{
                            $query = "UPDATE `address` SET `address`='$address',`city_id`=$city_id,`postal_code`=$postal_code,`phone`='$phone',`address2`='$address2',`last_update`='$currentTime' WHERE `address_id`=$address_id";
                        }
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
							echo '<script type="text/javascript">alert("Product Updated successfully")</script>';
						}
						else{
							echo '<script type="text/javascript">alert("Error")</script>';
						}
                    }
                    else{
                        echo '<script type="text/javascript">alert("Please input an Address ID")</script>';
                    }
				}
				
				else if(isset($_POST['delete_btn']))
				{
					if($_POST['address_id']=="")
					{
						echo '<script type="text/javascript">alert("Enter an Address ID to delete product")</script>';
					}
				else{
						$address_id = $_POST['address_id'];
                        if ($city_id == ''){
                            $query = "delete from address WHERE address_id=$address_id";
						}

						$query_run = mysqli_query($con,$query);
						if($query_run)
						{
							echo '<script type="text/javascript">alert("Product deleted")</script>';
						}
						else
						{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
					}
				}
            ?>

            <?php
                if(isset($_POST['fetch_btn'])){

                    $address_id = $_POST['address_id'];

                    if($address_id==""){
                        echo '<script type="text/javascript">alert("Enter Address ID to get data")</script>';
                    }
                    else{
                        $query = "select * from address where address_id=$address_id";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Address ID</th>
                                <th>Address</th>
                                <th>Address2</th>
                                <th>City ID</th>
                                <th>Postal Code</th>
                                <th>Phone Number</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while (mysqli_num_rows($query_run) != $loops){
                                $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["address_id"] . '</td><td>' . $row["address"] . '</td><td>' . $row["address2"] . '</td><td>' . $row["city_id"] . '</td><td>' . $row["postal_code"] . '</td><td>' . $row["phone"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Address ID")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }

                if(isset($_POST['fetch1_btn'])){

                    $address = $_POST['address'];

                    if($address==""){
                        echo '<script type="text/javascript">alert("Enter Address to get data")</script>';
                    }
                    else{
                        $query = "select * from address where address='$address'";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Address ID</th>
                                <th>Address</th>
                                <th>Address2</th>
                                <th>City ID</th>
                                <th>Postal Code</th>
                                <th>Phone Number</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while (mysqli_num_rows($query_run) != $loops){
                                $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["address_id"] . '</td><td>' . $row["address"] . '</td><td>' . $row["address2"] . '</td><td>' . $row["city_id"] . '</td><td>' . $row["postal_code"] . '</td><td>' . $row["phone"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Address")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }

                if(isset($_POST['fetch2_btn'])){

                    $city_id = $_POST['city_id'];

                    if($city_id==""){
                        echo '<script type="text/javascript">alert("Enter City ID to get data")</script>';
                    }
                    else{
                        $query = "select * from address where city_id=$city_id";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Address ID</th>
                                <th>Address</th>
                                <th>Address2</th>
                                <th>City ID</th>
                                <th>Postal Code</th>
                                <th>Phone Number</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while (mysqli_num_rows($query_run) != $loops){
                                $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["address_id"] . '</td><td>' . $row["address"] . '</td><td>' . $row["address2"] . '</td><td>' . $row["city_id"] . '</td><td>' . $row["postal_code"] . '</td><td>' . $row["phone"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid City ID")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }

                if(isset($_POST['fetch3_btn'])){

                    $postal_code = $_POST['postal_code'];

                    if($postal_code==""){
                        echo '<script type="text/javascript">alert("Enter Postal Code to get data")</script>';
                    }
                    else{
                        if($postal_code == "0"){
                            $postal_code="NULL";
                            $query = "select * from address where postal_code IS $postal_code";
                        }else{
                            $query = "select * from address where postal_code=$postal_code";
                        }
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Address ID</th>
                                <th>Address</th>
                                <th>Address2</th>
                                <th>City ID</th>
                                <th>Postal Code</th>
                                <th>Phone Number</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while (mysqli_num_rows($query_run) != $loops){
                                $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["address_id"] . '</td><td>' . $row["address"] . '</td><td>' . $row["address2"] . '</td><td>' . $row["city_id"] . '</td><td>' . $row["postal_code"] . '</td><td>' . $row["phone"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Postal Code")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }

                if(isset($_POST['fetch4_btn'])){

                    $phone = $_POST['phone'];

                    if($phone==""){
                        echo '<script type="text/javascript">alert("Enter Phone Number to get data")</script>';
                    }
                    else{
                        if($phone == "-"){
                            $query = "select * from address where phone IS NULL";
                        }else{
                            $query = "select * from address where phone='$phone'";
                        }
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Address ID</th>
                                <th>Address</th>
                                <th>Address2</th>
                                <th>City ID</th>
                                <th>Postal Code</th>
                                <th>Phone Number</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while (mysqli_num_rows($query_run) != $loops){
                                $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["address_id"] . '</td><td>' . $row["address"] . '</td><td>' . $row["address2"] . '</td><td>' . $row["city_id"] . '</td><td>' . $row["postal_code"] . '</td><td>' . $row["phone"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Phone Number")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }

                if(isset($_POST['fetch5_btn'])){

                    $address2 = $_POST['address2'];

                    if($address2==""){
                        echo '<script type="text/javascript">alert("Enter Address2 to get data")</script>';
                    }
                    else{
                        if($address2 == "-"){
                            $query = "select * from address where address2 IS NULL";
                        }else{
                            $query = "select * from address where address2='$address2'";
                        }
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Address ID</th>
                                <th>Address</th>
                                <th>Address2</th>
                                <th>City ID</th>
                                <th>Postal Code</th>
                                <th>Phone Number</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while (mysqli_num_rows($query_run) != $loops){
                                $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["address_id"] . '</td><td>' . $row["address"] . '</td><td>' . $row["address2"] . '</td><td>' . $row["city_id"] . '</td><td>' . $row["postal_code"] . '</td><td>' . $row["phone"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Address2")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }
            ?>
        </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
  if(isset($_POST['table'])){
	  
	  if ($_POST['table'] == "") $redirect_name = "address";
	  else $redirect_name = $_POST['table'];
	  $redirect_str = "<script>window.location.href='http://hcytt1.mercury.nottingham.edu.my/" . $redirect_name . ".php';</script>";
	  echo $redirect_str;
      exit();
  } 
}
?>

</body>
</html>