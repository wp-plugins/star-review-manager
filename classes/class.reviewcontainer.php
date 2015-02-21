<?php
class ReviewContainer {

  public function __construct($id = 'NO_ID') { 
    $this->id = '';
	$this->title = '';
	$this->reviewlimit = 10;
	$this->anonymous = true;
  }
  
  public function get_reviewcontainers(){
    global $wpdb;
    $reviews = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWCONTAINER);
    return stripslashes_deep($reviews);
  }
  
  private function get_reviewcontainer($id){
    global $wpdb;
    $container = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWCONTAINER.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A)[0];
    if(empty($container)) return '';
	
	$this->id = $container['id'];
	$this->title = $container['title'];
	$this->reviewlimit = $container['reviewlimit'];
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
  
  /* delete reviewcontainer and related reviews */
  public function delete($id){
    global $wpdb;
    if(empty($id)) return '';
	$wpdb->query('DELETE FROM '.SRM_DB_REVIEWCONTAINER.' WHERE id='.$id); 
	$wpdb->query('DELETE FROM '.SRM_DB_REVIEWS.' WHERE container_id='.$id); 
  }
}
?>
