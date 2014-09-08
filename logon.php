<?
 if( isset($_POST['user']) && isset($_POST['pass']) )
 {
  $mbox = @imap_open('{mailhost.fit.edu}INBOX', $_POST['user'], $_POST['pass']);

  if($mbox) {
   setcookie("auth",serialize(Array($_POST['user'],$_POST['pass'])),time()+1800,"/",".fit.edu");
  }
  else {
   setcookie('auth','',-1,"/",".fit.edu");
  }
  
  header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
  exit();
 }

 if(isset($bad_pass) || isset($bad_user)) {
  setcookie('auth',null,-1,"/",".fit.edu");
 }
?>
<html>

<head>
 <title>Email Login</title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
 <form method="POST">
 <table width="100%" height="100%"><tr><td align="center" valign="center">

 <fieldset style="width:300px">
  <legend><small>Login to Email</small></legend>
  <table align=center>
  <tr>
   <td align=center width=50%>Username:</td>
   <td align=center width=50%>Password:</td>
  </tr>
  <tr>
   <td align=center width=50%><input type="text" name="user" width=25 maxlength=25></td>
   <td align=center width=50%><input type="password" name="pass" width=25></td>
  </tr>
  <tr><td class=news colspan=2 align=center><input type=submit value="Login"></td></tr>
  </table>
        <p>Forgot Password ---&gt; <a href="http://it.fit.edu/tracks/passwords.cfm">Click 
          Here</a> </p>
        <p>&nbsp;</p>
        </fieldset>

 </td></tr></table>
 </form>
</body>
</html>
<? die(); ?>
