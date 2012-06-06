<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('faq');

        $this->load->driver('Streams');
    }

    // --------------------------------------------------------------------------

    /**
     * List all FAQs
     *
     * We are using the Streams API to grab
     * data from the dogs database. It handles
     * pagination as well.
     *
     * @access	public
     * @return	void
     */
    public function index()
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
     * Alternat list all FAQs
     *
     * In this alternate index, we are using the
     * Streams API driver to 
     *
     * @access	public
     * @return	void
     */
    public function _index()
    {
        $extra['title'] = 'Faq';
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

        $this->streams->cp->entries_table('faqs', 'faq', 1, 'admin/faq/index', true, $extra);
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

    public function edit($id = 0)
    {
        $this->template->title(lang('faq:edit'));

        $extra = array(
            'return' => 'admin/faq',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => lang('faq:edit')
        );

        $this->streams->cp->entry_form('faqs', 'faq', 'edit', $id, true, $extra);
    }

    // --------------------------------------------------------------------------

    public function delete($id = 0)
    {
        $this->streams->entries->delete_entry($id, 'faqs', 'faq');
        $this->session->set_flashdata('error', lang('faq:deleted'));
        redirect('admin/faq/');
    }

}
