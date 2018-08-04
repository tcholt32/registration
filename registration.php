<link rel="stylesheet" type="text/css" href="wrapper.css" />
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Registration</title>
	</head>
	<body>
		<div class="container">
			<form action="https://tcholt.000webhostapp.com/registered.php" method="post" id="registration_form">
				<fieldset>
					<legend>Account Setup</legend>
					<p>First Name:
					<input type="text" name="first_name" maxlength="128" size="30" value=""/>
					</p>
					<p>Last Name:
					<input type="text" name="last_name" maxlength="128" size="30" value=""/>
					</p>
					<p>Address Line 1:
					<input type="text" name="address_line1" maxlength="128" size="30" value=""/>
					</p>
					<p>Address Line 2:
					<input type="text" name="address_line2" maxlength="128" size="30" value=""/>
					</p>
					<p>City:
					<input type="text" name="city" maxlength="32" size="30" value=""/>
					</p>
					<p>State:
					<input type="text" name="state" maxlength="2" value="" style="width: 30px"/>
					</p>
					<p>Zip:
					<input type="text" name="zip" maxlength="9" size="6" value=""/>
					</p>
					<p>Country:
					<input type="text" name="country" maxlength="2" value="" style="width: 30px"/>
					</p>
					<p>
					<input type="submit" name="submit" value="Submit"/>
					</p>
				</fieldset>
			</form>
		</div>
<?php
		$url="https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		if(strpos($url,"setup=blank") == true){
			echo "<p class='err'>One or more mandatory fields left blank!<p>";
			exit();
		}
		elseif(strpos($url,"setup=invalid") == true){
			echo "<p class='err'>You used a list of invalid characters!<p>";
			exit();
		}
		elseif(strpos($url,"setup=length") == true){
			echo "<p class='err'>One or more fields have incorrect length.  State field has max length of 2 and Country field has max length of 2. Zip can be either 5 or 9 length<p>";
			exit();
		}
		elseif(strpos($url,"setup=loc") == true){
			echo "<p class='err'>Invalid country/region.  Site is meant for US accounts only!<p>";
			exit();
		}
		elseif(strpos($url,"setup=suc") == true){
			echo "<p class='suc'>Account Successfully created.<p>";
			exit();
		}
?>
	</body>
</html>