<?php
//making a pdf for a crminal..


//call the vendor..

require_once __DIR__ . '/vendor/autoload.php';

//input parameter for search...Using session variable...


//set database connect parameters..
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";


//try and establish a connection with the database....
$conn = mysqli_connect($servername, $username, $password, $dbname);


//now check if the connection has been established succesfully....
if(!$conn)
{
	echo 'Failed attempt* to connect to Server';
}

else{
//functional code if the connection is successfully established with the database...


//query for selecting the record of the criminal...
$query="SELECT FROM CriminalRecord WHERE ";


//now execute the above query...
$result=mysqli_query($conn,$query);

//now check if the result is true or false , if its false it implicates that there are no records of that particular search query.

if(!$result)
{
	//if the query fails as there are no records for the search made..
	echo "Sorry, there are no records for the search : ".//searchparameter//;
	
	//now redirect the user back to the hompage..
	header("refresh:3;url=hompage.html");
}	
else
{
	//functional code if the query is excuted and there is a record that is present.
	//fetch all the details related to the crime and display first then goahead - give them the option to view and download the fir at will....
}