<?php
$path="../../";
require($path."server/server.php");
require($path."client/library/functions.php");
require($path."client/library/includes/protected_header.php");
$user="administrator";
if ($user!="administrator")
{
	message("The page you are trying to access requires administrator rights. Please login as administrator in order to proceed.");
}

if ($user_add)
{
	if (!$name or !$username or !$password or !$cpassword)
	{
			message("All fields are required. Please try again", "client/library/includes/user_list.php");
	}

	if ($password!=$cpassword)
	{
			message("The passwords do not match. Please try again.", "client/library/includes/user_list.php");
	}
	$result=add_user($name, $username, $password);
	if ($result==1)
	{
		message("User $name added successfully.", "client/library/includes/user_list.php");
	}
	else
	{
		message("Could not add user $name.", "client/library/includes/user_list.php");
	}
}
if ($delete=1)
{
	if (!$username)
	{
			message("All fields are required. Please try again", "client/library/includes/user_list.php");
	}
	$result=delete_user($username);
	if ($result==1)
	{
		message("User $username deleted successfully.", "client/library/includes/user_list.php");
	}
	else
	{
		message("Could not delete user $username.", "client/library/includes/user_list.php");
	}
}

message("", "client/library/includes/user_list.php");
?>
