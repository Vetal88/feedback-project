<?php

Config::set('site_name','Contact form');

Config::set('languages', array('en', 'fr'));

//Routes. Route name => method prefix
Config::set('routes',array(
    'default' => '',
    'admin'   => 'admin_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'contacts');
Config::set('default_action', 'index');

Config::set('db.host', 'boom');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'mvc');

Config::set('salt', 'ert4tyey4y6u7u4hr');