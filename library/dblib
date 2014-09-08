<?php
//this file contains the wrapper functions for the database connection

$path="../../";
require($path."server/library/configuration.php");

function db_connect($host, $dbname, $user, $password)
{
	$conn = mysql_connect($host, $user, $password);
	$db = mysql_select_db($dbname, $conn);
	if ($db && $conn)
	{
		return $conn;
	}	
	else
	{
		return false;
	}


}
//$conn=db_connect($host, $dbname, $user, $password);

if (!($conn = db_connect($host, $dbname, $dbuser, $dbpass))) 
{ 
   	$error= "Hello webmaster.\n\nUnable to connect to the database. Following variable values used\n\n host=$host dbname=$dbname user=$dbuser password=$dbpass";
	@mail(webmaster, "Unable to connect to database", $error, "From: <webadmin>");
	echo("Unable to connect to database. Sorry for the inconvinience. The webmaster has been informed");
}

//db_query("select * from email_users", $conn);

function db_query($sql, $fatal=true)
{
	global $user;
	global $conn;
	$status=mysql_query($sql, $conn);
	if (!$status AND $fatal)
	{
		$error= "Hello webmaster.\n\nUnable to execute the following sql query. \n $sql by $user";
		@mail(webmaster, "Unable to execute db_query", $error, "From: <webadmin>");
//		echo("Unable to execute the required query. The webmaster has been informed.");
	}
	return $status;
	
}   

function db_numrows($result)
{
 	$status=@mysql_num_rows($result);
//	echo "no. of rows $status";
	if (!isset($status))
	{
		$error= "Hello webmaster.\n\nUnable to execute db_numrows. Following is the resource id \n $result";
		@mail(webmaster, "Unable to execute db_numrows", $error, "From: <webadmin@temp.edu>");
		//message("Unable to execute pg_numrows. The webmaster has been informed.");
	}
	else
	{
		return $status;
	}
}   
function db_fetch_row($result)
{
 	$status=mysql_fetch_row($result);
	if (!$status)
	{
		$error= "Hello webmaster.\n\nUnable to execute pg_fetch_row. Following is the resource id and row number \n $result \n $row";
		@mail(webmaster, "Unable to execute pg_fetch_row", $error, "From: <webadmin@temp.edu>");
	//	message("Unable to execute pg_fetch_row. The webmaster has been informed.");
	}
	else
	{
		return $status;
	}
}
function db_affected_rows()
{
	global $conn;
 	$status=mysql_affected_rows($conn	);
	if (!isset($status))
	{
		$error= "Hello webmaster.\n\nUnable to execute pg_affected_rows. Following is the resource id \n $result";
		@mail(webmaster, "Unable to execute pg_affected_row", $error, "From: <webadmin@temp.edu>");
	//	message("Unable to execute pg_affected_rows. The webmaster has been informed.");
	}
	else
	{
		return $status;
	}
}   

?>
