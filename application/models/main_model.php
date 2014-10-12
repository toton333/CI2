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
       	$statement = $this->db->query("SELECT  `news`.*, `users`.`username`
                                       FROM news
                                       INNER JOIN users
                                       ON `news`.`user_id` = `users`.`id`

                                     ");


       	return $statement->result();
       } 
       else 
       {
        //$slug should be between single quotes and not ``
       	$statement = $this->db->query("SELECT  `news`.*, `users`.`username`
                                       FROM news
                                       INNER JOIN users
                                       ON `news`.`user_id` = `users`.`id`
                                       WHERE `news`.`slug` = '$slug' 


                                     ");
       	return $statement->row();
       }
   
  }

  public function setNews($param)
  {
    $statement = $this->db->insert('news', $param);
    return $statement;
       
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