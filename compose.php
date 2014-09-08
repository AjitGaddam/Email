<? require('auth.php'); ?>
<?
 if(isset($_POST['to'])) {
  imap_mail($_POST['to'], $_POST['subject'], $_POST['body'], '', '', '', $user.'@fit.edu');
  die("Mail sent!");
 }
 
 $to = '';
 $subject = '';
 $body = '';
 
 if( isset($_GET['reply']) ) {
  $uid = $_GET['reply'];
  $conn = imap_open ("{mailhost.fit.edu}INBOX", $user, $pass);
  $header = imap_headerinfo($conn,imap_msgno($conn, $uid));
  $struct = imap_fetchstructure($conn, $uid, FT_UID);
 
  $content = '';
  if (!isset($struct->parts))
   $content = imap_body($conn, $uid, FT_UID);
  else
   for($i=1; $i<=count($struct->parts); $i++)
    $content .= imap_fetchbody($conn, $uid, "$i", FT_UID);

  $to = $header->fromaddress;
  $subject = "RE: $header->Subject";
  $lines = explode("\n", $content);
  $body = "\n\n";
  foreach($lines as $line)
   $body .= ">> $line\n";

  imap_close($conn);
 }
?><head>
<? if(isset($_GET['reply'])) { ?>
<title>Reply to Email</title>
<? } else { ?>
<title>Compose New Mail</title>
<? } ?>
</head>
<body>
<center>
<form name="compose" method="POST">
<fieldset style="width:1%">
 <legend><small>Compose New Mail&nbsp;</small></legend>
  <table border="0" align="center">
    <tr> 
      <td width="9%">To:</td>
      <td width="91%"> 
        <input type="text" name="to" size="100" value="<?=$to?>">
      </td>
    </tr>
    <tr> 
      <td width="9%">Subject:</td>
      <td width="91%"> 
        <input type="text" name="subject" size="100" value="<?=$subject?>">
      </td>
    </tr>
    <tr> 
      <td width="9%">&nbsp;</td>
      <td width="91%">&nbsp;</td>
    </tr>
    <tr> 
      <td valign=top width="9%">Body:</td>
      <td width="91%"><textarea name="body" cols="75" rows="20"><?=$body?></textarea></td>
    </tr>
    <tr> 
	  <td align="right" colspan="2"><input type='submit' value="Send"></td>	
    </tr>
  </table>
 </fieldset>
 <br>
 <br>[&nbsp;<a href="index.php">Inbox</a>&nbsp;]&nbsp;[&nbsp;<a href="logout.php">Logout</a>&nbsp;]</center>
</form>
</body>
</html>
