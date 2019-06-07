<?php
define('DB_NAME', '');
define('DB_HOST', '');
define('DB_PASSWORD', '');
define('DB_USER', '');
define('DB_CHARSET', 'utf8');
define('DB_SL_TABLE_NAME', 'short_links');
define('LINK_CREATE', 'http://mytestproject.ru/create_link');
define('SHORT_LINK_TEMPLATE', 'http://mytestproject.ru/sl/');
define('COUNTER_ATTEPTS', 50);
define('ERROR_MSG_CREATE', '<h1>Oops...</h1>
        <p>Something going wrong...</p>
        <p>Please, try later a little</p>');
define('ERROR_MSG_REDIRECT', '<h1>Oops...</h1>
        <p>Something going wrong...</p>
        <p>We don\'t have this link in out DB</p>
        <p>You can add your link <a href="' . LINK_CREATE . '">here</a></p>');