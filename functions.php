<?php
require_once 'includes/client_role.php';
require_once 'includes/blocks.php';
require_once 'includes/helper.php';
require_once 'includes/geo.php';
require_once 'includes/enqueue.php';

register_nav_menus( array(
    'primary' => 'Primary Menu',
		'footer' => 'Footer Menu',
) );

require_once 'bs4Navwalker.php';

function category_has_parent($catid){
    $category = get_category($catid);
    if ($category->category_parent > 0){
        return true;
    }
    return false;
}
