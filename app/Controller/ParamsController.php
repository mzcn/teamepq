<?php
App::uses('AppController', 'Controller');

class ParamsController extends AppController
{
    function beforeFilter()
    {
        parent::beforeFilter();

        $userInfo = $this->Session->read('user_info');
        if (empty($userInfo)) {
            $this->redirect('/');
            exit;
        }
    }

    function index()
    {
        $list = $this->Param->query("select * from params");
        $this->set('list', $list);
    }

    function add()
    {
        if ($this->request->is('post')) {
            $this->Param->create();
            if ($this->Param->save($this->request->data)) {
                echo "<script>alert('保存成功！');window.location.href='/params';</script>";
            }
        }
    }

    function edit()
    {
        $id = $this->request->query('id');

        if ($this->request->is('get')) {
            $data = $this->Param->query("select * from params where id=$id");
            $this->set('item', current($data));
        } else {
            if ($this->Param->save($this->request->data)) {
                echo "<script>alert('编辑成功！');window.location.href='/params';</script>";
            } else {
                echo "<script>alert('编辑失败！');window.location.href='/params/edit?id=$id';</script>";
            }
        }
    }

    function delete()
    {
        $this->layout = 'ajax';
        $id = $this->request->query('id');
        if (!empty($id) && $this->Param->delete($id)) {
            echo "<script>alert('删除成功！');window.location.href='/params';</script>";
        }
    }

    function checkExist()
    {
        $this->layout = 'ajax';

        $from = $this->request->query('from');
        $to = $this->request->query('to');

        $id = $this->request->query('id');
        $from = trim($from);
        $to = trim($to);
        $id = trim($id);

        if (empty($id) || $id == 'undefined') {
            if (empty($id) || $id == 'undefined') {
                $data = $this->Param->query("select * from params where `from`='$from' and to='$to'");
            } else {
                $data = $this->Param->query("select * from params where id!=$id and `from`='$from' and to='$to'");
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
}