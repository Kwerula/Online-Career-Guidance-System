<?php
$con=mysqli_connect("localhost","root","kwerula2015","chatloud");

$_GET['delid'] = strip_tags(@$_POST['commentid']);
$delres = mysqli_query($con, "DELETE FROM comments where commentid='$_GET[delid]'");
?>
<?php
include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>&nbsp;</h1>
      <p>
<table border="1">
<tr>
<th>Comment</th>
<th>Datetime</th>
<th>Status</th>

<th> action </th>
</tr>
<?php
$result = "";
$rs = "";
$rs['comment']  = "";
$rs['dattime'] = "";
$rs['status'] = "";
$rs['commentid'] = strip_tags(@$_POST['delid']);
$result = mysqli_query($con, "SELECT * FROM comments")or die(mysqli_error($con));

while($rs = mysqli_fetch_array($result))
{
echo "<tr>
<td> $rs[comment] </td>
<td> $rs[dattime] </td>
<td> $rs[status]  </td>
<td>
<a href='commentsview.php?delid=$rs[commentid]'>Delete</a></td>
</tr>";
}

?>
</table>
&nbsp;</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
