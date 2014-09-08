<? require('auth.php'); ?>
<?
 $uid = $_GET['message'];
 $start = $_GET['start'];
 $count = $_GET['count'];

 $conn = imap_open ("{mailhost.fit.edu}INBOX", $user, $pass); 
 $header = imap_headerinfo($conn, imap_msgno($conn, $uid));
 $struct = imap_fetchstructure($conn, $uid, FT_UID);
 
 $content = '';
 if (!isset($struct->parts)) { /* Simple message, only 1 piece */
  $content = imap_body($conn, $uid, FT_UID);
  $content = "<pre>$content</pre>";
 } else { /* Complicated message, multiple parts */
  for($i=1; $i<=count($struct->parts); $i++) {
   $content .= imap_fetchbody($conn, $uid, "$i", FT_UID);
  }
  $content = str_replace('<br>', "\n", $content);
  $content = nl2br($content);
 } /* complicated message */

 imap_close($conn);
?>
<html>
<head><title><?=$header->Subject?></title></head>
<body>
<table width="100%" style="border: 1px solid black"><tr><td align="center">&nbsp;[&nbsp;<a href="index.php?start=<?=$start?>&count=<?=$count?>">Inbox</a>&nbsp;]&nbsp;[&nbsp;<a href="compose.php?reply=<?=$uid?>">Reply</a>&nbsp;]&nbsp;[&nbsp;<a href="delete.php?message=<?=$uid?>&start=<?=$start?>&count=<?=$count?>">Delete</a>&nbsp;]&nbsp;[&nbsp;<a href="logout.php">Logout</a>&nbsp;]</td></tr></table>
<?=$content?>
</body>
</html>
