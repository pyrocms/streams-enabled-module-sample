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
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
            'sections' => array(
                'faq' => array(
                    'name' => 'faq:faqs',
                    'uri' => 'admin/faq',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'faq:new',
                            'uri' => 'admin/faq/create',
                            'class' => 'add'
                        )
                    )
                ),
                'categories' => array(
                    'name' => 'faq:categories',
                    'uri' => 'admin/faq/categories/index',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'faq:category:new',
                            'uri' => 'admin/faq/categories/create',
                            'class' => 'add'
                        )
                    )
                )
            )
        );
    }

    /**
     * Install
     *
     * This function will set up our
     * FAQ/Category streams.
     */
    public function install()
    {
        // We're using the streams API to
        // do data setup.
        $this->load->driver('Streams');

        $this->load->language('faq/faq');

        // Add faqs streams
        if ( ! $this->streams->streams->add_stream('lang:faq:faqs', 'faqs', 'faq', 'faq_', null)) return false;
        if ( ! $categories_stream_id = $this->streams->streams->add_stream('lang:faq:categories', 'categories', 'faq', 'faq_', null)) return false;

        //$faq_categories

        // Add some fields
        $fields = array(
            array(
                'name' => 'Question',
                'slug' => 'question',
                'namespace' => 'faq',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'faqs',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Answer',
                'slug' => 'answer',
                'namespace' => 'faq',
                'type' => 'textarea',
                'assign' => 'faqs',
                'required' => true
            ),
            array(
                'name' => 'Title',
                'slug' => 'faq_category_title',
                'namespace' => 'faq',
                'type' => 'text',
                'assign' => 'categories',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Category',
                'slug' => 'faq_category_select',
                'namespace' => 'faq',
                'type' => 'relationship',
                'assign' => 'faqs',
                'extra' => array('choose_stream' => $categories_stream_id)
            )
        );

        $this->streams->fields->add_fields($fields);

        $this->streams->streams->update_stream('faqs', 'faq', array(
            'view_options' => array(
                'id',
                'question',
                'answer',
                'faq_category_select'
            )
        ));

        $this->streams->streams->update_stream('categories', 'faq', array(
            'view_options' => array(
                'id',
                'faq_category_title'
            )
        ));

        return true;
    }

    /**
     * Uninstall
     *
     * Uninstall our module - this should tear down
     * all information associated with it.
     */
    public function uninstall()
    {
        $this->load->driver('Streams');

        // For this teardown we are using the simple remove_namespace
        // utility in the Streams API Utilties driver.
        $this->streams->utilities->remove_namespace('faq');

        return true;
    }

    public function upgrade($old_version)
    {
        return true;
    }

    public function help()
    {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}