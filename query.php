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
	<link href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|MarcellusSC&subset=latin,latin-ext" rel='stylesheet' type='text/css'>
	<title>Query Results</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style1.css" />

    <style>
    	body {
        font-size: 48px;
      	}
      
    	.button {
		float: right;
		position: relative;
		margin-top: 10px;
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
/* check submit value */
		if (($park=="")){
			echo "No selection made for park.";
			echo nl2br("\n");
		}
		if (isset($_POST['difficulty'])){
			$difficulty=$_POST['difficulty'];
			/*	echo "difficulty SELECTION is: " . $difficulty;	
			echo nl2br("\n");*/
		}

/* check submit value */
		if (($difficulty=="")){
			echo "No selection made for difficulty.";
		}

/* check submit value */
		if (($difficulty=="")|($park=="")){
			echo "No selection made for difficulty.";
		}
	else {
		
/* execute query */
		$query="SELECT trail_Name FROM park JOIN trail WHERE (trail.park_ID=park.park_ID) AND (park.park_Name='$park') AND (trail.difficulty='$difficulty')";
		$result = mysqli_query($link,$query);
		
		if (!$result){
			echo 'Error fetching results: '.mysqli_error($link);
		}
		else{
/* display results */
	    	echo "All the ".$difficulty." trails in ".$park." are:";
			echo nl2br("\n\n");

	    	while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
		    	echo $row['trail_Name'];
			 /*   echo nl2br("\n");
			    echo $row['street'];
			    echo nl2br("\n");
			    echo $row['city'].', '.  $row['state']. ' '.$row['zip_Code']; */
			    echo nl2br("\n\n");
		    }
		/* free result set */
	mysqli_free_result($result);
		}
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
        $query="SELECT hiking, biking, swimming, fishing, boating, kayaking,
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
            echo "All the aciivities in ".$park." are:";
            echo nl2br("\n\n");

            while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                if($row['hiking'] == 1)
                  echo "hiking ";
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
    if (isset($_POST['submitquery4'])){

      /* execute query */
      $query="SELECT trail_Name, trail_Type, street, city, state, zip_Code
              FROM park, trail, address
              WHERE region = 'West'
              AND park.park_ID = address.park_ID
              AND trail.park_ID = park.park_ID";

      $result = mysqli_query($link,$query);

      if (!$result){
          echo 'Error fetching results: '.mysqli_error($link);
      }
      else{
        /* display results */
        echo "All the trails in the Western region are:";
        echo nl2br("\n\n");

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
          echo $row['trail_Name'];
          echo nl2br("\n");
          echo 'Trail Type: ' . $row['trail_Type'];
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

    	<br/>
		<div id="returnhome">
			<script>
			var audio = new Audio("return.mp3");
			audio.oncanplaythrough = function ( ) { }
			audio.onended = function ( ) { }
			</script>
			<a class="button" href="index1.html" onclick="audio.play ( )">Return to home</a>
		</div>

		<div id="footer">
			Copyright &copy; 2016 Team1 SER 234.
		</div>
  </body>
</html>
