<?php

hooks()->add_action('app_init','default_url_to_admin');

function default_url_to_admin(){
    $CI = &get_instance();

    if(!is_client_logged_in() && !$CI->uri->segment(1)){
        redirect(site_url('admin/authentication'));
    }
}
