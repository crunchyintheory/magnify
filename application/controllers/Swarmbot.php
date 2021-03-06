<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SwarmBot extends CI_Controller {

    public function index($page = 'console')
    {
            if ( ! file_exists(APPPATH.'views/swarmbot/'.$page.'.php'))
            {
                // Whoops, we don't have a page for that!
                include_once(APPPATH.'controllers/Magnify404.php');
                $c = new Magnify404();
                $c->index();
            }
            else {
                $data['nosidebar'] = false;
                $data['title'] = ucfirst($page); // Capitalize the first letter
        
                $this->load->view('templates/header', $data);
                $this->load->view('swarmbot/'.$page, $data);
                $this->load->view('templates/footer', $data);
            }
    }
}
?>