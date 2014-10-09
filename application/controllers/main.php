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

			
            $this->form_validation->set_rules('commentText', 'Comment', 'required|XSS_clean');

            if ($this->form_validation->run())
             {
             	
                $param = array(
                      'id' => '',
                       'news_id' => $data['info']->id,
                       'comment' => $this->input->post('commentText'),
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
                $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
             	$data['title'] = ucfirst($data['info']->title);
			    $data['comments'] = $this->main_model->getComments($slug);
                $data['slug'] = $slug;

            	$this->load->view('templates/header', $data);
				$this->load->view('pages/nonmember/singleNews', $data);
				$this->load->view('templates/footer');
            }
            


			
	
	}




	//class's bracket
}
