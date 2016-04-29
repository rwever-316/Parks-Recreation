
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Marcellus+SC&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<title>Parks - Recreation</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style1.css" />
	<style>
		body{
			margin: 0;
			padding: 0;
		}
		h1{
			height: 410px;
		}
		input#shiny{
			width: 150px;
			line-height: 14px;
			margin-left: 42.5%;
    		margin-right: -50%;
			}

	</style>

</head>
<body>
	<h1> </h1>
			<div id="loading">
	<span class="expand"></span>
	</div>
<?php

$link = mysqli_connect("localhost","root","");
mysqli_query($link, "DROP DATABASE IF EXISTS test3");
/*echo "Database created";*/

mysqli_query($link, "CREATE DATABASE test3");
/*echo "Database created";*/

mysqli_query($link, "USE test3");
/*mysqli_query($link, "CREATE DATABASE IF NOT EXISTS test3");
echo "Database created";

$db = mysqli_select_db($link,"test3");
*/


mysqli_query($link, "CREATE TABLE activity 
	(

	  camp_ID int(11) NOT NULL,

	  activity varchar(100),

	  PRIMARY KEY (camp_ID) )") ;

mysqli_query($link, "INSERT INTO activity VALUES
	('1','swimming, fishing, boating, kayaking, pets allowed, tent sites'),
	('2','hiking, biking, swimming, fishing, boating, kayaking, tent sites'),
	('3','winter sports, pets allowed, wheelchair access'),
	('4','hiking, winter sports, pets allowed, tent sites'),
	('5','hiking, biking, kayaking, tent sites'),
	('6','hiking, biking, winter sports, pets allowed, wheelchair access, RV sites, tent sites'),
	('7','hiking, biking, swimming, wheelchair access, RV sites, tent sites')");





mysqli_query($link, "CREATE TABLE camp
	 (

	  camp_ID int(11) NOT NULL,

	  park_ID int(11) NOT NULL,

	  camp_Name varchar(40) NOT NULL,

	  site_Fees double(10,0) NOT NULL,

	  rating int(11) NOT NULL,

	  is_Open int(1) NOT NULL,

	  PRIMARY KEY (camp_ID),

	  KEY park_ID (park_ID) )") ;


mysqli_query($link, "INSERT INTO camp VALUES

	 ('1', '5', 'Crystal Lake', '0', '1', '1'),

	 ('2', '2', 'Nature Retreat', '3', '5', '1'),

	 ('3', '4', 'Park Bench', '0', '1', '1'),

	 ('4', '2', 'Beautiful Spot in the Woods', '8', '5', '1'),

	 ('5', '1', 'Giant Hole Camping Grounds', '10', '2', '1'),

	 ('6', '0', 'Star Retreat', '15', '4', '1'),

	 ('7', '6', 'Rumbling Ground', '15', '3', '1')");


mysqli_query($link, "CREATE TABLE park
	 (

	  park_ID int(11) NOT NULL,

	  park_Name varchar(26) NOT NULL,

	  park_street varchar(20) NOT NULL,

	  park_city varchar(9) NOT NULL,

	  park_state varchar(2) NOT NULL,

	  park_zip_code int(5) NOT NULL,

	  park_Type varchar(8) NOT NULL,

	  region varchar(7) NOT NULL,

	  is_Open int(1) NOT NULL,

	  PRIMARY KEY (park_ID),

	  UNIQUE KEY park_ID (park_ID) )") ;



mysqli_query($link, "INSERT INTO park VALUES

	 ('0', 'Brazos Bend State Park', '3491 Happy St.', 'Needville', 'TX', '77461','State', 'South', '1'),

	 ('1', 'Grand Canyon National Park', '1895 Big Hole Canyon', 'Flagstaff', 'AZ', '85333', 'National', 'West', '1'),

	 ('2', 'Redwood National Park', '3981 Surfer St.', 'Redding', 'CA', '96002','National', 'West', '1'),

	 ('4', 'Central Park', '4820 Mugging Way', 'New York', 'NY', '96671','State', 'East', '1'),

	 ('5', 'Portage Park', '2950 Walking Rd.', 'Chicago', 'IL', '78345','State', 'Central', '1'),

	 ('6', 'Yellowstone National Park', '1985 Explosion Rd.', 'Nowhere', 'WY', '97846','National', 'Central', '1')");


mysqli_query($link, "CREATE TABLE trail
	 (
	
  	  trail_ID int(1) NOT NULL,
	
  	  park_ID int(1) NOT NULL,

	  trail_Name varchar(16) NOT NULL,

	  trail_Type varchar(8) NOT NULL,

	  difficulty int(1) NOT NULL,

	  trail_Length float(4) NOT NULL,

	  total_Climb int(5) NOT NULL,

	  is_Open int(1) NOT NULL,

	  PRIMARY KEY (trail_ID),

	  UNIQUE KEY trail_ID (trail_ID),

	  KEY park_ID (park_ID) )") ;

mysqli_query($link, "INSERT INTO trail VALUES

	 ('1', '0', 'Curvy Trail', 'Walking', '1', '3.5', '3', '0'),

	 ('2', '1', 'Impossible Climb', 'Hiking', '3', '15.8', '118', '1'),

	 ('3', '1', 'Downhill Jam', 'Biking', '3', '6.8', '-61', '1'),

	 ('4', '2', 'Scenic Run', 'Jogging', '2', '8.9', '20', '1'),

	 ('5', '2', 'Slow Walk', 'Walking', '1', '2.3', '10', '1'),

	 ('6', '5', 'Paved Path', 'Walking', '1', '2', '0', '1'),

	 ('7', '6', 'Explosive Run', 'Jogging', '2', '5.6', '13', '1'),

	 ('8', '6', 'High Flying', 'Biking', '3', '7.5', '32', '1')");

/*
-- Constraints for table activity
*/

mysqli_query($link, "ALTER TABLE activity

	  ADD (CONSTRAINT activity_ibfk_1
	  	   FOREIGN KEY (camp_ID)
	 	   REFERENCES camp (camp_ID) )");


/*
-- Constraints for table camp
*/

mysqli_query($link, "ALTER TABLE camp

	  ADD (CONSTRAINT camp_ibfk_1
	       FOREIGN KEY (park_ID)
	       REFERENCES park (park_ID) )");



/*
-- Constraints for table trail
*/

mysqli_query($link, "ALTER TABLE trail

	  ADD (CONSTRAINT trail_ibfk_1
	       FOREIGN KEY (park_ID)
	       REFERENCES park (park_ID) )");
/*echo "data inserted";*/

/*echo "done loading!";*/


header ('Location:home.html');

?>
<input id="shiny" type="submit" value=" LOADING... " />
</body>
</html>
