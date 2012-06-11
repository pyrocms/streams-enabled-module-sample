<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Faq extends Module
{

    public $version = '1.0';

    public function info()
    {
        return array(
            'name' => array(
                'en' => 'FAQ'
            ),
            'description' => array(
                'en' => 'Frequently Asked Questions'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content',
            'shortcuts' => array(
                'create' => array(
                    'name' => 'faq:new',
                    'uri' => 'admin/faq/create',
                    'class' => 'add'
                )
            )
        );
    }

    public function install()
    {
        // We're using the streams API to
        // do data setup.
        $this->load->driver('Streams');

        $this->load->language('faq/faq');

        // Add faqs streams
        if (!$this->streams->streams->add_stream(
                        lang('faq:faqs'), 'faqs', 'faq', 'faq_', NULL
        ))
            return FALSE;

        // Add some fields
        $fields = array(
            array(
                'name' => 'Question',
                'slug' => 'question',
                'namespace' => 'faq',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'faqs',
                'title_column' => TRUE,
                'required' => TRUE,
                'unique' => TRUE
            ),
            array(
                'name' => 'Answer',
                'slug' => 'answer',
                'namespace' => 'faq',
                'type' => 'textarea',
                'assign' => 'faqs',
                'required' => TRUE
            )
        );

        $this->streams->fields->add_fields($fields);

        return TRUE;
    }

    public function uninstall()
    {
        $this->load->driver('Streams');

        $this->streams->utilities->remove_namespace('faq');

        return TRUE;
    }

    public function upgrade($old_version)
    {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help()
    {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}