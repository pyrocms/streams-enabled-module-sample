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
	public function __construct()
	{
		parent::__construct();

		$this->lang->load('streams_sample');
		
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
		//
		// The only really required parameters are
		// stream and namespace.
		
		$params = array(
				'stream' 		=> 'faqs',
				'namespace'		=> 'streams_sample',
				'paginate'		=> 'yes',
				'page_segment'	=> 4
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
		$this->template->title(lang('streams_sample:new_faq'));
		
		$extra = array(
			'return'			=> 'admin/streams_sample',
			'success_message'	=> lang('streams_sample:submit_success'),
			'failure_message'	=> lang('streams_sample:submit_failure'),
			'title'				=> lang('streams_sample:new')
		);
		
		$this->streams->cp->form('faqs', 'streams_sample', $mode = 'new', $skips = NULL, $view_override = true, $extra);
	}
	
	// --------------------------------------------------------------------------
	
	public function edit($id = 0)
	{
	
	}
	
	// --------------------------------------------------------------------------
	
	public function delete($id = 0)
	{

	}

}