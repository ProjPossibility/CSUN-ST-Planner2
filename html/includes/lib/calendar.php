<?php

function getClassCalendarID() {
	if (isset($_SESSION['calendar_id'])) {
		return $_SESSION['calendar_id'];
	} else {
		return "uhqfb67gk3di9696tht4rrshug@group.calendar.google.com";
	}
}


?>