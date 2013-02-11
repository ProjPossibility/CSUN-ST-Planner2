		<footer>
		<?php
		if (isset($client) && method_exists($client,"getAccessToken") && $client->getAccessToken())  { ?>
			<a href="?logout=true">Logout</a>
		<?php
			} else {
				if (isset($_SESSION['token'])) {
					$client->setAccessToken($_SESSION['token']);
				}	
				$client = new Google_Client();
				$authUrl = $client->createAuthUrl();
				//print "<a class='login' href='$authUrl'>Connect Me!</a>";
			} ?>
		</footer>
		
		</div>

    </body>

</html>