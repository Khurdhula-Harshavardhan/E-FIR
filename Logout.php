<?php
session_start();


echo '<div class = "msg3" >'."<font color = 'green'>"."you have successfully logged out! : ".$_SESSION['USER'].'</font></div>';

session_unset();

session_cache_expire();

session_destroy();

header("refresh:3;dashboard.html");

?>

<style>
		body{
			background-color: black;
		}
    .msg3 {
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


<!--<script language="javascript" type="text/javascript">
<input type="hidden" id="refresh" value="no">


$(document).ready(function(e){
var $input = $('refresh');
$input.val()== 'yes' ? location.reload(true) : input.val('yes');
});
</script>-->
