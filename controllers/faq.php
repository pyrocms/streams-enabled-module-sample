<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
        $this->lang->load('faq');
        $this->load->driver('Streams');
        $this->template->append_css('module::faq.css');
    }
     /**
     * List all FAQs
     *
     * We are using the Streams API to grab
     * data from the faqs database. It handles
     * pagination as well.
     *
     * @access	public
     * @return	void
     */
    public function index()
    {
        $params = array(
            'stream' => 'faqs',
            'namespace' => 'faq',
            'paginate' => 'yes',
            'pag_segment' => 4
        );

        $this->data->faqs = $this->streams->entries->get_entries($params);

        // Build the page
        $this->template->title($this->module_details['name'])
                ->build('index', $this->data);
    }

}

/* End of file faq.php */
