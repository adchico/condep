<?php
	//We need to have a session started on ALL pages
	session_start();
$u_id=$_SESSION['u_id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">

<style>

#linkcolor {
	font-size: 14px;
	color:white;
}
</style>

</head>
<body>

<header>
	<nav <?php  echo 'style=\'background-color:#3b5998\''; ?> >
		<div class="main-wrapper">

				<?php



					//Here is our login form!
					//Notice that we check if we have a SESSION variable named "u_id". The "u_id" is created in our login script in login.inc.php, and will only exist if the user is logged in!

					//If the user is logged in ("u_id" does exist), then we display the logout form
					if (isset($_SESSION['u_id'])) {

						echo '
						<ul>
								<li> <a id="linkcolor" href="/betty/index.php">Home 2019</a></li>
							</ul>
							<ul>
									<li><a id="linkcolor" href="/betty/viewbl.php">Bill of Lading</a></li>
								</ul>

								<ul>
										<li><a id="linkcolor" href="/betty/viewShippingLines.php"> Shipping Lines</a></li>
									</ul>

									<ul>
											<li><a id="linkcolor" href="/betty/viewForwarder.php">Forwarders</a></li>
										</ul>
										';


										if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN" OR $_SESSION['u_ulevel']=="Employee" OR $_SESSION['u_ulevel']=="EMPLOYEE"){

									echo'	<ul><li><a id="linkcolor" href="/betty/bgladmin/bgladmin.php">Admin Control Panel</a></li></ul>';
									}


	echo			'	<div class="nav-login" > ';
			
			
			  
			
			
			
			echo '<ul style="padding-top: 15px"><li style="color:white">';



			if(isset($_SESSION['u_ulevel'])){
/*
			if ($_SESSION['u_uid']=="Don" OR $_SESSION['u_uid']=="vpn"){

				echo '<img src="/betty/image_id/Don.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="bam") {

				echo '<img src="/betty/image_id/bam.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="pcarabeo" OR $_SESSION['u_uid']=="PCARABEO") {
				echo '<img src="/betty/image_id/priscila.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="KITE" OR $_SESSION['u_uid']=="kite" ){
						echo '<img src="/betty/image_id/christy.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="boyet" OR $_SESSION['u_uid']=="BOYET" ){
						echo '<img src="/betty/image_id/boyet.jpg" class="img-circle" width="30px" height="30px">';
				}else{
					echo '<img src="/betty/image_id/noimage.jpg" class="img-circle" width="30px" height="30px">';
				}
		echo '  ' . $_SESSION['u_uid'] .', You are logged in as ' . $_SESSION['u_ulevel'] .  ' &nbsp;&nbsp;</li></ul> ';
				}
				
				
				  */   
				
				
// This is pulling image from database using PDO 

     $user_id = null;
     $user_id = $_SESSION['u_id'];
     $u_id = null;
     $u_id = $_SESSION['u_id'];
    
    if ( null==$u_id ) {
        header("Location: index.php");
    } else {
  
            $pdo = Database::connect();
            $sql = "Select Image from users where user_id =" . $u_id;
            $q = $pdo->query($sql);
            
            while ($r = $q ->fetch()):
              echo "<img src =/betty/bgladmin/" . $r[Image] . " class='img-circle' width='30' height='30' />";
            endwhile;

           
   }
          
            
 // End of Code of pulling image from database using PDO        
           
              
                 
                  
        
                                      
                  
                  
                   

	}
		
		
        echo '  ' . $_SESSION['u_uid'] .', You are logged in as ' . $_SESSION['u_ulevel'] .  ' &nbsp;&nbsp;</li></ul> ';


    
              
            echo '<form action="/betty/includes/logout.inc.php" method="POST"  enctype="multipart/form-data">';
			echo '<button class="btn btn-small" type="submit" name="submit" >Logout</button>';
			echo'</form>';

					//If the user is not logged in ("u_id" doesn't exist), then we display the login form
			}	else {

					echo '	<ul>
							<li><a id="linkcolor" href="../index.php">Home</a></li>
						</ul>
						<div class="nav-login">
						<form action="/betty/includes/login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="Username/e-mail">
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="submit">Login</button>
						</form>';

							}
						$_SESSION['u_id']=$u_id;
     include 'uidcheck.php';
   //   Database::disconnect();
				?>
			</div>
		</div>
	</nav>
</header>
