<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    function index()
    {
        $this->layout = 'ajax';
        $this->set('error', "");

        //check session
        $userInfo = $this->Session->read('user_info');
        if (!empty($userInfo)) {
            $this->redirect('/tasks/home');
        }

        $data = $this->request->data;
        if (!empty($data)) {
            $result = $this->User->query("select u.*,r.name,r.rights from users u, roles r where u.username='$data[email]' and u.password='" . md5($data['password']) . "' and u.role_id=r.id");
            $result = current($result);
            if (empty($result)) {
                $this->set('error', "用户名或者密码错误！");
            } else {
                $this->Session->write('user_info',
                    array(
                        'userid' => $result['u']['id'],
                        'username' => $result['u']['username'],
                        'role' => $result['r']['name'],
                        'role_id' => $result['u']['role_id'],
                        'rights' => $result['r']['rights'],
                        'fullname' => $result['u']['fullname']
                    ));

                $this->redirect('/tasks/home');
            }
        }
    }

    function logout()
    {
        $this->Session->delete('user_info');
        $this->redirect('/');
    }

    function userlist()
    {
        $list = $this->User->query("select users.*,roles.name, groups.name from users as users left join roles roles on users.role_id = roles.id left join groups groups on users.group_id = groups.id");
        $this->set('list', $list);
    }

    function add()
    {
        $users = $this->User->query("select * from users");
        $this->set('users', $users);

        $roles = $this->User->query("select * from roles");
        $this->set('roles', $roles);

        $groups = $this->User->query("select * from groups");
        $this->set('groups', $groups);

        if ($this->request->is('post')) {
            $this->User->create();
            $data = $this->request->data;

            $data['password'] = md5($data['password']);
            if ($this->User->save($data)) {
                echo "<script>alert('保存成功！');window.location.href='/users/userlist';</script>";
            }
        }
    }

    function edit()
    {
        $id = $this->request->query('id');
        $roles = $this->User->query("select * from roles");
        $this->set('roles', $roles);

        $groups = $this->User->query("select * from groups");
        $this->set('groups', $groups);

        if ($this->request->is('get')) {
            $data = $this->User->query("select * from users where id=$id");
            $this->set('user', current($data));
        } else {
            $data = $this->request->data;
            if (isset($data['confirm_password']) && $data['confirm_password'] != '') {
                $data['password'] = md5($data['password']);
            } else {
                $info = $this->User->query("select * from users where id=$data[id]");
                $info = current($info);
                $data['password'] = $info['users']['password'];
            }

            if ($this->User->save($data)) {
                echo "<script>alert('编辑成功！');window.location.href='/users/userlist';</script>";
            } else {
                echo "<script>alert('编辑失败！');window.location.href='/users/edit?id=$id';</script>";
            }
        }
    }

    function delete()
    {
        $this->layout = 'ajax';
        $id = $this->request->query('id');
        if (!empty($id) && $this->User->delete($id)) {
            echo "<script>alert('删除成功！');window.location.href='/users/userlist';</script>";
        }
    }

    function checkExist()
    {
        $this->layout = 'ajax';

        $name = $this->request->query('name');
        $id = $this->request->query('id');
        $name = trim($name);
        $id = trim($id);

        if (empty($id) || $id == 'undefined') {
            $data = $this->User->query("select * from users where username='$name'");
        } else {
            $data = $this->User->query("select * from users where id!=$id and username='$name'");
        }

        if (!empty($data)) {
            echo 'exist';
            exit;
        } else {
            echo 'ok';
            exit;
        }

        echo 'error';
        exit;
    }

    public function userinfo()
    {
        $userinfo = $this->Session->read('user_info');
        $username = $userinfo['username'];

        $userinfo = $this->User->query("select u.*,r.name,g.name from users u left join groups g on u.group_id=g.id left join roles r on u.role_id=r.id where username='$username'");
        $userinfo = current($userinfo);
        $this->set('userinfo', $userinfo);

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $set_var1 = '';
            $set_var2 = '';
            $set_var3 = '';
            if ($data['confirm_password']) {
                $password = md5($data['password']);
                $set_var1 = "password='$password',";
            }

            if ($data['fullname']) {
                $set_var2 = "fullname='" . $data['fullname'] . "',";
            }

            if ($data['telephone']) {
                $set_var2 = "telephone='" . $data['telephone'] . "',";
            }

            $this->User->query("update users set $set_var1 $set_var2 $set_var3 where username='$username'");
            echo "<script>alert('更新成功！');window.location.href='/users/userinfo';</script>";
        }
    }

    function enable()
    {
        $this->layout = 'ajax';

        $id = $this->request->query('id');
        $id = trim($id);

        try {
            $data = $this->User->query("update users set active=1 where id=$id");
        } catch (Exception $e) {
        }

        $this->redirect('/users/userlist');
    }

    function disable()
    {
        $this->layout = 'ajax';

        $id = $this->request->query('id');
        $id = trim($id);

        try {
            $data = $this->User->query("update users set active=0 where id=$id");
        } catch (Exception $e) {
        }
        $this->redirect('/users/userlist');
    }
} 
