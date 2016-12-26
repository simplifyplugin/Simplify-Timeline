<?php

// Plugin Activation
function zpt_install()
{
    // trigger our function that registers the custom post type
    pluginprefix_setup_post_types();
 
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'zpt_install' );

// Plugin Deactive
function zpt_deactivation()
{
    // our post type will be automatically removed, so no need to unregister it
 
    // clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'zpt_deactivation' );


?>