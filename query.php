<?php
/* make connection */
	$link = mysqli_connect("localhost","root","");
/* check connection */
	if(!$link){
		die('Connection Failed: ' . mysqli_error($link));
	}
/* make & check connection to database*/
	$db = mysqli_select_db($link,"test3") or die('Unable to selec database');
?>

<!DOCTYPE html>
<html>
  <head>
	<link href='https://fonts.googleapis.com/css?family=Marcellus+SC&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<title>Query Results</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style1.css" />

    <style>
    	body {
        font-size: 48px;
      	}
      
    	.button {
		float: right;
		position: relative;
		margin-top: 0px;
		}
		#footer{
			position: fixed;
			bottom: 10px;
		}
    </style>
  </head>

  <body>
  	<div id="container">

			
			<div id="headcontainer">
				<div id="topfilmstrip">
				</div>
				<div id="imagebar">
				</div>
				<div id="bottomfilmstrip">
				</div>
				<div id="header">
				<h1>Results</h1>
				</div>
			</div>

   		<div id="returnhome">
			<script>
			var audio = new Audio("resources/return.mp3");
			audio.oncanplaythrough = function ( ) { }
			audio.onended = function ( ) { }
			</script>
			<a class="button" href="home.html" onclick="audio.play ( )">Return to home</a>
		</div>

 <?php	
 /* *----------------------------------QUERY 1------------------------------------*/
	if (isset($_POST['state'])){
		$state=$_POST['state'];
/*	echo "SELECTION is: " . $state;	*/
	
/* check submit value */
		if (($state=="")){
			echo "No selection made.";
		}

		else {
			if (($state=="Arizona")){
				$state="AZ";
			}
			if (($state=="California")){
				$state="CA";
			}
			if (($state=="Illinois")){
				$state="IL";
			}
			if (($state=="New York")){
				$state="NY";
			}
			if (($state=="Texas")){
				$state="TX";
			}
			if (($state=="Wyoming")){
				$state="WY";
			}
/* execute query */
			$query="SELECT park_Name, park_street, park_city, park_state, park_zip_code FROM park WHERE (park_state='$state')";
			$result = mysqli_query($link,$query);
			
			if (!$result){
				echo 'Error fetching results: '.mysqli_error($link);
			}
			else{
/* display results */
		    	echo "All the parks in ".($_POST['state'])." are:";
				echo nl2br("\n\n");
		    	while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
			    	echo $row['park_Name'];
				    echo nl2br("\n");
				    echo $row['park_street'];
				    echo nl2br("\n");
				    echo $row['park_city'].', '.  $row['park_state']. ' '.$row['park_zip_code'];
				    echo nl2br("\n\n");
				}
/* free result set */
				mysqli_free_result($result);
			}
		}
	}
/* *----------------------------------QUERY 2------------------------------------*/
		if (isset($_POST['park'])){
			$park=$_POST['park'];
		
		if (isset($_POST['difficulty'])){
			$difficulty=$_POST['difficulty'];
		}


		if ($park==""){
			if($difficulty==""){
				$query="SELECT trail_Name,park_Name, park_street, park_city, park_state, park_zip_code FROM park, trail WHERE (park.park_Name='$park') AND (trail.difficulty='$difficulty')";
				$result = mysqli_query($link,$query);
				echo "No selection made.";
			}
		}

		if (!($park=="")){
			if($difficulty==""){
				$query="SELECT trail_Name, park_Name, park_street, park_city, park_state, park_zip_code, difficulty FROM park, trail WHERE (trail.park_ID=park.park_ID) AND (park_Name='$park')";
				echo "Only the park was selection was made.";
				echo nl2br("\n");
				$result = mysqli_query($link,$query);
			}
		}

		if(!($difficulty=="")){
			if(($_POST['park']=="")){
				$query="SELECT trail_Name, park_Name,park_street, park_city, park_state, park_zip_code FROM park, trail WHERE (trail.park_ID=park.park_ID) AND (difficulty='$difficulty')";
				echo "Only the difficulty level selection was made.";
				echo nl2br("\n");
				$result = mysqli_query($link,$query);
			}
		}

		if (!($park=="")){
			if(!($difficulty=="")){
				$query="SELECT trail_Name,park_Name, park_street, park_city, park_state, park_zip_code FROM park, trail WHERE (park.park_Name='$park') AND (trail.difficulty='$difficulty')";
				$result = mysqli_query($link,$query);
			}
		}

    $difficultyString = "";
    switch($difficulty) {
      case 1:
        $difficultyString = "easy";
        break;
      case 2:
        $difficultyString = "moderate";
        break;
      case 3:
        $difficultyString = "difficult";
        break;
      default:
        break;
    }
   
		if (!($_POST['park']=="")){
			if(!($_POST['difficulty']=="")){
    			if (mysqli_num_rows($result) == 0){
      				echo "No results.";
    			}
    		}
    	}
    	if (mysqli_num_rows($result) > 0){
      				
/* display results */
	    	echo "All of the ".$difficultyString." trails";
	    	if (!($park=="")){
		    	echo " in " . $park;
		    }
		    echo " are:";
			echo nl2br("\n\n");
	    	while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
		    	echo $row['trail_Name'];
         		echo nl2br("\n");
         
          		if (($park=="")){
          			if (!($difficulty=="")){
            			echo $row['park_Name'];
            			echo nl2br("\n");
			        }
			    }
			    	echo $row['park_street'];
			    	echo nl2br("\n");
			    	echo $row['park_city'].', '.  $row['park_state']. ' '.$row['park_zip_code'];
			    	echo nl2br("\n");
          
	          		if (($difficulty=="")){
	            		switch ($row['difficulty']) {
	              			case '1':
	                			echo "Difficulty: Easy";
	                			break;
	              			case '2':
	                			echo "Difficulty: Moderate";
	                			break;              
	              			case '3':
	                			echo "Difficulty: Difficult";
	                			break;                
	              			default:
	                			echo "Error finding difficulty";
	                			break;
	            		}
	        		}
          		/*}*/
          		echo nl2br("\n\n");          
		    }
/* free result set */
		mysqli_free_result($result);
		}
	}
