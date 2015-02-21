<?php
	
	if(isset($_GET['container_id'])) {
		$container_id = $_GET['container_id'];
		$pending_reviews = Review::get_reviews_by_container($container_id, 0);
		$active_reviews = Review::get_reviews_by_container($container_id, 1);
	}
?>

<div class="wrap">
	<?php if(SRM_FREE) { showDonate(); }; ?><br><br>
	 <a class="button" href="<?php echo admin_url()."admin.php?page=manage_reviewcontainers"; ?>"/><?php _e('Back to review instances overview', 'star-review-manager'); ?></a>
	<h2 style="color: red;">Pending reviews</h2>
	<table class="table">
		<thead>
			<tr>
				<th><?php _e('ID', 'star-review-manager'); ?></th>
				<th><?php _e('Message', 'star-review-manager'); ?></th>
				<th><?php _e('Rating', 'star-review-manager'); ?></th>
				<th><?php _e('Created', 'star-review-manager'); ?></th>
				<th><?php _e('User', 'star-review-manager'); ?></th>
				<th><?php _e('Delete', 'star-review-manager'); ?></th>
				<th><?php _e('Approve', 'star-review-manager'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($pending_reviews as $review) {
					if($review->status == 0) {?>
					<tr>
						<td><?php echo $review->id; ?></td>
						<td><?php echo $review->message; ?></td>
						<td><?php echo $review->rating; ?></td>
						<td><?php echo date('F d, Y h:mA', strtotime($review->created)); ?></td>
						<td>
						<?php 	if($review->user_id != NULL) {
									$user = User::get_user($review->user_id);
									if($user) { 
										echo $user['firstname'] . ' ' . $user['lastname'];
									} else {
										_e('Anonymous', 'star-review-manager');
									}
								}?>
						</td>
						<td>
							<form method="post" action="#">
								<input type="hidden" name="crud[id]" value="<?php echo $review->id;?>" />
								<input type="hidden" name="crud[container_id]" value="<?php echo $container_id;?>" />
								<input type="hidden" name="crud[action]" value="delete" />
								<input class="button" type="submit" name="crud[review]" value="<?php _e('Delete', 'star-review-manager'); ?>" />
							 </form>
						 </td>
						<td>
							<form method="post" action="#">
								<input type="hidden" name="crud[id]" value="<?php echo $review->id;?>" />
								<input type="hidden" name="crud[container_id]" value="<?php echo $container_id;?>" />
								<input type="hidden" name="crud[action]" value="approve" />
								<input class="button" type="submit" name="crud[review]" value="<?php _e('Approve', 'star-review-manager'); ?>" />
							 </form>
						 </td>
					</tr>
				<?php
					}
				}?>
		</tbody>
	 </table>
	 
	 <h2 style="color: green;">Active reviews</h2>
	<table class="table">
		<thead>
			<tr>
				<th><?php _e('ID', 'star-review-manager'); ?></th>
				<th><?php _e('Message', 'star-review-manager'); ?></th>
				<th><?php _e('Rating', 'star-review-manager'); ?></th>
				<th><?php _e('Created', 'star-review-manager'); ?></th>
				<th><?php _e('User', 'star-review-manager'); ?></th>
				<th><?php _e('Delete', 'star-review-manager'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($active_reviews as $review) {
					if($review->status && $review->status == 1) {?>
					<tr>
						<td><?php echo $review->id; ?></td>
						<td><?php echo $review->message; ?></td>
						<td><?php echo $review->rating; ?></td>
						<td><?php echo gmdate("d M Y H:i", strtotime($review->created)); ?></td>
						<td>
						<?php 	if($review->user_id != NULL) {
									$user = User::get_user($review->user_id);
									if($user) { 
										echo $user['firstname'] . ' ' . $user['lastname'];
									} else {
										_e('Anonymous', 'star-review-manager');
									}
								}?>
						</td>
						<td>
							<form method="post" action="#">
								<input type="hidden" name="crud[id]" value="<?php echo $review->id;?>" />
								<input type="hidden" name="crud[container_id]" value="<?php echo $container_id;?>" />
								<input type="hidden" name="crud[action]" value="delete" />
								<input class="button" type="submit" name="crud[review]" value="<?php _e('Delete', 'star-review-manager'); ?>" />
							 </form>
						 </td>
					</tr>
				<?php
					}
				}?>
		</tbody>
	 </table>
</div>