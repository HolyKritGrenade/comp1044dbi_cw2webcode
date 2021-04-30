<?php
require 'dbconfig/config.php';

@$actor_id="";
@$first_name="";
@$last_name="";
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

        <div class="row"><div class="col-12"><h2>Actor (Select / Insert / Update/ Delete)</h2></div></div>

        <div class="inner_container">

            <form action="actor.php" method="post" enctype="multipart/form-data">

                <div class="row">
					<div class="col-2">
						<label>Actor ID </label>
					</div>
					<div class="col-4">
						<input type="number" placeholder="Enter Actor ID" name="actor_id" value="<?php echo $actor_id;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch_btn" type="submit">Select</button>
					</div>
				</div>

				<div class="row">
					<div class="col-2">
						<label>Actor First Name (Insert / Update) </label>
					</div>
					<div class="col-4">
						<input type="text" placeholder="Enter First Name" name="first_name" value="<?php echo $first_name;?>"><br>
					</div>
					<div class="col-6">
						<button id="btn_go" name="fetch1_btn" type="submit">Select</button>
					</div>
				</div>
				
				<div class="row">
					<div class="col-2">
						<label> Actor Last Name (Insert / Update) </label>
					</div>
					<div class="col-4">
						<input type="text" placeholder="Enter Last Name" name="last_name" value="<?php echo $last_name;?>"><br>
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
                    @$actor_id=$_POST['actor_id'];
                    @$first_name=$_POST['first_name'];
                    @$last_name=$_POST['last_name'];

                    if($actor_id=="" || $first_name=="" || $last_name=="")
                    {
                        echo '<script type="text/javascript">alert("Insert values in all fields")</script>';
                    }
                    else{
                        $query = "insert into actor values ('$actor_id','$first_name','$last_name','$currentTime')";
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
					@$actor_id=$_POST['actor_id'];
                    @$first_name=$_POST['first_name'];
                    @$last_name=$_POST['last_name'];
						
                    if($actor_id != ""){
                        $query = "select * from actor where actor_id=$actor_id";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            if(mysqli_num_rows($query_run)>0)
							{
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
							}
                            if($first_name == ""){
                                $first_name=$row['first_name'];
                            }
                            if($last_name == "" && $query_run){
                                $last_name=$row['last_name'];
                            }
                        }
                        
                        $query = "update actor SET first_name = '$first_name', last_name='$last_name', last_update='$currentTime' WHERE actor_id=$actor_id";
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
                        echo '<script type="text/javascript">alert("Please input an Actor ID")</script>';
                    }
				}
				
				else if(isset($_POST['delete_btn']))
				{
					if($_POST['actor_id']=="")
					{
						echo '<script type="text/javascript">alert("Enter an Actor ID to delete product")</script>';
					}
				else{
						$actor_id = $_POST['actor_id'];
						$query = "delete from actor 
							WHERE actor_id=$actor_id";
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

                    $actor_id = $_POST['actor_id'];

                    if($actor_id==""){
                        echo '<script type="text/javascript">alert("Enter Actor_ID to get data")</script>';
                    }
                    else{
                        $query = "select * from actor where actor_id=$actor_id";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Actor ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while(mysqli_num_rows($query_run) != $loops){
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["actor_id"] . '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Actor ID")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }
                else if(isset($_POST['fetch1_btn'])){

                    $first_name = $_POST['first_name'];

                    if($first_name==""){
                        echo '<script type="text/javascript">alert("Enter Actor First Name to get data")</script>';
                    }
                    else{
                        $query = "select * from actor where first_name='$first_name'";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Actor ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while(mysqli_num_rows($query_run) != $loops){
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["actor_id"] . '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Actor First Name")</script>';
							}
						}
						else{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
                    }
                }
                else if(isset($_POST['fetch2_btn'])){

                    $last_name = $_POST['last_name'];

                    if($last_name==""){
                        echo '<script type="text/javascript">alert("Enter Actor Last Name to get data")</script>';
                    }
                    else{
                        $query = "select * from actor where last_name='$last_name'";
                        $query_run = mysqli_query($con,$query);
                        if($query_run){
                            echo '<div class = "w3-container">
            
                                <table class="w3-table_all">
                                <tread>
                                <tr class="w3-light-grey">
                                <th>Actor ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Last Update</th>
                                </tr>
                                </tread>';
                            if(mysqli_num_rows($query_run)>0)
							{
                                while(mysqli_num_rows($query_run) != $loops){
								$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                echo '<tr><td>', $row["actor_id"] . '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["last_update"] . '</td></tr>';
                                $loops++;
                                }
							}
							else{
								echo '<script type="text/javascript">alert("Invalid Actor Last Name")</script>';
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
	  
	  if ($_POST['table'] == "") $redirect_name = "actor";
	  else $redirect_name = $_POST['table'];
	  $redirect_str = "<script>window.location.href='http://hcytt1.mercury.nottingham.edu.my/" . $redirect_name . ".php';</script>";
	  echo $redirect_str;
      exit();
  } 
}
?>

</body>
</html>
