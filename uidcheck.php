	<?php
//	session_start();

	    
	if (empty($_SESSION['website'])) {
	    if ($_SESSION['LoginStatus'] = '1');{
	     $message = 'You need to Log in with your Username and Password To Enter Betty Loquinte Site!';
			echo "<script type='text/javascript'>alert(' $message ');setTimeout(2000);</script>";
	    }
        	//header("Location: includes/logout.inc.php");
		    exit();
	}else{

    if ($_SESSION['website']=='betty'){
        
        
    }else{
        $website = $_SESSION['website'];
        //	header("Location:" .  $website . "/includes/logout.inc.php");
        $message = 'Mali po ang Website Address Nyo!';
			echo "<script type='text/javascript'>alert(' $message ');setTimeout(\"location.href =" . $_SESSION['website'] . "\";\",1000,);</script>";
        	header("Location: includes/logout.inc.php");
		    exit();
    
    }
    }
	?>