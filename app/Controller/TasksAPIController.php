<?php
App::uses('AppAPIController', 'Controller');

class TasksAPIController extends AppAPIController
{

    public $components = array('RequestHandler','Session');

    function beforeFilter()
    {
        $userInfo = $this->Session->read('user');

        if (empty($userInfo) || !isset($userInfo)) {
            echo "请先登录后再进行操作!";
            exit;
        }
    }

    public function index()
    {
        $userInfo = $this->Session->read('user');

        $role_id = $userInfo['role_id'];
        $user_id = $userInfo['userid'];
        $sql = "select tasks.*, projects.name as project_name,users.fullname,s.name,tm.name from tasks tasks " .
            "left join projects projects on tasks.project_id=projects.id " .
            "left join status s on tasks.status=s.id " .
            "left join users users on tasks.owner_user_id=users.id left join tasks tm on tasks.parent_id=tm.id where tasks.rank=2";

        if ($role_id == 3) {
            $main_tasks_str = '0,';
            $main_tasks = $this->Task->query("select id from tasks where rank=1 and owner_user_id=$user_id");
            foreach ($main_tasks as $main) {
                $main_tasks_str .= $main['tasks']['id'] . ',';
            }
            $main_tasks_str .= '0';

            $sql = $sql . "and (t.parent_id in ($main_tasks_str) or t.owner_user_id=$user_id)";
        }
        if ($role_id == 2) {
            $sql = $sql . " and t.owner_user_id=$user_id";
        }
//        if ($this->request->data['keyword'] <> "") {
//            $keyword = $this->request->data['keyword'];
//
//            $sql = $sql . " and t.name like '%$keyword%'";
//
//        }

        $this->loadModel('Task');

        $tasks = $this->Task->query($sql);

        $data = [];

        foreach($tasks as $key => $value){
            $data[$key]['task'] = $value['tasks'];
            $data[$key]['task']['project_name'] = $value['projects']['project_name'];
            $data[$key]['task']['status_name'] = $value['s']['name'];
            $data[$key]['task']['parent_name'] = $value['tm']['name'];
            $data[$key]['task']['owner_name'] = $value['users']['fullname'];
        }

        $this->set(array(
            'data' => $data,
            '_serialize' => array('data')
        ));
    }

    public function view($id)
    {
        $this->loadModel('Task');


        $params = $this->Task->query("select * from params");

        $groups = $this->Task->query("select * from groups");

        $data = $this->Task->query("select * from tasks where id=" . $id);
        $item = current($data);

        $group_id = $item['tasks']['group_id'];

        $user = $this->Task->query("select * from users where group_id=" . $group_id);

        $users = $this->Task->query("select * from users");

        $this->set(array(
            'item' => $item,
            'params' => $params,
            'groups' => $groups,
            'user' => $user,
            'users' => $users,
            '_serialize' => array('item', 'params', 'groups', 'user', 'users')
        ));
    }

    public function edit($id)
    {
        $this->loadModel('Task');

        if ($this->request->data['status'] === '2') {
            $sql = "update tasks t1, tasks t2 set t1.status=2, t1.start_time=now(), t2.status = 2 where t2.id = t1.parent_id and t1.id=$id";
        }

        if ($this->request->data['status'] === '3') {
            $sql = "update tasks t1, tasks t2 set t1.status=3, t1.end_time=now(),t2.progress = t2.progress+t1.percent where t2.id = t1.parent_id and t1.id=$id";
            $this->Task->query("update tasks set status=3, end_time=now() where parent_id = 0 and progress=100");
        }

        try {
            $this->Task->query($sql);
            $statusCode = 200;
            $message = 'Success';
        } catch (Exception $e) {
            $statusCode = 500;
            $message = $e->getMessage();
        }

        $this->set(array(
            'statusCode' => $statusCode,
            'message' => $message,
            '_serialize' => array('statusCode', 'message')
        ));
    }

}