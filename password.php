<?php 
session_start();
?>
<html>
<body>
<form action="verify_pass.php" method="POST">
<?php echo "please enter the your password to confirm filing :".$_SESSION['USER']."<br>"; ?>
<input type="password" placeholder="password" name="pass">
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>

