<?php
	//if user is not already logged in
	if(!isset($_SESSION['user'])){

		//if a password & username has been entered
		if(isset($_POST['username']) && isset($_POST['pass'])){
		///??????????DO I NOT NEED STRIP TAGS ON THIS ONE?PPPPPPPPPPPPPPPPPPP???????????????????
			
			//if username & password is right
			if($_POST['username']=="linkena379" && hash('sha256', $_POST['pass'])==
				"c402620e9779ae8999bcdb5b66b00ebdb8b9b37bea2a6abe25742f628500394a"){
				
				$_SESSION['user']=true;
				echo("<form action=\"$page\" method=\"post\">
				<p>Welcome Master.&nbsp;&nbsp;&nbsp;
				<input type=\"submit\" value=\"Logout\" name=\"logout\"/></p>
				</form>");
			
			//if username & password is not right
			}else{
			
				echo("<p class=\"wrongpass\">Imposter! You're username/ password combination is false! &nbsp;&nbsp;
				<a href=$page><button type=\"button\" id=\"tryagain\">Try Again</button></a>
				</p>");
				
				}
		//if password & username has not been entered		
		}else{
			require("loginform.php");
		}
	
	//if user is logged in but wants to log out
	}else if(isset($_POST['logout'])){
		
		unset($_SESSION['user']);
		require("loginform.php");
	
	//if user is logged in
	}else{
	
		echo("<form action=\"$page\" method=\"post\">
				<p><label>Welcome Master.</label>&nbsp;&nbsp;&nbsp;
				<input type=\"submit\" value=\"Logout\" name=\"logout\"/></p>
				</form>");
	}
?>