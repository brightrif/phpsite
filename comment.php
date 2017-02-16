<?php //include config
 //   require_once('../includes/config.php');
   include 'includes/connection.php';
    //if not logged in redirect to login page
    //if(!$user->is_logged_in()){ header('Location: login.php'); }
?>




<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Comment</title>
        <link rel="stylesheet" href="../style/normalize.css">
        <link rel="stylesheet" href="../style/main.css">
    </head>
    <body>

    <div id="wrapper">

        
        <?php
        
            if(isset($_POST['submit'])){
                
                $cname = trim($_POST['username']);
                $cemail = trim($_POST['email']);
                $comment = trim($_POST['comment']);
                
                if($cname ==''){
                    
                    $error[] = 'Please enter the Name.';
		}

		if($cemail ==''){
                    
                    $error[] = 'Please enter your email.';
		}

		if($comment ==''){
                    
                    $error[] = 'Please enter your comment.';
		}
                
                if(!isset($error)){
                    
                    $sql = "INSERT INTO post_comment (postID,cname,cemail,ccomment,cdate,approval) VALUES ('$postID', '$cname', '$cemail','$comment', CURRENT_TIMESTAMP,0)";
                    mysqli_query($conn, $sql);
                }
            }
        
            	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
               
        ?>
        
        <form action='' method='post'>

            <p><label>Name</label><br />
            <input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

            <p><label>Email</label><br />
            <input type='text' name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>
            
            <p><label>Comment</label><br />
                <textarea name="comment"rows="10"cols="50" value="<?php if(isset($error)){ echo $_POST['comment'];}?>"></textarea> </p>
            <!--<input type='text' name='email' value=''></p>-->

            <p><input type='submit' name='submit' value='submit'></p>

        </form>

    </div>