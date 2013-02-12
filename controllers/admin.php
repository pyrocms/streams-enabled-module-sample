<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Streams Sample Module
 *
 * This is a sample module for PyroCMS
 * that illustrates how to use the streams core API
 * for data management.
 *
 * @author 		Adam Fairholm - PyroCMS Dev Team
 * @website		http://pyrocms.com
 * @package 	PyroCMS
 * @subpackage 	Streams Sample Module
 */
class Admin extends Admin_Controller
{
    // This will set the active section tab
    protected $section = 'faq';

    protected $data;

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('faq');

        $this->load->driver('Streams');
    }

    // --------------------------------------------------------------------------

    /**
     * List all FAQs using Streams CP Driver
     *
     * In this alternate index, we are using the
     * Streams API driver to 
     *
     * @access	public
     * @return	void
     */
    public function index()
    {
        $extra['title'] = lang_label('lang:faq:faqs');
        $extra['buttons'] = array(
            array(
                'label' => lang('global:edit'),
                'url' => 'admin/faq/edit/-entry_id-'
            ),
            array(
                'label' => lang('global:delete'),
                'url' => 'admin/faq/delete/-entry_id-',
                'confirm' => true
            )
        );

        $this->streams->cp->entries_table('faqs', 'faq', 3, 'admin/faq/index', true, $extra);
    }

    // --------------------------------------------------------------------------

    /**
     * List all FAQs using Streams Entries Driver and building a custom template
     *
     * We are using the Streams API to grab
     * data from the faqs database. It handles
     * pagination as well.
     *
     * @access  public
     * @return  void
     */
    public function _index()
    {
        // The get_entries function in the
        // entries Streams API drivers grabs
        // entries from a stream.
        // The only really required parameters are
        // stream and namespace.

        $params = array(
            'stream' => 'faqs',
            'namespace' => 'faq',
            'paginate' => 'yes',
            'page_segment' => 4
        );

        $this->data->faqs = $this->streams->entries->get_entries($params);

        // Build the page
        $this->template->title($this->module_details['name'])
                ->build('admin/index', $this->data);
    }

    // --------------------------------------------------------------------------

    /**
     * Create a new FAQ entry
     *
     * This uses the Streams API CP driver which
     * is designed to handle repetitive CP tasks
     * down to even loading the page.
     *
     * Certain things can be overridden, but this
     * is an example using almost all default values.
     *
     * @access	public
     * @return	void
     */
    public function create()
    {
        $this->template->title(lang('faq:new'));

        $extra = array(
            'return' => 'admin/faq',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => lang('faq:new')
        );

        $this->streams->cp->entry_form('faqs', 'faq', 'new', null, true, $extra);
    }

    // --------------------------------------------------------------------------
    
    /**
     * Edit a FAQ entry
     *
     * This uses the Streams API CP driver which
     * is designed to handle repetitive CP tasks
     * down to even loading the page.
     *
     * Certain things can be overridden, but this
     * is an example using almost all default values.
     *
     * @access	public
     * @return	void
     */
    public function edit($id = 0)
    {
        $extra = array(
            'return' => 'admin/faq',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => 'lang:faq:edit'
        );

        $this->streams->cp->entry_form('faqs', 'faq', 'edit', $id, true, $extra);
    }

    // --------------------------------------------------------------------------

    /**
     * Delete a FAQ entry
     * 
     * This uses the Streams API Entries driver which is
     * designed to work with entries within a Stream.
     * 
     * @access  public
     * @param   int $id The id of FAQ to be deleted
     * @return  void
     * @todo    This function does not currently hava any error checking.
     */
    public function delete($id = 0)
    {
        $this->streams->entries->delete_entry($id, 'faqs', 'faq');
        $this->session->set_flashdata('error', lang('faq:deleted'));
        redirect('admin/faq/');
    }

}
/* End of file admin.php */
