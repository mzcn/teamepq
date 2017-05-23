<?php
App::uses('AppController', 'Controller');

class GroupsController extends AppController {
    function beforeFilter() {
        parent::beforeFilter();

        $userInfo = $this->Session->read('user_info');
        if(empty($userInfo)) {
            $this->redirect('/');
            exit;
        }
    }

    function index() {
        $list = $this->Group->query("select * from groups");
        $this->set('list', $list);
    }

    function add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                echo "<script>alert('保存成功！');window.location.href='/groups';</script>";
            }
        }
    }

    function edit() {
        $id = $this->request->query('id');
        if ($this->request->is('get')) {
            $data = $this->Group->query("select * from groups where id=$id");
            $this->set('item', current($data));
        } else {
            $data = $this->request->data;
            if ($this->Group->save($data)) {
                echo "<script>alert('编辑成功！');window.location.href='/groups';</script>";
            } else {
                echo "<script>alert('编辑失败！');window.location.href='/groups/edit?id=$id';</script>";
            }
        }
    }

    function delete() {
        $this->layout = 'ajax';
        $id = $this->request->query('id');
        if (!empty($id) && $this->Group->delete($id)) {
            echo "<script>alert('删除成功！');window.location.href='/groups';</script>";
            exit;
        }
    }

    function checkExist() {
        $this->layout = 'ajax';

        $name = $this->request->query('name');
        $id = $this->request->query('id');
        $name = trim($name);
        $id = trim($id);

        if(empty($id) || $id=='undefined') {
            $data = $this->Group->query("select * from groups where name='$name'");
        } else {
            $data = $this->Group->query("select * from groups where id!=$id and name='$name'");
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
} 