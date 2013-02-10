		<footer>
		<?php
		if (method_exists($client,"getAccessToken") && $client->getAccessToken())  { ?>
			<a href="?logout=true">Logout</a>
		<?php } ?>
		</footer>
		
		</div>

        <script src="http://code.jquery.com/jquery.js"></script>
  		<script src="js/bootstrap.min.js"></script>
    </body>

</html>