<?php
	
	require 'inc/defs.php';
	
	User::logout();
	header("Location: ".URL_LOGIN);
