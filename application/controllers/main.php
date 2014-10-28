<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Main extends CI_Controller {


	public function __construct()
	{

       parent::__construct();

       $this->load->library('ion_auth');
       $this->load->helper('form');
       $this->load->library('form_validation');
       

       $this->load->model('main_model');

       $this->load->library('user_agent');
       $this->load->helper('file');
       $this->load->helper('smiley');
       $this->load->library('table');

	}

	public function index()
	{
		$this->page();
	}


	public function page($page = 'home')
	{
		
		//set the flash data error message if there is one
		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$data['info'] = $this->main_model->getPage($page); 
		

		if (empty($data['info'])) 
		{
			show_404();
		}

		$data['title'] = ucfirst($data['info']->title);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/tpFullwidth', $data);
		$this->load->view('templates/footer');

	}

	public function newsList()
	{

		//set the flash data error message if there is one
		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		$data['info'] = $this->main_model->getNews();
		$data['title'] = 'Recent News';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/nonmember/newsList', $data);
		$this->load->view('templates/footer');
      

	}

	public function singleNews($slug)
	{
		//set the flash data error message if there is one
		

		$data['info'] = $this->main_model->getNews($slug);

		

		if (empty($data['info'])) 
		{
			show_404();
		}

			
            $this->form_validation->set_rules('comments', 'Comment', 'required|XSS_clean');

            if ($this->form_validation->run())
             {
             	
                $param = array(
                      'id' => '',
                       'news_id' => $data['info']->id,
                       'comment' => $this->input->post('comments'),
                       'user_id' =>$this->ion_auth->get_user_id(),
                       'posted_on' => time()

                	);
                if ($this->main_model->setComment($param)) {
                	$this->session->set_flashdata('message', 'Comment has been posted.');
                	redirect('news/'.$slug);
                } else {
                	$this->session->set_flashdata('message', 'Some error occured, try again later.');
                }
                


            	
             }
             else 
             {
                 $data['message'] = $this->session->flashdata('message');
                 $data['title'] = ucfirst($data['info']->title);
    			       $data['comments'] = $this->main_model->getComments($slug);
                 $data['slug'] = $slug;

                 //for smiley generation
                 $image_array = get_clickable_smileys(base_url().'smile/', 'comments');
                 $col_array = $this->table->make_columns($image_array, 8);
                 $data['smiley_table'] = $this->table->generate($col_array);



                 $this->load->view('templates/header', $data);
    				     $this->load->view('pages/nonmember/singleNews', $data);
    				     $this->load->view('templates/footer');
            }
            


			
	
	}

	public function create_news()
	{

		$this->form_validation->set_rules('news_title', 'News Title', 'required|XSS_clean|is_unique[news.title]');
		$this->form_validation->set_rules('comments', 'News Body', 'required|XSS_clean');

           if ($this->form_validation->run())
           {

           	$param = array(
                      'id' => '',
                      'user_id' => $this->ion_auth->get_user_id(),
                      'title'   => $this->input->post('news_title'),
                      'slug'    =>  url_title($this->input->post('news_title'), 'dash', TRUE),
                      'text'    => $this->input->post('comments'),
                      'posted_on' => time()

                	);
             if ($this->main_model->setNews($param))
             {
             	$this->session->set_flashdata('message', 'News has been created');
             	redirect('news/create_news', 'refresh');
             }
             else
             {
             	$this->session->set_flashdata('message', 'Some error occured. Try again later.');
             	redirect('news/create_news', 'refresh');
             }
             
           	
           	;
           }
           else
           {
           	    $data['message'] = $this->session->flashdata('message');
    		        $data['title']   = "Create News";
    		        $data['news_title'] = array(
                    'name'  => 'news_title',
                    'id'    => 'news_title',
                    'type'  => 'text',
                    'placeholder' => 'Title',
                    'required'    => 'required',
                    'value' => $this->form_validation->set_value('news_title')
               
		        	);
		        $data['news_body'] = array(
                    'name'        => 'comments',
                    'id'          => 'comments',
                    'value'       => $this->form_validation->set_value('news_body'),
                    'cols'        => 40,
                    'rows'        => 20,
                    'placeholder' => 'Post the news here...',
                    'required'    => 'required',
                    'wrap'        => 'hard'
               
		        	);

            //for smiley generation
            $image_array = get_clickable_smileys(base_url().'smile/', 'comments');
            $col_array = $this->table->make_columns($image_array, 8);
            $data['smiley_table'] = $this->table->generate($col_array);





		        $this->load->view('templates/header', $data);
    				$this->load->view('pages/admin/createNews', $data);
    				$this->load->view('templates/footer');
           }
           



		       
	}

/*
 hook is something which hooks a method/function of a class to an event
 below example shows how a hook 'programmer' hooks a method 'func_of_programmer_hook' to an event 'intro'.
 Events are called using trigger_events() function.
 Both trigger_events() and set_hook() are in ion_auth_mode.php
*/

  public function func_of_programmer_hook($name)
  {
    
    echo 'My name is '.$name. ' and i am a programmer.<br/>';

  }

  public function trigger_test()
  {
    $event     = 'intro'; //it fires off using trigger_events('intro')
    $hook      = 'programmer'; // the name of the hook being set using set_hook function
    $class     = 'main';
    $function  = 'func_of_programmer_hook'; //name of the function to be used in the programmer hook
    $args      = array('Bishan'); //arguments of the func_of_programmer_hook() to be passed into



    $this->ion_auth->set_hook($event, $hook, $class, $function, $args);

    $this->ion_auth->trigger_events('intro');
    echo 'I am from India';

  }




	//class's bracket
}
