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
class Admin_streams extends Admin_Controller
{
    // This will set the active section tab
    protected $section = 'streams';

    protected $data;

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('faq');

        $this->load->driver('Streams');
    }

    public function index()
    {
        $extra['title'] = lang_label('lang:faq:streams');
        
        $extra['buttons'] = array(
            array(
                'label' => 'lang:faq:field_assignments',
                'url' => 'admin/faq/streams/fields/-stream_slug-'
            ),
            array(
                'label' => 'lang:faq:view_options',
                'url' => 'admin/faq/streams/view_options/-stream_slug-'
            )
        );

    	$this->streams->cp->streams_table('faq', 10, 'admin/faq/streams/index', true, $extra);
    }

    public function view_options($stream_slug)
    {
        $this->streams->cp->view_options($stream_slug, 'faq', 'admin/faq/streams/index');
    }

    public function fields($stream_slug)
    {

        $extra['title'] = lang('faq:streams').' &rarr; '.lang('faq:'.$stream_slug) .' &rarr; '.lang('faq:field_assignments');

        $extra['buttons'] = array(
            array(
                'label' => 'lang:global:edit',
                'url' => 'admin/faq/streams/assignment/'.$stream_slug.'/edit/-assign_id-'
            )
        );

        $this->streams->cp->assignments_table($stream_slug, 'faq', null, null, true, $extra);   
    }

    public function assignment($stream_slug, $method = 'new', $id = null)
    {
        $extra['title'] = lang('faq:streams').' &rarr; '.lang('faq:'.$stream_slug) .' &rarr; '.lang('faq:'.$method.'_assignment');

        $this->streams->cp->field_form($stream_slug, 'faq', $method, 'admin/faq/streams/fields/'.$stream_slug, $id, array(), true, $extra);
    }
}