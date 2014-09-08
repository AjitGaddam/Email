<? require( dirname(__FILE__).'/auth.php' ); ?>
<?
 $startMsg = 1;
 if(isset($_GET['start']))
  $startMsg = $_GET['start'];
  
 $countMsg = 20;
 if(isset($_GET['count']))
  $countMsg = $_GET['count'];

 $conn = imap_open ("{mailhost.fit.edu}INBOX", $user, $pass);
 $inbox = imap_check($conn);
 
 $lastMsg = $startMsg + $countMsg < $inbox->Nmsgs ? $startMsg + $countMsg - 1 : $startMsg + ($inbox->Nmsgs - $startMsg)+1;

 $messages = Array();
 for($i=$startMsg; $i<$lastMsg; $i++)
  $messages[imap_uid($conn, $i)] = imap_headerinfo($conn, $i);

 imap_close($conn);
?>
<html>
<body>
<table width="900" border="0" cellpadding="1" cellspacing="0">
<tr>
 <td><h2><?=$user?>'s Inbox</h2></td>
 <td align="right" valign="top">[&nbsp;<a href="compose.php">Compose</a>&nbsp;]&nbsp;[&nbsp;<a href="logout.php">Logout</a>&nbsp;]</td>
</tr>
<tr>
 <td>You have <?=$inbox->Nmsgs?> messages in your inbox <small>(Showing <?=$startMsg?> to <?=$lastMsg?>)</small></td>
 <td align="right">
<?
 for($i=0; $i<=floor($inbox->Nmsgs / $countMsg); $i++) {
  if( $i != floor( $startMsg / $countMsg ) ) {
   ?><a href="index.php?start=<?=($i * $countMsg)+1?>&count=<?=$countMsg?>"><?=$i+1?></a>&nbsp;<?
  } else {
   echo '<b>'.($i+1).'</b>&nbsp;';
  }
 }
?>
 </td>
</tr>
</table>
<br>
<table width="900" border="0" cellpadding="1" cellspacing="0" style="border: 1px solid black">
  <tr bgcolor="blue" style="color: white;">
    <td width="20%"><b>From:</b></td>
    <td width="36%"><b>Subject:</b></td>
    <td width="18%"><b>Received:</b></td>
    <td width="11%"><b>Delete:</b></td>
    <td width="10%"><b>Reply:</b></td>
  </tr>
<? foreach($messages as $uid => $msg) { $bgcolor = ($msg->Unseen == 'U' || $msg->Recent == 'N' ? 'lightgrey' : 'white'); ?>
  <tr> 
    <td bgcolor="<?=$bgcolor?>" width="20%"><?=isset($msg->from[0]->personal) ? $msg->from[0]->personal : $msg->from[0]->mailbox.'@'.$msg->from[0]->host?></td>
    <td bgcolor="<?=$bgcolor?>" width="36%"><a href="read.php?start=<?=$startMsg?>&count=<?=$countMsg?>&message=<?=$uid?>"><?=$msg->Subject?></a></td>
    <td bgcolor="<?=$bgcolor?>" width="18%"><?=date('m/d h:i:s A', $msg->udate)?></td>
    <td bgcolor="<?=$bgcolor?>" width="11%"><a href="delete.php?start=<?=$startMsg?>&count=<?=$countMsg?>&message=<?=$uid?>">Delete</a></td>
    <td bgcolor="<?=$bgcolor?>" width="10%"><a href="compose.php?reply=<?=$uid?>">Reply</a></td>
  </tr>
<? } ?>
</table>
</body>
</html>
