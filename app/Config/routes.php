<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'Users', 'action' => 'index', 'Users'));
	Router::connect('/users/logout', array('controller' => 'Users', 'action' => 'logout', 'Users'));
	Router::connect('/users/list', array('controller' => 'Users', 'action' => 'userlist', 'Users'));
	Router::connect('/users/add', array('controller' => 'Users', 'action' => 'add', 'Users'));
	Router::connect('/users/edit', array('controller' => 'Users', 'action' => 'edit', 'Users'));
	Router::connect('/users/check_exist', array('controller' => 'Users', 'action' => 'check_exist', 'Users'));
	Router::connect('/users/userinfo', array('controller' => 'Users', 'action' => 'userinfo', 'Users'));
	Router::connect('/users/enable', array('controller' => 'Users', 'action' => 'enable', 'Users'));
	Router::connect('/users/disable', array('controller' => 'Users', 'action' => 'disable', 'Users'));

    Router::connect('/projects/home', array('controller' => 'Projects', 'action' => 'home', 'Projects'));
    Router::connect('/projects', array('controller' => 'Projects', 'action' => 'index', 'Projects'));
    Router::connect('/projects/add', array('controller' => 'Projects', 'action' => 'add', 'Projects'));
    Router::connect('/projects/edit', array('controller' => 'Projects', 'action' => 'edit', 'Projects'));
    Router::connect('/projects/delete', array('controller' => 'Projects', 'action' => 'delete', 'Projects'));
    Router::connect('/projects/check_exist', array('controller' => 'Projects', 'action' => 'check_exist', 'Projects'));
    Router::connect('/projects/check_exist1', array('controller' => 'Projects', 'action' => 'check_exist1', 'Projects'));

    Router::connect('/groups', array('controller' => 'Groups', 'action' => 'index', 'Groups'));
    Router::connect('/groups/add', array('controller' => 'Groups', 'action' => 'add', 'Groups'));
    Router::connect('/groups/edit', array('controller' => 'Groups', 'action' => 'edit', 'Groups'));
    Router::connect('/groups/delete', array('controller' => 'Groups', 'action' => 'delete', 'Groups'));
    Router::connect('/groups/check_exist', array('controller' => 'Groups', 'action' => 'check_exist', 'Groups'));

	Router::connect('/status', array('controller' => 'Status', 'action' => 'index', 'Status'));

	Router::connect('/params', array('controller' => 'Params', 'action' => 'index', 'Params'));
	Router::connect('/params/add', array('controller' => 'Params', 'action' => 'add', 'Params'));
	Router::connect('/params/edit', array('controller' => 'Params', 'action' => 'edit', 'Params'));
	Router::connect('/params/delete', array('controller' => 'Params', 'action' => 'delete', 'Params'));
	Router::connect('/params/check_exist', array('controller' => 'Params', 'action' => 'check_exist', 'Params'));

    Router::connect('/tasks/mainlist', array('controller' => 'Tasks', 'action' => 'mainlist', 'Tasks'));
    Router::connect('/tasks/addmain', array('controller' => 'Tasks', 'action' => 'addmain', 'Tasks'));
    Router::connect('/tasks/editmain', array('controller' => 'Tasks', 'action' => 'editmain', 'Tasks'));
    Router::connect('/tasks/deletemain', array('controller' => 'Tasks', 'action' => 'deletemain', 'Tasks'));
    Router::connect('/tasks/check_main_exist', array('controller' => 'Tasks', 'action' => 'check_main_exist', 'Tasks'));
    Router::connect('/tasks/getusers', array('controller' => 'Tasks', 'action' => 'getusers', 'Tasks'));
    Router::connect('/tasks/getgroupusers', array('controller' => 'Tasks', 'action' => 'getgroupusers', 'Tasks'));

    Router::connect('/tasks/sublist', array('controller' => 'Tasks', 'action' => 'sublist', 'Tasks'));
    Router::connect('/tasks/addsub', array('controller' => 'Tasks', 'action' => 'addsub', 'Tasks'));
    Router::connect('/tasks/editsub', array('controller' => 'Tasks', 'action' => 'editsub', 'Tasks'));
    Router::connect('/tasks/deletesub', array('controller' => 'Tasks', 'action' => 'deletesub', 'Tasks'));
    Router::connect('/tasks/check_sub_exist', array('controller' => 'Tasks', 'action' => 'check_sub_exist', 'Tasks'));
    Router::connect('/tasks/start', array('controller' => 'Tasks', 'action' => 'start', 'Tasks'));
    Router::connect('/tasks/complete', array('controller' => 'Tasks', 'action' => 'complete', 'Tasks'));
    Router::connect('/tasks/reports', array('controller' => 'Tasks', 'action' => 'reports', 'Tasks'));


	Router::connect('/templates', array('controller' => 'Templates', 'action' => 'index', 'Templates'));

    Router::connect('/roles', array('controller' => 'Roles', 'action' => 'index', 'Roles'));
    Router::connect('/roles/add', array('controller' => 'Roles', 'action' => 'add', 'Roles'));
    Router::connect('/roles/edit', array('controller' => 'Roles', 'action' => 'edit', 'Roles'));
    Router::connect('/roles/delete', array('controller' => 'Roles', 'action' => 'delete', 'Roles'));
    Router::connect('/roles/check_exist', array('controller' => 'Roles', 'action' => 'check_exist', 'Roles'));

    Router::connect('/systems', array('controller' => 'Systems', 'action' => 'index', 'Systems'));

    Router::mapResources('tasksapi');
    Router::mapResources('loginapi');

    Router::parseExtensions('json','xml');



/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
