<?php require('includes/config.php'); 

if( isset ($_GET['id'])){
    
    $postID = $_GET['id'];
    $sql = "SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = $postID";
    $result = mysqli_query($conn, $sql);
    
    if( mysqli_num_rows($result)> 0 ) {
    
    //select and store id for the post
    while ( $row = mysqli_fetch_assoc($result) ) {
        
        $ptitle= $row['postTitle'];
        $pdate= $row['postDate'];
        $pcont= $row['postCont'];
        
    }
    }else {
    header('Location: ./');
    }
    
//    $csql="SELECT Postcomment_id, postID, cname, cemail, ccomment, cdate, approval FROM post_comment where postID = $postID ";
//    $cresult = mysqli_query($conn, $csql);
//    if( mysqli_num_rows($cresult)> 0 ) {
//       
//        while ( $row = mysqli_fetch_assoc($cresult) ) {
//            
//                $cname= $row['cname'];
//                $ccomment= $row['ccomment'];
//                $cdate= $row['cdate'];
//            
//        }
//    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Blog</h1>
		<hr />
		<p><a href="./">Blog Index</a></p>


		<?php	
			echo '<div>';
				echo '<h1>'. $ptitle .'</h1>';
			//	echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                                echo '<p>Posted on '. $pdate .'</p>';
				echo '<p>'. $pcont .'</p>';				
			echo '</div>';
                        
//                        echo '<div>';
//                                echo $cname . "says";
//                                echo '<p>'. "posted at" .$cdate .'</p>';
//                                echo '<p>'. $ccomment .'</p>';
//                                
//                        echo '</div>';
                        include 'view_comment.php';
//                        echo '<h2>'. Commnet .'</h1>';
//                        include 'comment.php';
		?>

	</div>

</body>
</html>