<?php
App::uses('AppAPIController', 'Controller');

class LoginAPIController extends AppAPIController
{

    public $components = array('RequestHandler', 'Session');


    public function add()
    {
        $this->layout = 'ajax';

        try {
            $data = $this->request->data;
            if (!empty($data)) {
                $this->loadModel('User');
                $result = $this->User->query("select u.*,r.name,r.rights from users u, roles r where u.username='$data[username]' and u.password='" . md5($data['password']) . "' and u.role_id=r.id");
                $result = current($result);
                if (!$result) {
                    $user = array("message" => '用户名或者密码错误!');
                } else {
//                    $token = JWT::encode($result, Configure::read('Security.salt'));
                    $user = array(
                        'userid' => $result['u']['id'],
                        'username' => $result['u']['username'],
                        'role' => $result['r']['name'],
                        'role_id' => $result['u']['role_id'],
                        'rights' => $result['r']['rights'],
                        'fullname' => $result['u']['fullname']
//                            'token' => $token
                    );

                    $this->Session->write('user', $user);


                }

                $this->set(array(
                    'user' => $user,
                    '_serialize' => array('user')
                ));
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

    }

    public function delete($id) {
        $this->layout = 'ajax';

        $this->Session->delete('user');

        $this->set(array(
            'messages' => 'logout successful!',
            '_serialize' => array('messages')
        ));
    }

}