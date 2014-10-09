<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {


  public function getPage($slug){

    $statement = $this->db->get_where('pages', array('slug' => $slug), 1);

    return $statement->row();


  }

  public function getNews($slug = FALSE)
  {
       if ($slug === FALSE) 
       {
       	$statement = $this->db->get('news');
       	return $statement->result();
       } 
       else 
       {
       	$statement = $this->db->get_where('news', array('slug' => $slug));
       	return $statement->row();
       }
   
  }

  public function getComments($slug)
  {
    $statement = $this->db->query("SELECT  `comments`.`comment`, `users`.`username`, `comments`. `posted_on`
                                    FROM news 
                                    INNER JOIN comments
                                    ON `news`. `id` = `comments`.`news_id`
                                    INNER JOIN users
                                    ON `users`.`id` = `comments`.`user_id`
                                    WHERE `news`.`slug` = '$slug'
                                 ");

    return $statement->result();


  }


 public function setComment($param)
 {

  $statement = $this->db->insert('comments', $param);
  return $statement;

 }







// class's bracket
}