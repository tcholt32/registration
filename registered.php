<?php
require 'utilities.php';
		ob_start();
		if(isset($_POST['submit'])){
			$firstname=esc($_POST['first_name']);
			$lastname=esc($_POST['last_name']);
			$address1=esc($_POST['address_line1']);
			$address2=esc($_POST['address_line2']);
			$city=esc($_POST['city']);
			$state=esc($_POST['state']);
			$zip=esc($_POST['zip']);
			$country=esc($_POST['country']);
			
			if(empty($firstname) || empty($lastname) || empty($address1) || empty($city) || empty($state) || empty($zip) || empty($country)){
				header("Location: ../registration.php?setup=blank");exit();
			}
			else{
				if (!checkAllLetters($firstname) || !checkAllLetters($lastname) || !checkAllLetters($city) || !checkAllLetters($country) || !checkAllLetters($state)){
					header("Location: ../registration.php?setup=invalid");ob_end_flush();exit();
				}
				else
				{
					if(!checkAllNumbersLetters($address1) || (!checkAllNumbersLetters($address2) && !empty($address2))){
						header("Location: ../registration.php?setup=invalid");
						exit();
					}
					else
					{
						if(!checkAllNumbers($zip)){
							header("Location: ../registration.php?setup=invalid");exit();
							} 
						else{ 
							if((strlen($zip)!=5 && strlen($zip)!=9) || strlen($state)>2 || strlen($country)>2){
								header("Location: ../registration.php?setup=length");exit();
							}else{
								if(strtoupper($country)!="US"){
									header("Location: ../registration.php?setup=loc");exit();
								}
							}
						}			
						
					}
				}
			}
				require_once('connect.php');
				$query = "INSERT into accounts (first_name,last_name,address_line1,address_line2,city,state,zip,country) VALUES (?,?,?,?,?,?,?,?)";
				$stmnt = mysqli_prepare($con,$query);
				
				mysqli_stmt_bind_param($stmnt,"ssssssis",$firstname,$lastname,$address1,$address2,$city,$state,$zip,$country);
				mysqli_stmt_execute($stmnt);
				if ( !$stmnt ) {
					die('mysqli error: '.mysqli_error($con));
				}
				
				$affected_rows = mysqli_affected_rows($con);
				if($affected_rows==1){
					mysqli_stmt_close($stmnt);
					mysqli_close($con);
					header("Location: ../registration.php?setup=suc");
					exit();
				}
				else{
					echo 'Error Occurred<br/>';
					echo mysqli_error($con);
				}
			
		}
?>