<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends Public_Controller
{

    /**
     * The constructor
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->driver('Streams');
    }

    public function index()
    {
        $params = array(
            'stream' => 'faqs',
            'namespace' => 'faq',
            'paginate' => 'yes',
            'page_segment' => 4
        );

        $this->data->faqs = $this->streams->entries->get_entries($params);

        // Build the page
        $this->template->title($this->module_details['name'])
                ->build('index', $this->data);
    }

}

/* End of file faq.php */
