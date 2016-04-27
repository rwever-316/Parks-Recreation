<?php
/* make connection */
	$link = mysqli_connect("localhost","root","");

/* check connection */
	if(!$link){
		die('Connection Failed: ' . mysqli_error($link));
	}

/* make & check connection to database*/
	$db = mysqli_select_db($link,"test3") or die('Unable to selec database');

/* check variables are query safe */



?>

<!DOCTYPE html>
<html>
  <head>
	<link href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|Marcellus+SC&subset=latin,latin-ext" rel='stylesheet' type='text/css'>
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
			position: absolute;
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
	echo "park SELECTION is: " . $park;	
echo nl2br("\n");
/* check submit value */
	if (($park=="")){
		echo "No selection made for park.";
	}
	if (isset($_POST['difficulty'])){
		$difficulty=$_POST['difficulty'];
	echo "difficulty SELECTION is: " . $difficulty;	
	echo nl2br("\n");
}

/* check submit value */
	if (($difficulty=="")){
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




/* close connection */
	mysqli_close($link);
    ?>

    	<br/>
		<div id="returnhome">
		<a class="button" href="index1.html">Return to home</a>
		</div>
		<div id="footer">
			Copyright &copy; 2016 Team1 SER 234.
		</div>
  </body>
</html>
