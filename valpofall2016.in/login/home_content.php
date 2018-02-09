<?php

$link = mysql_connect("localhost", "root", "");
mysql_select_db("netra", $link);

$result = mysql_query("HomeContent.php");

?>

<script type="text/javascript">
function checkData()
{
if(document.searchpp.heading.value=="")
{
alert('Heading Input should be filled');
document.searchpp.heading.focus();
return false;
}
if(document.searchpp.content.value=="")
{
alert('Please Write the content');
document.searchpp.content.focus();
return false;
}
return true;
}
</script>
<table width="980" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
  	<td width="125%" align="left" valign="top" bgcolor="#EEEEEE"><?php include('menu.php'); ?><table width="100%" border="0" cellspacing="2" cellpadding="5">
      <tr>
        <td width="50%" bgcolor="#CCCCCC" class="pad">
        <h2>Content for Home Page</h2>
        </td>
        </tr>
      <tr>
        <td width="50%" bgcolor="#FFFFFF" class="pad">
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'].'?id=send_content' ?>" name="searchpp">
          <table width="980" border="0" cellspacing="2" cellpadding="5">
            <tr>
              <td width="20%">Heading</td>
              <td>
              	<input type="text" name="heading" />
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="20%">Article</td>
              <td>
              	<textarea name="content" cols="50" rows="10"></textarea>
              </td>
              <td>&nbsp;</td>
            </tr>
              <td>&nbsp;</td>
              <td align="left">
                <input type="submit" name="Submit" id="button" value="Upload" onclick="return checkData();">              </td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </form>        </td>
        </tr>
        <tr>
        	<td>
            <table width="100%" cellpadding="5" cellspacing="5">
           
              
<?php

$link = mysql_connect("localhost", "root", "");
mysql_select_db("netra", $link);

$result = mysql_query("HomeContent.php");
?>

              <tr>
  				  <td colspan="5" align="center" height="30">&nbsp;</td>
  			  </tr>
            </table>
            
            </td>
        </tr>
    </table></td>
  </tr>
</table>

