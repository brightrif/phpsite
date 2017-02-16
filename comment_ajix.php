<?php
include 'include/connection.php';
if($_POST)
{
$name=$_POST['name'];
$name=mysql_real_escape_string($name);
$email=$_POST['email'];
$email=mysql_real_escape_string($email);
$comment=$_POST['comment'];
$comment=mysql_real_escape_string($comment);
$post_id=$_POST['post_id'];
$post_id=mysql_real_escape_string($post_id);
$lowercase = strtolower($email);
$image = md5( $lowercase );
mysqli_query($conn,"INSERT INTO post_comment (postID,cname,cemail,ccomment,cdate,approval) VALUES ('$postID', '$cname', '$cemail','$comment', CURRENT_TIMESTAMP,0)')");
}

?>

<li class="box">
<img src="http://www.gravatar.com/avatar.php?gravatar_id=
<?php echo $image; ?>"/>
<?php echo $name;?><br />
<?php echo $comment; ?>
</li>
