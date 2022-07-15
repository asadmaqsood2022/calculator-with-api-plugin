<?php
class Calculator
{
    //adding actions and filters
    public function action_hooks()
    {
        add_action('init', [$this, 'adding_rewrite']);
        add_filter('request', [$this, 'query_var_request']);
        add_filter('template_include', [$this, 'template_include']);
    }
    //Added query var for custom endpoint
    public function query_var_request($vars)
    {
        if (isset($vars['calculator'])) {
            $vars['calculator'] = true;
        }
        return $vars;
    }
    //Adding template for showing api response data
    public function template_include($template)
    {
        if (get_query_var('calculator')) {
            $post = get_queried_object();
            return __DIR__ . '/add-endpoint.php';
        }
        return $template;
    }

    // Adding Rewrite
    public function adding_rewrite()
    {
        flush_rewrite_rules();
        add_rewrite_endpoint('calculator', EP_ALL, true);
    }

}
