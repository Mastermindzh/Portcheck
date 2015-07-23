<?php
    
    //This is the code that will be returned
    $online = '<img src="images/online.png" alt = ""/> Online';
	$offline = '<img src="images/offline.png" alt = "" /> Offline';
	
	//the port check
    $server=$_GET['server'];
    $port=$_GET['port'];
	$host = @fsockopen($server, $port, $errno, $errstr, 0.4);
	if ($host) {
		echo $online;
        $close = fclose($server);
	}
	else{
		echo $offline;
	}
	
?>
