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
/* execute query */
			$query="SELECT park.park_Name, address.street, address.city, address.state, address.zip_Code FROM park JOIN address WHERE (address.park_ID=park.park_ID) AND (address.state='$state')";
			$result = mysqli_query($link,$query);
			
			if (!$result){
				echo 'Error fetching results: '.mysqli_error($link);
			}
			else{
/* display results */
		    	echo "All the parks in ".$state." are:";
				echo nl2br("\n\n");

		    	while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
			    	echo $row['park_Name'];
				    echo nl2br("\n");
				    echo $row['street'];
				    echo nl2br("\n");
				    echo $row['city'].', '.  $row['state']. ' '.$row['zip_Code'];
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
		/*echo "park SELECTION is: " . $park;	
		echo nl2br("\n");*/

		if (isset($_POST['difficulty'])){
			$difficulty=$_POST['difficulty'];
			/*	echo "difficulty SELECTION is: " . $difficulty;	
			echo nl2br("\n");*/
		}

/* execute query */
    $query="SELECT trail_Name, street, city, state, zip_Code, park_Name, difficulty FROM park JOIN trail, address WHERE (trail.park_ID=park.park_ID) AND (address.park_ID=park.park_ID)";
    $parkOutputText = ":";
    if (!($park=="")) {
      $query = $query . "AND (park.park_Name='$park')";
      $parkOutputText=" in ".$park." are:";
    }
    if (!($difficulty=="")) {
      $query = $query . "AND (trail.difficulty='$difficulty')";
    }
		//$query="SELECT trail_Name FROM park JOIN trail WHERE (trail.park_ID=park.park_ID) AND (park.park_Name='$park') AND (trail.difficulty='$difficulty')";
		$result = mysqli_query($link,$query);
		
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
		if (!$result){
			echo 'Error fetching results: '.mysqli_error($link);
		}
    elseif (mysqli_num_rows($result) == 0){
      echo "No results.";
    }
		else{
/* display results */
	    	echo "All ".$difficultyString." trails" . $parkOutputText;
			echo nl2br("\n\n");

	    	while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
		    	echo $row['trail_Name'];
          echo nl2br("\n");
          if (($park=="")){
            echo $row['park_Name'];
            echo nl2br("\n");
          }
			    echo $row['street'];
			    echo nl2br("\n");
			    echo $row['city'].', '.  $row['state']. ' '.$row['zip_Code'];
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
          echo nl2br("\n\n");          
		    }
		/* free result set */
	mysqli_free_result($result);
	}
}


/* *----------------------------------QUERY 3------------------------------------*/
     if (isset($_POST['park2'])){
        $park=$_POST['park2'];
/*    echo "SELECTION is: " . $park;    */

/* check submit value */
	    if (($park=="")){
	        echo "No selection made for camps.";
	    }

	    else {
/* execute query */
	        $query="SELECT camp_Name, hiking, biking, swimming, fishing, boating, kayaking,
	                winter_sports, pets_Allowed, wheelchair_Access, rv_Sites, tent_Sites
	                FROM camp, activity, park
	                WHERE camp.camp_ID = activity.camp_ID
	                AND park.park_ID = camp.park_ID
	                AND park.park_Name = '$park'";

	        $result = mysqli_query($link,$query);

	        if (!$result){
	            echo 'Error fetching results: '.mysqli_error($link);
	        }
	        else{
	            /* display results */
	            echo "All the activities in ".$park." are:";
	            echo nl2br("\n\n");

	            while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
	            	echo "Camp ". $row['camp_Name'] . " includes:";
	                if($row['hiking'] == 1)
	                  echo nl2br("\n") ."hiking ";
	                if($row['biking'] == 1)
	                  echo nl2br("\n") . "biking ";
	                if($row['swimming'] == 1)
	                  echo nl2br("\n") . "swimming ";
	                if($row['fishing'] == 1)
	                  echo nl2br("\n") . "fishing ";
	                if($row['boating'] == 1)
	                  echo nl2br("\n") . "boating ";
	                if($row['kayaking'] == 1)
	                  echo nl2br("\n") . "kayaking ";
	                if($row['winter_sports'] == 1)
	                  echo nl2br("\n") . "winter sports ";
	                if($row['pets_Allowed'] == 1)
	                  echo nl2br("\n") . "pets allowed ";
	                if($row['wheelchair_Access'] == 1)
	                  echo nl2br("\n") . "wheelchair access ";
	                if($row['rv_Sites'] == 1)
	                  echo nl2br("\n") . "RV sites ";
	                if($row['tent_Sites'] == 1)
	                  echo nl2br("\n") . "tent sites ";
	                echo nl2br("\n\n");
	            }
/* free result set */
    			mysqli_free_result($result);
        	}
    	}
	}

/* *----------------------------------QUERY 4------------------------------------*/
if (isset($_POST['region'])){
        $region=$_POST['region'];

      $query="SELECT trail_Name, trail_Type, street, city, state, zip_Code, region
              FROM park, trail, address
              WHERE park.park_ID = address.park_ID
              AND trail.park_ID = park.park_ID";

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
        if (($region=="")){
          echo "All trails:";
        }
        else {
          echo "All trails in the $region region:";         
        }
        echo nl2br("\n\n");

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
          echo $row['trail_Name'];
          echo nl2br("\n");
          echo 'Trail Type: ' . $row['trail_Type'];
          echo nl2br("\n");
          echo $row['street'];
          echo nl2br("\n");
          echo $row['city'].', '.  $row['state']. ' '.$row['zip_Code'];
          echo nl2br("\n");
          if (($region=="")){
            echo "Region: ". $row['region'];
          }          
          echo nl2br("\n\n");
        }
        /* free result set */
    mysqli_free_result($result);
        }

}

/* *----------------------------------QUERY 5------------------------------------*/
    if (isset($_POST['submitquery5'])){

/* execute query */
      	$query="SELECT camp_Name, street, city, state, zip_Code, rating
            FROM camp, address
            WHERE camp.park_ID = address.park_ID
           	AND rating > 3
            ORDER BY rating DESC LIMIT 5";

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
		        echo $row['street'];
		        echo nl2br("\n");
		        echo $row['city'].', '.  $row['state']. ' '.$row['zip_Code'];
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
