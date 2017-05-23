<?php
App::uses('AppController', 'Controller');

class ProjectsController extends AppController
{
    private $userInfo;

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
        $userInfo = $this->Session->read('user_info');
        $role_id = $userInfo['role_id'];
        $user_id = $userInfo['userid'];
        if ($role_id != 1 && $role_id != 6) {
            $list = $this->Project->query("select p.*,u.fullname from projects p left join users u on p.creater_user_id=u.id where p.owner_user_id=" . $user_id);
        } else {
            $list = $this->Project->query("select p.*,u.fullname from projects p left join users u on p.owner_user_id=u.id ");
        }
        $projects = array();
        foreach ($list as $item) {
            $total_price = $this->Project->query("select sum(price) as total_price from tasks where rank=1 and project_id=" . $item['p']['id']);
            $total_price = current($total_price);

            $item['p']['total_price'] = $total_price[0]['total_price'];
            $projects[] = $item;
        }

        $this->set('list', $projects);
    }

    function add()
    {
        $users = $this->Project->query("select * from users");
        $this->set('users', $users);
        $projects = $this->Project->query("select count(*) as num from projects");
        $projects = current($projects);
        $count = $projects[0]['num']+1;
        $this->set('projectId',"PJ".sprintf("%06d", $count));

        if ($this->request->is('post')) {
            $this->Project->create();
            $data = $this->request->data;

            $userInfo = $this->Session->read('user_info');
            $data['creater_user_id'] = $userInfo['userid'];
			$result = $this->Project->save($data);
            if ($result) {
				$task_id = $result['Project']['id'];
                $task_name = $result['Project']['name'];
                $task_level = $result['Project']['status'];
				$user_id = $result['Project']['owner_user_id'];
                $created = $result['Project']['creater_user_id'];
				//update notice
				$updateNotice = $this->Project->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status) values($task_id, $user_id, $created, 'add', 1, 0, 0, '$task_name', '$task_level')");
                echo "<script>alert('保存成功！');window.location.href='/projects';</script>";
            }
        }
    }

    function edit()
    {
        $id = $this->request->query('id');

        $users = $this->Project->query("select * from users");
        $this->set('users', $users);

        if ($this->request->is('get')) {
            $data = $this->Project->query("select * from projects where id=$id");
            $this->set('item', current($data));
        } else {
			$result = $this->Project->save($this->request->data);
            if ($result) {
				$task_id = $result['Project']['id'];
                $task_name = $result['Project']['name'];
                $task_level = $result['Project']['status'];
				$user_id = $result['Project']['owner_user_id'];
                $userInfo = $this->Session->read('user_info');
                $created = $userInfo['userid'];
				//update notice
				$updateNotice = $this->Project->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status) values($task_id, $user_id, $created, 'update', 1, 0, 0, '$task_name', '$task_level')");
				
                echo "<script>alert('编辑成功！');window.location.href='/projects';</script>";
            } else {
                echo "<script>alert('编辑失败！');window.location.href='/projects/edit?id=$id';</script>";
            }
        }
    }

    function view()
    {
        $id = $this->request->query('id');

        $data = $this->Project->query("select p.* , u.fullname from projects p LEFT JOIN users u on p.owner_user_id=u.id where p.id=$id");
        $this->set('item', current($data));
        $tasks = $this->Project->query("select t.*,p.name,ps.value,g.name,s.name from tasks t left join projects p on t.project_id=p.id left join status s on t.status=s.id left join params ps on t.work=ps.id left join groups g on t.group_id=g.id where p.id=$id and t.parent_id=0");
        $this->set('list', $tasks);
    }

    function delete()
    {
        $this->layout = 'ajax';
        $id = $this->request->query('id');
        $tasks = $this->Project->query("select * from tasks where project_id=$id");
        if (count($tasks) > 0) {
            echo "<script>alert('此项目有关联任务,无法删除！');window.location.href='/projects';</script>";
            exit;
        }

        $data = $this->Project->query("select * from projects where id=$id");
        $currentProject = current($data);

        if (!empty($id) && $this->Project->delete($id)) {
            $task_id = $currentProject['projects']['id'];
            $task_name = $currentProject['projects']['name'];
            $task_level = $currentProject['projects']['status'];
            $user_id = $currentProject['projects']['owner_user_id'];
            $userInfo = $this->Session->read('user_info');
            $created = $userInfo['userid'];
            //update notice
            $updateNotice = $this->Project->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status) values($task_id, $user_id, $created, 'delete', 1, 0, 0, '$task_name', '$task_level')");

            echo "<script>alert('删除成功！');window.location.href='/projects';</script>";
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
            $data = $this->Project->query("select * from projects where name='$name'");
        } else {
            $data = $this->Project->query("select * from projects where id!=$id and name='$name'");
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

    function checkExist1()
    {
        $this->layout = 'ajax';

        $num = $this->request->query('num');
        $id = $this->request->query('id');
        $num = trim($num);
        $id = trim($id);

        if (empty($id) || $id == 'undefined') {
            $data = $this->Project->query("select * from projects where num='$num'");
        } else {
            $data = $this->Project->query("select * from projects where id!=$id and num='$num'");
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