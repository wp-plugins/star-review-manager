<?php
class Review {

  public function __construct($id = 'NO_ID') { 
    $this->id = '';
	$this->container_id = '';
	$this->user_id = NULL;
	$this->message = '';
	$this->rating = 0;
	//$this->created = '';
	$this->status = 0;
  }
  
  public function get_reviews(){
    global $wpdb;
    $reviews = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWS);
    return stripslashes_deep($reviews);
  }
  
  public function get_reviews_by_container($container_id, $status = 1) {
	global $wpdb;
    $reviews = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWS.' WHERE container_id = '.$container_id.' AND status='.$status);
    return stripslashes_deep($reviews);
  }

  public function update($review){
    global $wpdb;
    $wpdb->update(SRM_DB_REVIEWS, $review); 
  }

  public function create($review){
    global $wpdb;
    $wpdb->insert(SRM_DB_REVIEWS, $review); 
    return $wpdb->insert_id;
  }

  /* delete review by id */
  public function delete($id){
    global $wpdb;
    if(empty($id)) return '';
	$wpdb->query("DELETE FROM ".SRM_DB_REVIEWS." WHERE id=".$id); 
  }
  
  public function approve($id) {
	global $wpdb;
	if(empty($id)) return '';
	$wpdb->query("UPDATE ".SRM_DB_REVIEWS." SET status=1 WHERE id=".$id);
  }
}
?>
