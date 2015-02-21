<?php 
	if(isset($_POST['review_title'])) {
		$reviewcontainer = new ReviewContainer();
		$reviewcontainer->title = $_POST['review_title'];
		ReviewContainer::create((array)$reviewcontainer);
	}
?>

<div class="wrap">
	<a class="button" href="<?php echo admin_url()."admin.php?page=manage_reviewcontainers"; ?>"/><?php _e('Back to review instances overview', 'star-review-manager'); ?></a>
	<h2><?php _e('New Review instance', 'star-review-manager'); ?></h2>
	<form action="" method="post">
		<label for="review_title"><?php _e('Title', 'star-review-manager'); ?></label>
		<input id="review_title" type="text" name="review_title">
		<div class="clear"></div>
		<input value="Save" class="button" type="submit" />
	</form>
</div>