/* *----------------------------------QUERY 3------------------------------------*/
     if (isset($_POST['park2'])){
        $park2=$_POST['park2'];
/*    echo "SELECTION is: " . $park;    */

/* check submit value */
	    if (($park2=="")){
	        echo "No selection made for camps.";
	    }
	    else {
/* execute query */
	        $query="SELECT activity, park_Name, camp_Name FROM camp, activity, park WHERE ((camp.camp_ID = activity.camp_ID) AND (park.park_ID = camp.park_ID) AND (park.park_Name = '$park2'))";
	        $result = mysqli_query($link,$query);
	        if (!$result){
	            echo 'Error fetching results: '.mysqli_error($link);
	        }
	        else{
/* display results */
  			   	echo nl2br("\n");
  				echo $park2." has camps with the following activities and/or facilities...";
		           echo nl2br("\n\n");
   		    	while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
	  			    echo $row['camp_Name'] . ":";
	  			   	echo nl2br("\n");
	  			    echo $row['activity'];
	                echo nl2br("\n\n");
}
	            }
/* free result set */
    			mysqli_free_result($result);
        	}
    	}
	
/* *----------------------------------QUERY 4------------------------------------*/
if (isset($_POST['region'])){
    $region=$_POST['region'];
    $query="SELECT trail_Name, trail_Type, park_Name, park_street, park_city, park_state, park_zip_code, region FROM park, trail WHERE trail.park_ID = park.park_ID";
    if (!($region=="")){
    	$query = $query . " AND (region = '$region')";
    }
/* execute query */
    $result = mysqli_query($link,$query);
    if (!$result){
    	echo 'Error fetching results: '.mysqli_error($link);
    }
    else{
/* display results */
	    if (mysqli_num_rows($result) == 0){
	    	echo "No results found.";
	    }
	    if (($region=="")){
	        echo "All trails:";
	        echo nl2br("\n");
	    }
	    if (!($region=="")){
	        echo "All trails in the $region region:";             
	        echo nl2br("\n\n");
		}
	    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
		    echo $row['trail_Name']. " located in ". $row['park_Name'];
		    echo nl2br("\n");
		    echo $row['park_street'];
		    echo nl2br("\n");
		    echo $row['park_city'].', '.  $row['park_state']. ' '.$row['park_zip_code'];
		    echo nl2br("\n");
		    echo 'Trail Type: ' . $row['trail_Type'];
		    echo nl2br("\n");

	        if (($region=="")){
	    	    echo "Region: ". $row['region'];
	        }          
	        echo nl2br("\n\n");
	    }
    }

/* free result set */
    mysqli_free_result($result);       
}
/* *----------------------------------QUERY 5------------------------------------*/
    if (isset($_POST['submitquery5'])){
/* execute query */
		$query="SELECT C3.park_ID, C3.camp_Name, C4.park_Name, C4.park_street, C4.park_city, C4.park_state, C4.park_zip_code, C3.rating FROM (SELECT rating, camp_Name, park_ID FROM camp c1 WHERE NOT EXISTS (SELECT * FROM camp C2 WHERE C2.rating > C1.rating)) C3, park C4 WHERE (C4.park_ID = C3.park_ID)";
		/*
      	$query="SELECT C1.camp_Name, park_Name, park_street, park_city, park_state, park_city, park_zip_code FROM park, camp C1, camp C2 WHERE NOT EXISTS (SELECT * FROM camp C2 WHERE ((C2.rating > C1.rating)AND (park.park_ID = C1.park_ID)) ORDER BY (C1.camp_Name)"; */
      	$result = mysqli_query($link,$query);
	    if (!$result){
	    	echo 'Error fetching results: '.mysqli_error($link);
	    }
      	else{
/* display results */
	        echo "The Top Rated camps are:";
	        echo nl2br("\n\n");
	        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
		        echo $row['camp_Name'];
		        echo nl2br("\n");
		        echo $row['park_street'];
		        echo nl2br("\n");
		        echo $row['park_city'].', '.  $row['park_state']. ' '.$row['park_zip_code'];
		        echo nl2br("\n");
		        echo 'rating: ' . $row['rating'];
		        echo nl2br("\n\n");
	        }
/* free result set */
    	mysqli_free_result($result);
        }
	}
/* *----------------------------------END OF QUERIES------------------------------------*/
/* close connection */
	mysqli_close($link);
?>

		<div id="footer">
			Copyright &copy; 2016 Team1 SER 234.
		</div>
	</body>
</html>