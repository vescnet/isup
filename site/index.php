<?php
function Visit ( $url ) {
	$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
	
	curl_setopt ($ch, CURLOPT_URL,$url );
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch,CURLOPT_VERBOSE,false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$page=curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	if($httpcode>=200 && $httpcode<400) return true;
	
	else return false;
}
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
		<script>
			function formSubmit() {
      				domain = document.getElementById('site').value;
      				window.location = '/' + domain;
      				
				return false;
    			}
		</script>
		<script>
  			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  			ga('create', 'UA-3179958-4', 'vescnet.com.br');
  			ga('send', 'pageview');
		</script>
	</head>
	<body>
		<?php if ( empty($_GET["site"]) ) { ?>
			<div align="center">
				<form action="" method="get" ">
					O site<br> 
					<input id="site" name="site" placeholder="google.com"><br>
					esta fora<br>
					para<br>
					todo mundo<br>
					ou<br>
					apenas para mim?<br>
					<input type="submit" style="display: none;"/>
				</form>
			</div>
		<?php } else { 
		      	if ( Visit($_GET["site"]) ) {
				echo "Esta fora apenas para voce!";
			} else {
				echo "Esta fora para todo mundo!";
			}
			
			echo "<br><br>";

			echo "Faca uma nova pesquisa <a href='http://estanoar.vescnet.com.br/'>aqui</a>";
		      }
		?>
	</body>
</html>
