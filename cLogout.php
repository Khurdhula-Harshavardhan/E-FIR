<?php
session_start();

echo '<div class = "msg34" >'."<font color = 'green'>"."you have successfully logged out! : ".$_SESSION['cUSER'].'</font></div>';
session_unset();

session_cache_expire();

session_destroy();

header("refresh:3;url=dashboard.html");

?>

<style>
		body{
			background-color: black;
		}
    .msg34 {
		border:1px solid #bbb;
		padding:5px; 
		margin-left: 35%;
		margin-right: 65%;
		background:#eee;
		position : fixed;
		top : 280px;
		height : 60px;
		width : 400px;
		padding-top : 35px;
		text-align : center;
		}
</style>
