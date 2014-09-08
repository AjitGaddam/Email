<? require('auth.php'); ?>
<?
 $uid = $_GET['message'];
 $start = $_GET['start'];
 $count = $_GET['count'];

 $conn = imap_open ("{mailhost.x.edu}INBOX", $user, $pass); 

 imap_delete($conn, $uid, FT_UID);
 imap_expunge($conn);
 imap_close($conn);

 header("Location: index.php?start=$start&count=$count");
?>
