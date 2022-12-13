<?php
session_start();
unset ($SESSION['username']); 
session_destroy();
//header('Location: http://localhost/academia2022/Index.html '); 
header('Location: login1.php');
?>
