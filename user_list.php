<?php 
require('../../../server/server.php');

$user_list = get_user_list();

if ($user_list==0)
{
	message("No users found in the database", "", $exit=0);
}
else
{
	$no_of_users=count($user_list);
?>
	<p><b>List of Users</b></p>
	<table border=1 width=50%>
		<tr>
			<td width="30%" >Name</td>
			<td width="30%" >Username</td>
			<td width="20%" >Edit</td>
			<td width="20%" >Delete</td>
		</tr>
<?php
	for ($x=1; $x<=$no_of_users; $x++)
	{
?>
		<tr>
			<td width="30%" ><?=$user_list[$x][1]?></td>
			<td width="30%" ><?=$user_list[$x][0]?></td>
			<td width="20%" ><a href=<?=$path?>client/public_html/users.php?edit=1&username=<?=$user_list[$x][0]?>>Edit</a></td>
			<td width="20%" ><a href=<?=$path?>client/public_html/users.php?delete=1&username=<?=$user_list[$x][0]?>>Delete</a></td>
		</tr>

<?php
	}
}
?>
</table>
<br>
<p><b>Add User:</b></p>
<form name="add_user" method="post" action="<?=$PHP_SELF?>">
  <table width="22%" border="0">
	<tr> 
      <td width="42%">Name:</td>
      <td width="58%"> 
        <input type="text" name="name">
      </td>
    </tr>
    <tr> 
      <td width="42%">Username:</td>
      <td width="58%"> 
        <input type="text" name="username">
      </td>
    </tr>
	<tr> 
      <td width="42%">Password:</td>
      <td width="58%"> 
        <input type="password" name="password">
      </td>
    </tr>
	<tr> 
      <td width="42%">Confirm Password:</td>
      <td width="58%"> 
        <input type="password" name="cpassword">
      </td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <center>
          <input type="submit" value="Submit" name="user_add">
          <input type="reset" value="Clear" name="clear">
        </center>
      </td>
    </tr>
    
  </table>
