<?php
require 'dbconfig/config.php';

@$staff_id="";
@$username="";
@$password="";
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
	
        <div class="row"><div class="col-12"><h2>Staff Login (Select / Insert / Update/ Delete)</h2></div></div>

        <div class="inner_container">

            <form action="staff_login.php" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-2">
						<label>Staff ID</label>
					</div>
					<div class="col-4">
						<input type="number" placeholder="Enter Staff ID" name="staff_id" value="<?php echo $staff_id;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch_btn" type="submit">Select</button>
					</div>
				</div>

				<div class="row">
					<div class="col-2">
						<label>Username</label>
					</div>
					<div class="col-4">
						<input type="text" placeholder="Enter Username" name="username" value="<?php echo $username;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch1_btn" type="submit">Select</button>
					</div>
				</div>
				
				<div class="row">
					<div class="col-2">
						<label>Password (- for NULL (Select only))</label>
					</div>
					<div class="col-4">
						<input type="text" placeholder="Enter Password" name="password" value="<?php echo $password;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch2_btn" type="submit">Select</button>
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
                    @$staff_id=$_POST['staff_id'];
                    @$username=$_POST['username'];
                    @$password=$_POST['password'];

                    if($staff_id=="" || $username=="" || $password=="")
                    {
                        echo '<script type="text/javascript">alert("Insert values in all fields")</script>';
                    }
                    else{
                        $query = "insert into staff_login values ($staff_id,'$username','$password')";
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
					@$staff_id=$_POST['staff_id'];
                    @$username=$_POST['username'];
                    @$password=$_POST['password'];
						
                    if($staff_id != ""){
                        $query = "select * from staff_login where staff_id=$staff_id";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            if(mysqli_num_rows($query_run)>0)
							{
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
							}
                            if($username == ""){
                                $username=$row['username'];
                            }
                            if($password == ""){
                                $password=$row['password'];
                            }
                            
                        }
                        if(empty($password)){
                            $query = "update staff_login SET username = '$username', password=NULL WHERE staff_id=$staff_id";
                        }else{
                            $query = "update staff_login SET username = '$username', password='$password' WHERE staff_id=$staff_id";
                        }
                        
                        $query_run = mysqli_query($con,$query);
                        if($query_run)
						{
							echo '<script type="text/javascript">alert("Product Updated successfully")</script>';
						}
						else{
							echo '<script type="text/javascript">alert("Error")</script>';
						}
                    }
                    else{
                        echo '<script type="text/javascript">alert("Please input an Staff ID")</script>';
                    }
				}
				
				else if(isset($_POST['delete_btn']))
				{
					if($_POST['staff_id']=="")
					{
						echo '<script type="text/javascript">alert("Enter a Staff ID to delete product")</script>';
					}
				else{
						$staff_id = $_POST['staff_id'];
						$query = "delete from staff_login 
							WHERE staff_id=$staff_id";
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

                    $staff_id = $_POST['staff_id'];

                    if($staff_id==""){
                        echo '<script type="text/javascript">alert("Enter Staff ID to get data")</script>';
                    }
                    else{
                        $query = "select * from staff_login where staff_id=$staff_id";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Staff ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["staff_id"] . '</td><td>' . $row["username"] . '</td><td>' . $row["password"] . '</td></tr>';
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Staff ID")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }
                else if(isset($_POST['fetch1_btn'])){

                    $username = $_POST['username'];

                    if($username==""){
                        echo '<script type="text/javascript">alert("Enter Staff Username to get data")</script>';
                    }
                    else{
                        $query = "select * from staff_login where username='$username'";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Staff ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
								while (mysqli_num_rows($query_run) != $loops){
									$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
									echo '<tr><td>', $row["staff_id"] . '</td><td>' . $row["username"] . '</td><td>' . $row["password"] . '</td></tr>';
									$loops++;
								}
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Username")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }
                else if(isset($_POST['fetch2_btn'])){

                    $password = $_POST['password'];

                    if($password==""){
                        echo '<script type="text/javascript">alert("Enter Staff Password to get data")</script>';
                    }
                    else{
                        if($password == "-"){
                            $query = "select * from staff_login where password IS NULL";
                        }else{
                            $query = "select * from staff_login where password='$password'";
                        }
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Staff ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
								while (mysqli_num_rows($query_run) != $loops){
									$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
									echo '<tr><td>', $row["staff_id"] . '</td><td>' . $row["username"] . '</td><td>' . $row["password"] . '</td></tr>';
									$loops++;
								}
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Password")</script>';
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
	  
	  if ($_POST['table'] == "") $redirect_name = "staff_login";
	  else $redirect_name = $_POST['table'];
	  $redirect_str = "<script>window.location.href='http://hcytt1.mercury.nottingham.edu.my/" . $redirect_name . ".php';</script>";
	  echo $redirect_str;
      exit();
  } 
}
?>

</body>
</html>