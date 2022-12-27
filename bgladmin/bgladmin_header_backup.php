<?php
	//We need to have a session started on ALL pages
	session_start();
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


			echo			'	<div class="nav-login" > <ul style="padding-top: 15px"><li style="color:white">';



			if(isset($_SESSION['u_ulevel'])){

			if ($_SESSION['u_uid']=="Don" OR $_SESSION['u_uid']=="vpn"){

				echo '<img src="/betty/image_id/Don.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="bheng") {

				echo '<img src="/betty/image_id/Bheng.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="WILMA" OR $_SESSION['u_uid']=="wilma") {

				echo '<img src="/betty/image_id/Wilma.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="TIN" OR $_SESSION['u_uid']=="Tin" ){

						echo '<img src="/betty/image_id/Tin.jpg" class="img-circle" width="30px" height="30px">';
			}else if($_SESSION['u_uid']=="MAUCHET" OR $_SESSION['u_uid']=="Mauchet" ){
						echo '<img src="/betty/image_id/mauchet.jpg" class="img-circle" width="30px" height="30px">';



				}else{
					echo '<img src="/betty/image_id/noimage.jpg" class="img-circle" width="30px" height="30px">';
				}


		echo '  ' . $_SESSION['u_uid'] .', You are logged in as ' . $_SESSION['u_ulevel'] .  ' &nbsp;&nbsp;</li></ul> ';
				}

	echo ' <form action="/betty/includes/logout.inc.php" method="POST">
					<button class="btn btn-small" type="submit" name="submit" >Logout</button>
					</form>';

					//If the user is not logged in ("u_id" doesn't exist), then we display the login form
				}else {

					echo '	<ul>
							<li><a id="linkcolor" href="/home/wpxgrynlfqu1/public_html/betty/index.php">Home</a></li>
						</ul>
						<div class="nav-login">
						<form action="/betty/includes/login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="Username/e-mail">
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="submit">Login</button>
						</form>';

							}
						

				?>
			</div>
		</div>
	</nav>
</header>
