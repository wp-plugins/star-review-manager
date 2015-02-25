<?php
class ReviewContainer {

  public function __construct($id = 'NO_ID') { 
    $this->id = '';
	$this->title = '';
	$this->reviewlimit = 10;
	$this->anonymous = true;
	$this->mailnotification = '';
  }
  
  public function get_reviewcontainers(){
    global $wpdb;
    $container = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWCONTAINER);
	if(empty($container)) return '';
    return stripslashes_deep($container);
  }
  
  public function get_reviewcontainer($id){
    global $wpdb;
    $container = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWCONTAINER.' WHERE id='.$id.' LIMIT 1', ARRAY_A)[0];
    if(empty($container)) return '';
	return stripslashes_deep($container);
  }
  
  public function get_ratingcategories($id){
    global $wpdb;
    $categories = $wpdb->get_results('SELECT ratingcategory FROM '.SRM_DB_CONTAINERRATING.' WHERE container_id='.$id.' ORDER BY ratingpos', ARRAY_A);
    if(empty($categories)) return '';
	return stripslashes_deep($categories);
  }

  public function update($container){
    global $wpdb;
    $wpdb->update(SRM_DB_REVIEWCONTAINER, $container, array('id'=>$menu['id'])); 
  }

  public function create($container){
    global $wpdb;
    $wpdb->insert(SRM_DB_REVIEWCONTAINER, $container); 
    return $wpdb->insert_id;
  }
  
  public function get_size($container_id, $status = 1) {
	 global $wpdb;
	 return $wpdb->get_var("SELECT COUNT(*) AS count FROM ".SRM_DB_REVIEWS." WHERE container_id=".$container_id." AND status=".$status); 
  }
  
  /* create different container ratings, mostly used for this instance */
  public function create_rating_categories($container_id, $categories) {
	global $wpdb;
	$pos = 0;
	foreach($categories as $category) {
		$containerrating = array(
			"container_id" => $container_id,
			"ratingcategory" => $category,
			"ratingpos" => $pos
		);
		$wpdb->insert(SRM_DB_CONTAINERRATING, $containerrating); 
		$pos ++;
	}
  }
  
  /* delete reviewcontainer and related reviews */
  public function delete($id){
    global $wpdb;
    if(empty($id)) return '';
	$wpdb->query('DELETE FROM '.SRM_DB_CONTAINERRATING.' WHERE container_id='.$id); 
	$wpdb->query('DELETE FROM '.SRM_DB_RATING.' WHERE container_id='.$id); 
	$wpdb->query('DELETE FROM '.SRM_DB_REVIEWS.' WHERE container_id='.$id); 
	$wpdb->query('DELETE FROM '.SRM_DB_REVIEWCONTAINER.' WHERE id='.$id); 
  }
}
?>
