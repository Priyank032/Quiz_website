<?php
include 'connection.php';
session_start();
if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
              $count = 0;
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	          $count++;
              if($count>1) {
                  //It wiil insert a row to our subject table from our csv file`
	                $sql = "INSERT into user_register (`uname`, `uemail`, `upwd`) 
                    values('$emapData[0]','$emapData[1]','$emapData[2]')";
                    //we are using mysql_query function. it returns a resource on true else False on error
                     $result = mysqli_query( $db, $sql );
                     if(! $result )
                     {
                        echo "<script type=\"text/javascript\">
                                alert(\"Invalid File:Please Upload CSV File.\");
                                window.location = \"index.php\"
                            </script>";
                    
                    }
              }
	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
	        
			 

			 //close of connection
			mysqli_close($conn); 
				
		 	
			
		 }
	}	 
?>