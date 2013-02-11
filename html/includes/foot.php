		<footer>
		<?php
		if (isset($client) && method_exists($client,"getAccessToken") && $client->getAccessToken())  { ?>
			<a href="?logout=true">Logout</a>
		<?php
			}?>
		</footer>
		
		</div>

    </body>

</html>