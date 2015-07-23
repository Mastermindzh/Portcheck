<!DOCTYPE HTML>
<html>
<head>
	<title>Async portcheck</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<style>
		table{
			border-collapse:collapse;
		}
		td,th{
			padding: 5px;
			border: 1px solid #DADADA;
		}
		.first{
			background: #4A4A4A;
			color:white;
		}
		.first th{
			padding: 5px;
			border: none;
		}
		#error h2{
			font-weight:bold;
			color: #8C0000;
		}
	</style>
	<script>
	var requests = new Array();    
		function run(){
			
			requests = new Array();
				/* 
					I opted for three arrays to keep it simple.
					Due to this you HAVE to make sure the first item in all arrays belong together.
					This is also true for the 2nd and 3rd and so on.
				*/
				//urls to check
				var hosts = new Array(
					'mi-soft.nl',
					'google.nl',
					'server.mi-soft.nl'
				);//ports to check
				var ports = new Array(
					'80',
					'80',
					'80'
				);//where to put the response
				var containers = new Array(
					'misoft',
					'google',
					'server'
				);//run through it
				for(i=0;i<hosts.length;i++){
					requests.push(new ProcessUrl(hosts[i],ports[i], containers[i]));  
				} 
		}	
	
		function ProcessUrl(host, port, container){
			var str = "checkport.php?server="+host+"&port="+port;;
			var http = new XMLHttpRequest();
			http.open("GET", str, true);
			http.onreadystatechange = function(){
				if (http.readyState == 4 && http.status == 200){
					document.getElementById(container).innerHTML=http.responseText;  
				}
			};
			http.send(null);                      
		}
	</script>
</head>

<body>
	<!-- 
		This is example markup, you can change this however you want.
		Just make sure to give the block you want the response to end up in an unique id.
	-->
	<table>
		<tr class = "first">
			<th>Server</th>
			<th>Poort</th>
			<th>Status</th>
		</tr>
		<tr>
			<th colspan = "3">
			Web servers
			</th>
		</tr>
		<tr>
			<td>Mi-soft.nl</td>
			<td>80</td>
			<td id = "misoft">pending</td>
		</tr>
		<tr>
			<td>google.nl</td>
			<td>80</td>
			<td id = "google">pending</td>
		</tr>
		<tr>
			<td>server.mi-soft.nl</td>
			<td>80</td>
			<td id = "server">pending</td>
		</tr>
	</table>
	<script>
		run();
		window.setInterval(function(){
			run();
		}, 10000);//refresh time in ms
    </script>
</body>

</html>
