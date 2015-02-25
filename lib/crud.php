<?php
	if( !empty($_POST) && !empty($_POST['crud'])) {
	  if($_POST['crud']['review']) {
		  /* reviews without id but container id */
		  if( empty($_POST['crud']['id']) && !empty ($_POST['crud']['action']) && !empty ($_POST['crud']['container_id'])) {
			if($_POST['crud']['action'] == 'create'){
				/* create user */
				$user_id = null;
				if( !empty ($_POST['crud']['firstname']) && !empty ($_POST['crud']['lastname']) ) {
					$user = new User();
					$user->firstname = $_POST['crud']['firstname'];
					$user->lastname = $_POST['crud']['lastname'];
					$user_id = User::create((array) $user);
				}
				/* create review */
				$review = new Review();
				$review->container_id = $_POST['crud']['container_id'];
				if($user_id) $review->user_id = $user_id;
				if(!empty($_POST['crud']['message'])) $review->message = $_POST['crud']['message'];
				$review_id = Review::create((array) $review);
				if(!empty($_POST['crud']['rating'])) {
					$ratingcategories = $_POST['crud']['rating'];
					Review::create_review_ratings($review_id, $review->container_id, $ratingcategories);
				}
			}
		  /* reviews with id */
		  } else if( !empty($_POST['crud']['id']) && $_POST['crud']['action'] && $_POST['crud']['container_id']) {
			if($_POST['crud']['action'] == 'approve'){
			  Review::approve($_POST['crud']['id']);
			  wp_redirect(admin_url()."admin.php?page=manage_reviews&container_id=".$_POST['crud']['container_id']);
			  exit();
			}
			
			if($_POST['crud']['action'] == 'delete'){
			  Review::delete($_POST['crud']['id']);
			  wp_redirect(admin_url()."admin.php?page=manage_reviews&container_id=".$_POST['crud']['container_id']);
			  exit();
			}
		  }
		} else if($_POST['crud']['reviewcontainer']) {
			if($_POST['crud']['action'] == 'delete'){
			  ReviewContainer::delete($_POST['crud']['id']);
			  wp_redirect(admin_url()."admin.php?page=manage_reviewcontainers");
			  exit();
			}
		}
	}
?>