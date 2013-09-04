<?php


function getLikeCount($blog_id) {
	$sql = "SELECT * FROM blog_like WHERE blog_id=" . $blog_id;
	$result = mysql_query($sql, LINK);
	
	return mysql_num_rows($result);
}

function hasUserLiked($blog_id, $user_id) {
	$sql = "SELECT * FROM blog_like WHERE blog_id=" . $blog_id . " AND user_id = " . $user_id;
	$result = mysql_query($sql, LINK);

	$count = mysql_num_rows($result);
	if($count > 0) {
		return true;
	}
	return false;
}

function hasUserLikedComment($blog_comment_id, $user_id) {
	$sql = "SELECT * FROM blog_comment_like WHERE blog_comment_id=" . $blog_comment_id . " AND user_id = " . $user_id;
	$result = mysql_query($sql, LINK);

	$count = mysql_num_rows($result);
	if($count > 0) {
		return true;
	}
	return false;
}

function getCommentCount($blog_id) {
	$sql = "SELECT * FROM blog_comment WHERE blog_id=" . $blog_id;
	$result = mysql_query($sql, LINK);
	
	return mysql_num_rows($result);
}

function getCommentLikeCount($blog_comment_id) {
	$sql = "SELECT * FROM blog_comment_like WHERE blog_comment_id=" . $blog_comment_id;
	$result = mysql_query($sql, LINK);

	return mysql_num_rows($result);
}


function getAllComments($blog_id, $user_id) {
	$sql = "SELECT bc.*, u.first_name FROM blog_comment bc " .
			" INNER JOIN users u ON u.user_id = bc.user_id" . 
			" WHERE bc.blog_id=" . $blog_id;
	$result = mysql_query($sql, LINK);
	
	$str = "";
	if(mysql_num_rows($result) > 0 ) {
		
		while($row = mysql_fetch_assoc($result)) {
			$blog_comment_id = $row["blog_comment_id"];
			$like_count = getCommentLikeCount($blog_comment_id);
			$str .="<p class='comment'>";
			$str .= "<b>" . $row["first_name"] . ": </b> " . $row["comment"] . "</br /> " . getDateTimeString($row["added_datetime"]) ;
			if (hasUserLikedComment($blog_comment_id, $user_id) ) {
				$str .= "<br /><a href='/home.php?blog_comment_id=" . $blog_comment_id . "&action=unlike' >Unlike</a>";
			} else {
				$str .= "<br /><a href='/home.php?blog_comment_id=" . $blog_comment_id . "&action=like' >Like</a>";
			}				
			$str .= '<img src="/images/like.png" class="icon" /> ' . $like_count;
			
			$str .= "</p>";
		}
	}
	return $str;
}

function getCommentForm($blog_id, $first_name) {
	$str = '<form action="" method="post">';
	$str .= '<div class="formInput">';
	$str .= '<b>' . $first_name . '</b><textarea name="comment_text" class="comment"  onkeyup="charLimit(160, this.value, \'blog_' . $blog_id .'\');" onkeydown="charLimit(160, this.value, \'blog_' . $blog_id .'\');""></textarea>';
	$str .= '<span class="text_small" id="blog_'. $blog_id  .'">160</span> <span class="text_small"> character left</span>';
	$str .= '</div>';
	$str .= '<div class="">';
	$str .= '<input type="submit" name="submit_comment" value="Add comment" />';
	$str .= '</div>';
	$str .= '<input type="hidden" name="blog_id" value=" ' . $blog_id . '" />';
	$str .= '<input type="hidden" name="action" value="add-comment" />';
	$str .= '</form>';
	
	return $str;
}



function getDateTimeString($datetime) {
	$datetime = explode(" ", $datetime);
	
	$time = substr($datetime[1], 0, 5);
	
	$date = new DateTime($datetime[0]);
	
	$date_today = new DateTime("now");
	$f_today = $date_today->format('Y-m-d');
	
	$date_yesterday = new DateTime("yesterday");
	$f_yesterday=$date_yesterday->format('Y-m-d');
	
	if($datetime[0] == $f_today) {
		return "Today " . $time;
	} 
	if ($datetime[0] == $f_yesterday) {
		return "Yesterday " . $time;
	}
	
	return $datetime[0] . " " . $time;
	
}

