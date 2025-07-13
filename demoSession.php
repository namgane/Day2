<?php 
// Create session PHP if not 
if (session_id() === '') 
session_start(); 
if( isset( $_SESSION['counter'] ) ) { 
// cout the number of visits 
$_SESSION['counter'] += 1; 
} else { 
// The first visit 
$_SESSION['counter'] = 1; 
} 
$msg = "<p>You are visit ".  $_SESSION['counter'] . ' times.</p>'; 
echo $msg; 
?>