<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SwarmBot extends CI_Controller {

    public function index($page = 'console')
    {
            if ( ! file_exists(APPPATH.'views/swarmbot/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }
            
            $data['nosidebar'] = false;
            $data['title'] = ucfirst($page); // Capitalize the first letter
    
            $this->load->view('templates/header', $data);
            $this->load->view('swarmbot/'.$page, $data);
            $this->load->view('templates/footer', $data);
    }
}
?>