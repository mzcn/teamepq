<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

//App::import('Vendor', 'OAuth/OAuthClient'));

/**
 * Application API Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppAPIController extends Controller
{

//    public $components = array('Session',
//        'Auth' => array('authenticate' => array('Form' => array('userModel' => 'User',
//            'fields' => array(
//                'username' => 'username',
//                'password' => 'password'
//            )
//        )
//        ),
//            'authorize' => array('Controller'),
//            'loginAction' => array('controller' => 'usersAPI', 'action' => 'index'),
//            'loginRedirect' => array('controller' => 'home', 'action' => 'index'),
//            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
//            'authError' => 'You don\'t have access here.',
//        ),
//    );

    public function beforeFilter()
    {
//        $this->Auth->authenticate = array(
//            'Form' => array(
//                'fields' => array(
//                    'username' => 'username',
//                    'password' => 'password'
//                ),
//                'userModel' => 'User',
//                'scope' => array(
//                    'User.active' => 1,
//                )
//            ),
//            'BzUtils.JwtToken' => array(
//                'fields' => array(
//                    'username' => 'username',
//                    'password' => 'password',
//                ),
//                'header' => 'AuthToken',
//                'userModel' => 'User',
//                'scope' => array(
//                    'User.active' => 1
//                )
//            )
//        );
    }
}
