<?PHP
    require("top.php");
    
    if(!isset($_SESSION["user_id"])) {
    	header( 'Location: ' . LOGIN_PAGE ) ;
    	exit;
    }
    
    $success_blog = "";
    $error_blog = "";
    $blog_text = "";
    

    if (isset($_REQUEST["blog_id"])) {
    	$blog_id = $_REQUEST["blog_id"];
		$action = $_REQUEST["action"];
		$user_id = $_SESSION["user_id"];
		 
		$sql = "";
		switch($action) {
			case 'like':
				$sql = "INSERT IGNORE INTO blog_like (`blog_id`, `user_id`, `added_datetime`) VALUES ($blog_id, $user_id, NOW())";
				break;
			case 'unlike':
				$sql = "DELETE FROM blog_like WHERE `blog_id`=$blog_id AND `user_id`=$user_id";
				break;
			case 'add-comment':
				$blog_comment = $_REQUEST["comment_text"];
				$sql = "INSERT INTO blog_comment (`blog_id`, `user_id`,`comment`, `added_datetime`) VALUES ($blog_id, $user_id, '$blog_comment', NOW())";
				break;
		}
		
		if($sql != "") {
			mysql_query($sql, LINK);
		}
		
    } else if (isset($_REQUEST["blog_comment_id"])) {
    	$blog_comment_id = $_REQUEST["blog_comment_id"];
		$action = $_REQUEST["action"];
		$user_id = $_SESSION["user_id"];
		 
		$sql = "";
		switch($action) {
			case 'like':
				$sql = "INSERT IGNORE INTO blog_comment_like (`blog_comment_id`, `user_id`, `added_datetime`) VALUES ($blog_comment_id, $user_id, NOW())";
				break;
			case 'unlike':
				$sql = "DELETE FROM blog_comment_like WHERE `blog_comment_id`=$blog_comment_id AND `user_id`=$user_id";
				break;
		}
		
		if($sql != "") {
			mysql_query($sql, LINK);
		}
		
    } else if(isset($_POST["form_name"]) && $_POST["form_name"] == 'add_blog') {
    	$blog_text = $_POST["add_blog"];
		$user_id = $_SESSION["user_id"];
    	
    	$sql = "INSERT INTO blog(`user_id`, `blog_text`, `status`,`added_datetime` ) " . 
    			"VALUES($user_id, '$blog_text', 1, NOW())";
    	$result = mysql_query($sql, LINK);
    	 
    	if(mysql_insert_id(LINK) > 0) {
    		$success_blog = "Your blog published successfully!";
    		$blog_text = "";
    	} else {
    		$error_blog = "Could not add your blog, please try again.";
    	}
    	 
    
    }
    
?>        
<div id="content">
	<div class="add_blog">
		<form action="" method="post" onsubmit="return validateStatusPost();">
		<p>What's in your mind? </p>
		<?php 
			if($error_blog != "") {
				echo "<p class='error'>$error_blog</p>";
			} else if($success_blog != "") {
				echo "<p class='success'>$success_blog</p>";
			}
		?>
		<div class="formInput"> 
			<textarea id="add_blog" name="add_blog" maxlength="160" class="textarea" onkeyup="charLimit(160, this.value, 'comment_char_left');" onkeydown="charLimit(160, this.value, 'comment_char_left');"><?php echo $blog_text;?></textarea>
			<span id="errAddBlog" class="errorMessage_LI">please enter your status</span>
			<span id="comment_char_left">160</span> character left
	   </div>
		
		<div class="">
			<input type="submit" id="submit_status" name="submit_status" value="Post" />
		</div>
		<input type="hidden" name="form_name" value="add_blog" />
		</form>
		<script>hideErrorsAddBlog();</script>
	</div>
	
	<?php 
		$sql = "SELECT b.*, u.first_name FROM blog b" .
    			" INNER JOIN users u on u.user_id = b.user_id" .
				" WHERE b.status = 1 ORDER BY b.added_datetime DESC";
		$result = mysql_query($sql, LINK);	
		
		if(mysql_num_rows($result) > 0) {
			while($row = mysql_fetch_assoc($result)) {
				
				$blog_id = $row["blog_id"];
				echo '<div class="display_blogs">';
				echo '<h4>' . $row["first_name"] . ', ' .   getDateTimeString($row["added_datetime"]) . '</h4>';
				echo '<p>' . $row["blog_text"] . '</p>';
				
				echo '<p>';
				
				$user_id = $_SESSION["user_id"];
				$like_count = getLikeCount($row["blog_id"]);
				if(hasUserLiked($row["blog_id"], $user_id)) {
					echo '<a href="/home.php?blog_id='. $blog_id . '&action=unlike"' . ' class="like">Unlike </a>';
				} else {
					echo '<a href="/home.php?blog_id='. $blog_id . '&action=like"' . ' class="like">Like</a>';
				}
				
				echo '<img src="/images/like.png" class="icon" /> ' . $like_count;
				
				$comment_count = getCommentCount($blog_id);
				echo '<img src="/images/comment.png" class="icon_comment" /> ' . $comment_count;
				echo '</p>';
				
				echo '<div class="comments">';
				echo getAllComments($blog_id, $user_id);
				echo getCommentForm($blog_id, $_SESSION["first_name"]);
				echo '</div>';
				
				echo '</div>';
			} 		
		}
		
	?>
	
</div>
	    
<?PHP
    require("bottom.php");
?>