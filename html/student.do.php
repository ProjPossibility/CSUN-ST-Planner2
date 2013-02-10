<?
$prefix = ".";

require_once($prefix."/includes/vars.php");

/*----------------------------------
	GET POST VARIABLES
----------------------------------*/
$data['id'] = "got from post";

$errors[][] = "errors";

if(isset($errors)) {
	include('student.php');
	die();
}


/*----------------------------------
	PROCESS PAGE
----------------------------------*/
//-- Pretend everything went well 
$success = true;



/*----------------------------------
	FINALIZE
----------------------------------*/
if ($success == true) {
     header( 'Location:student.php?id='.$data['id']."&success_msg={$success_msg}"); 
     die();
} else {
	$errors['form'][] = "Error on form";
	include('student.php');
	die();
}

?>