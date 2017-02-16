<?php //include config
require_once('../includes/config.php');
include '../includes/connection.php';

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="./">Blog Admin Index</a></p>

	<h2>Edit Post</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){
            
                $postID = trim($_POST['id']);                           
                $postTitle =trim( $_POST['postTitle'])  ;
                $postDesc = trim($_POST['postDesc']);
                $postCont = trim($_POST['postCont']);
		//collect form data
		extract($_POST);

		//very basic validation
		if($postID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

                try {

                    $sql= "UPDATE blog_posts SET postTitle = '$postTitle', postDesc = '$postDesc', postCont = '$postCont' WHERE postID = '$postID'";
                    mysqli_query($conn, $sql);

                    //redirect to index page
                    header('Location: index.php?action=updated');
                    exit;

                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

                    
                    $postID = $_GET['id'];
                    $selsql= "SELECT postID, postTitle, postDesc, postCont FROM blog_posts WHERE postID = '$postID'";
                    $result = mysqli_query($conn, $selsql);
                    while( $row = mysqli_fetch_assoc($result)){
                        
                        $postTitle = $row['postTitle']  ;
                        $postDesc = $row['postDesc'];
                        $postCont = $row['postCont'];
                    }

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='postID' value='<?php echo $postID;?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $postTitle;?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $postDesc;?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $postCont;?></textarea></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html>	
