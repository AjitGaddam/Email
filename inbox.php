<?php $no_of_emails=count($email_list); ?>
<h2><?=$user?>'s Inbox</h2>
<p>You have <?=$no_of_emails?> messages in your inbox</p>
<br>
<table width="75%" border="0" cellpadding="0" cellspacing="10">
  <tr> 
    <td width="20%">From:</td>
    <td width="36%">Subject</td>
    <td width="18%">Received</td>
    <td width="5%">New</td>
    <td width="11%">Delete</td>
    <td width="10%">Reply</td>
  </tr>

<?php

for ($x=1; $x<=$no_of_emails; $x++)
{
//echo $email_list[0][0];
//$time=strftime("%T",strtotime("12/28/2002"));

?>

  <tr> 
    <td width="20%"><?=$email_list[$x][1]?></td>
    <td width="36%"><a href="<?=$path?>client/public_html/viewemail.php?id=<?=$email_list[$x][0]?>"><?=$email_list[$x][2]?></a></td>
    <td width="18%"><?=$email_list[$x][3]?></td>
    <td width="5%"><?=$email_list[$x][4]?></td>
    <td width="11%"><a href="<?=$path?>client/public_html/index.php?id=<?=$email_list[$x][0]?>&delete=1">Delete</a></td>
    <td width="10%"><a href="<?=$path?>client/public_html/viewemail.php?id=<?=$email_list[$x][0]?>&reply=1">Reply</a></td>
  </tr>
<?php
}
?>

</table>

