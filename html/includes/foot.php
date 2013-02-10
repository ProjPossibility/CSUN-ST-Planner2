		<footer>
		<?php
		if (isset($client) && method_exists($client,"getAccessToken") && $client->getAccessToken())  { ?>
			<a href="?logout=true">Logout</a>
		<?php
			} else {
				$client = new Google_Client();
				$authUrl = $client->createAuthUrl();
				print "<a class='login' href='$authUrl'>Connect Me!</a>";
			} ?>
		</footer>
		
		</div>

        <script src="http://code.jquery.com/jquery.js"></script>
  		<script src="js/bootstrap.min.js"></script>
    </body>

</html>