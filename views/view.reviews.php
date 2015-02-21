<?php
	
		
	function get_rating($amount) {
		$output = '';
		for($i = 0; $i <= $amount; $i++) {
			$output .= '<span></span>'; 
		}
		return $output;
	}
	
	/* output for reviews. */
	function get_reviews_html($atts) {
		global $wpdb;
		$container_id = $atts['id'];
		$option_type = 'bullets';
		if(empty($atts['id']) || !is_numeric($atts['id']) ) return '';
		if(!empty($atts['option_type'])) $option_type = $atts['option_type']; //set optiontype if specified. 
		$output = '';
		$reviews = Review::get_reviews_by_container($container_id);
		$output = '<!-- '.__("automatically generated review output", "star-review-manager").' -->';
		$output .= '<!-- '.__("a plugin by Bram Dekker", "star-review-manager"). '-->';
		foreach($reviews as $review) {
			$output .= '<div class="srm-review">';
			$output .= '<div class="srm-grouping">';
			$output .= '<div>'.$review->message.'</div>';
			$output .= '</div>';
			$output .= '<div class="srm-grouping">';
			$output .= '<div class="srm-'. $option_type .'-rating">' . get_rating($review->rating) . '</div>';
			$output .= '</div>';
			$output .= '<div class="srm-grouping">';
			if($review->user_id != NULL && User::get_user($review->user_id)) {
				$user = User::get_user($review->user_id);
				if($user) { 
					$output .= '<span><i>'.__("created by ", "star-review-manager"). $user['firstname'] . ' ' . $user['lastname'].'</i></span>';
				}
			} else {
				$output .= '<span><i>'.__("created by Anonymous", "star-review-manager").'</i></span>';
			}
			$output .= '<span><i> '.__(" at ", "star-review-manager"). gmdate("d M Y H:i", strtotime($review->created)) .'</i></span>';
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
	}

?>