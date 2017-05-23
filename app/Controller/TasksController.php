<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class TasksController extends AppController
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

    function send_email($to, $name, $status)
    {
       $Email = new CakeEmail("smtp");
       $Email->template('default', 'default');
       $Email->emailFormat('html');
       $Email->from(array('email@' => 'Tasks'));
       $Email->to($to);
       $Email->subject('状态变更通知');
       $content = "你好,\n";
       $content = $content . "任务：" . $name . "，状态变更为" . $status . "。\n";
       $Email->viewVars(array('content' => $content));
       $Email->send();
    }

    /**
     * 用于Dashboard
     */
    function home()
    {
        $userInfo = $this->Session->read('user_info');
        $role_id = $userInfo['role_id'];
        $user_id = $userInfo['userid'];
        if ($role_id == 1 || $role_id == 6) {
            $list = $this->Task->query("select t.*,p.name,ps.value,u.fullname,s.name,tm.name as parent_name from tasks t " .
                "left join projects p on t.project_id=p.id left join params ps on t.work=ps.id " .
                "left join status s on t.status=s.id " .
                "left join users u on t.owner_user_id=u.id left join tasks tm on t.parent_id=tm.id where t.rank=2 and (t.status=1 or t.status=2)");
        } else if ($role_id == 3) {
            $main_tasks_str = '0,';
            $main_tasks = $this->Task->query("select id from tasks where rank=1 and owner_user_id=$user_id");
            foreach ($main_tasks as $main) {
                $main_tasks_str .= $main['tasks']['id'] . ',';
            }
            $main_tasks_str .= '0';

            $list = $this->Task->query("select t.*,p.name,ps.value,u.fullname,s.name, tm.name as parent_name from tasks t " .
                "left join projects p on t.project_id=p.id left join params ps on t.work=ps.id " .
                "left join status s on t.status=s.id " .
                "left join users u on t.owner_user_id=u.id left join tasks tm on t.parent_id=tm.id where t.rank=2 and (t.parent_id in ($main_tasks_str) or t.owner_user_id=$user_id) and (t.status=1 or t.status=2)");
        } else {
            $list = $this->Task->query("select t.*,p.name,ps.value,u.fullname,s.name,tm.name as parent_name from tasks t " .
                "left join projects p on t.project_id=p.id left join params ps on t.work=ps.id " .
                "left join status s on t.status=s.id " .
                "left join users u on t.owner_user_id=u.id left join tasks tm on t.parent_id=tm.id where t.rank=2 and t.owner_user_id=$user_id and (t.status=1 or t.status=2)");
        }

        $this->set('list', $list);
        $this->set('role_id', $role_id);
    }

    function mainlist()
    {
        $userInfo = $this->Session->read('user_info');
        $role_id = $userInfo['role_id'];
        $user_id = $userInfo['userid'];
        $sql = "select t.*,p.name,ps.value,g.name,s.name from tasks t"
            . " left join projects p on t.project_id=p.id"
            . " left join status s on t.status=s.id"
            . " left join params ps on t.work=ps.id"
            . " left join groups g on t.group_id=g.id where t.rank=1";

        if ($role_id != 1 && $role_id != 6) {
            $sql = $sql . " and t.owner_user_id=$user_id";
        }

        $list = $this->Task->query("$sql");

        $this->set('list', $list);
    }

    function viewmain()
    {
        $id = $this->request->query('id');

        $data = $this->Task->query("select t.* , u.fullname, p.name, s.name from tasks t LEFT JOIN users u on t.owner_user_id=u.id left join projects p on t.project_id=p.id left join status s on t.status=s.id where t.id=$id");
        $this->set('item', current($data));
        $tasks = $this->Task->query("select t.*, u.fullname, s.name from tasks t LEFT JOIN users u on t.owner_user_id=u.id left join status s on t.status = s.id where t.parent_id=$id");
        $this->set('list', $tasks);


    }

    function addmain()
    {
        $project_id = $this->request->query('project_id');
        $this->set('project_id', $project_id);

        $projects = $this->Task->query("select * from projects");
        $this->set('projects', $projects);

        $params = $this->Task->query("select * from params");
        $this->set('params', $params);

        $groups = $this->Task->query("select * from groups");
        $this->set('groups', $groups);

        $first_group = current($groups);
        $first_group_id = $first_group['groups']['id'];

        $users = $this->Task->query("select * from users where group_id=$first_group_id");
        $this->set('users', $users);

        if ($this->request->is('post')) {
            $this->Task->create();
            $data = $this->request->data;
            $price = $data['price'];
            $cow = 0;

            $params = $this->Task->query("select * from params where '$price' BETWEEN `from` and `to`");
            foreach ($params as $param) {
                if ($cow == 0 || $cow > floatval($param['params']['value'])) {
                    $cow = $param['params']['value'];
                }

            }
            if ($cow == 0) {
                $param = $this->Task->query("select * from params where `from` < '$price' and `to` is NULL ");
                if (count($param) > 0) {
                    $cow = $param[0]['params']['value'];
                }
            }

            $data['cow'] = $cow;
			$result = $this->Task->save($data);
            if ($result) {
				$task_id = $result['Task']['id'];
				$task_name = $result['Task']['name'];
				$task_level = $result['Task']['level'];
				$user_id = $result['Task']['owner_user_id'];
                $userInfo = $this->Session->read('user_info');
                $created = $userInfo['userid'];
				//update notice
				$updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status) values($task_id, $user_id, $created, 'add', 0, 1, 0, '$task_name', '$task_level')");
				
                echo "<script>alert('保存成功！');window.location.href='/tasks/mainlist';</script>";
            }
        }
    }

    function editmain()
    {
        $id = $this->request->query('id');

        $projects = $this->Task->query("select * from projects");
        $this->set('projects', $projects);

        $params = $this->Task->query("select * from params");
        $this->set('params', $params);

        $groups = $this->Task->query("select * from groups");
        $this->set('groups', $groups);

        if ($this->request->is('get')) {
            $data = $this->Task->query("select * from tasks where id=$id");
            $item = current($data);
            $this->set('item', $item);

            $group_id = $item['tasks']['group_id'];
            $users = $this->Task->query("select * from users where group_id=$group_id");
            $this->set('users', $users);

        } else {
            $data = $this->request->data;
            $price = $data['price'];
            $cow = 0;

            $params = $this->Task->query("select * from params where '$price' BETWEEN `from` and `to`");
            foreach ($params as $param) {
                if ($cow == 0 || $cow > floatval($param['params']['value'])) {
                    $cow = $param['params']['value'];
                }

            }
            if ($cow == 0) {
                $param = $this->Task->query("select * from params where `from` < '$price' and `to` is NULL ");
                if (count($param) > 0) {
                    $cow = $param[0]['params']['value'];
                }
            }

            $data['cow'] = $cow;
			$result = $this->Task->save($data);
            if ($result) {
				$task_id = $result['Task']['id'];
				$task_name = $result['Task']['name'];
				$task_level = $result['Task']['level'];
				$user_id = $result['Task']['owner_user_id'];
                $userInfo = $this->Session->read('user_info');
                $created = $userInfo['userid'];
				//update notice
				$updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status) values($task_id, $user_id, $created, 'update', 0, 1, 0, '$task_name', '$task_level')");
				
                echo "<script>alert('编辑成功！');window.location.href='/tasks/mainlist';</script>";
            } else {
                echo "<script>alert('编辑失败！');window.location.href='/tasks/editmain?id=$id';</script>";
            }
        }
    }

    function deletemain()
    {
        $this->layout = 'ajax';
        $id = $this->request->query('id');
        $data = $this->Task->query("select * from tasks where id=$id");
        $item = current($data);

        if (!empty($id) && $this->Task->delete($id)) {
            $task_id = $item['tasks']['id'];
            $task_name = $item['tasks']['name'];
            $task_level = $item['tasks']['level'];
            $user_id = $item['tasks']['owner_user_id'];
            $userInfo = $this->Session->read('user_info');
            $created = $userInfo['userid'];
            //update notice
            $updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status) values($task_id, $user_id, $created, 'delete', 0, 1, 0, '$task_name', '$task_level')");


            echo "<script>alert('删除成功！');window.location.href='/tasks/mainlist';</script>";
        }
    }

    function checkMainExist()
    {
        $this->layout = 'ajax';

        $name = $this->request->query('name');
        $id = $this->request->query('id');
        $name = trim($name);
        $id = trim($id);

        if (empty($id) || $id == 'undefined') {
            $data = $this->Task->query("select * from tasks where name='$name' and rank=1");
        } else {
            $data = $this->Task->query("select * from tasks where id!=$id and name='$name' and rank=1");
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

    function getusers()
    {
        $this->layout = 'ajax';

        $id = $this->request->query('id');
        $users = $this->Task->query("select id,fullname from users where group_id=$id");
        $result = array();
        foreach ($users as $user) {
            $result[] = $user['users'];
        }
        echo json_encode($result);
        exit;
    }


    function sublist()
    {
        $userInfo = $this->Session->read('user_info');
        $role_id = $userInfo['role_id'];
        $user_id = $userInfo['userid'];
        $sql = "select t.*,p.name,ps.value,u.fullname,s.name,tm.name as parent_name from tasks t " .
            "left join projects p on t.project_id=p.id left join params ps on t.work=ps.id " .
            "left join status s on t.status=s.id " .
            "left join users u on t.owner_user_id=u.id left join tasks tm on t.parent_id=tm.id where t.rank=2";

        if ($role_id == 3) {
            $main_tasks_str = '0,';
            $main_tasks = $this->Task->query("select id from tasks where rank=1 and owner_user_id=$user_id");
            foreach ($main_tasks as $main) {
                $main_tasks_str .= $main['tasks']['id'] . ',';
            }
            $main_tasks_str .= '0';

            $sql = $sql . " and (t.parent_id in ($main_tasks_str) or t.owner_user_id=$user_id)";
        }
        if ($role_id == 2) {
            $sql = $sql . " and t.owner_user_id=$user_id";
        }
        if (isset($this->request->data['keyword'])) {
            $keyword = $this->request->data['keyword'];
            $sql = $sql . " and t.name like '%$keyword%'";
        };

        $list = $this->Task->query("$sql");

        $this->set('list', $list);
        $this->set('role_id', $role_id);
    }

    function addsub()
    {
        if ($this->request->is('post')) {
            $this->Task->create();
            $data = $this->request->data;
            $data['rank'] = 2;
            $data['status'] = 1;
			$result = $this->Task->save($data);
            if ($result) {
				$task_id = $result['Task']['id'];
				$task_name = $result['Task']['name'];
				$task_level = $result['Task']['level'];
                $user_id = $result['Task']['owner_user_id'];
                $userInfo = $this->Session->read('user_info');
                $created = $userInfo['userid'];
                $task_percent = $result['Task']['percent'];
                $task_hours = $result['Task']['estimate_hours'];
                $task_delivery = $result['Task']['delivery_date'];
				//update notice
				$updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status, task_percent, task_hours, task_delivery) values($task_id, $user_id, $created, 'add', 0, 0, 1, '$task_name', '$task_level', '$task_percent', '$task_hours','$task_delivery')");
				
                echo "<script>alert('保存成功！');window.location.href='/tasks/sublist';</script>";
            }
        } else {
            $parent_id = $this->request->query('parent_id');

            $parent_tasks = $this->Task->query("select * from tasks where rank=1");
            $this->set('parent_tasks', $parent_tasks);

            $groups = $this->Task->query("select * from groups");
            $this->set('groups', $groups);

            $this->set('parent_id', 0);
            $current_task = current($parent_tasks);
            $this->set('parent_task', $current_task['tasks']);
            $group_id = $current_task['tasks']['group_id'];
            if (!empty($parent_id)) {
                $this->set('parent_id', $parent_id);

                foreach ($parent_tasks as $parent_task) {
                    if ($parent_task['tasks']['id'] == $parent_id) {
                        $group_id = $parent_task['tasks']['group_id'];
                        $this->set('parent_task', $parent_task['tasks']);
                        break;
                    }
                }
            }

            $users = $this->Task->query("select * from users where group_id=$group_id");
            $this->set('users', $users);

            $all_users = $this->Task->query("select * from users");
            $this->set('all_users', $all_users);

            $params = $this->Task->query("select * from params");
            $this->set('params', $params);
        }
    }

    function editsub()
    {
        $id = $this->request->query('id');

        $parent_tasks = $this->Task->query("select * from tasks where rank=1");
        $this->set('parent_tasks', $parent_tasks);

        $params = $this->Task->query("select * from params");
        $this->set('params', $params);

        $groups = $this->Task->query("select * from groups");
        $this->set('groups', $groups);

        $statuses = $this->Task->query("select * from status");
        $this->set('statuses', $statuses);

        if ($this->request->is('get')) {
            $data = $this->Task->query("select * from tasks where id=$id");
            $item = current($data);
            $this->set('item', $item);

            $group_id = $item['tasks']['group_id'];
            if (!empty($group_id)){
                $users = $this->Task->query("select * from users where group_id=$group_id");
            }else{
                $users = $this->Task->query("select * from users");
            }
            $this->set('users', $users);
            $all_users = $this->Task->query("select * from users");
            $this->set('all_users', $all_users);
        } else {
			$result = $this->Task->save($this->request->data);
            if ($result) {
				
				$task_id = $result['Task']['id'];
				$task_name = $result['Task']['name'];
				$task_level = $result['Task']['level'];
				$user_id = $result['Task']['owner_user_id'];
                $userInfo = $this->Session->read('user_info');
                $created = $userInfo['userid'];
                $task_percent = $result['Task']['percent'];
                $task_hours = $result['Task']['estimate_hours'];
                $task_delivery = $result['Task']['delivery_date'];
				//update notice
                $updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status, task_percent, task_hours, task_delivery) values($task_id, $user_id, $created, 'update', 0, 0, 1, '$task_name', '$task_level', '$task_percent', '$task_hours','$task_delivery')");
				
                echo "<script>alert('编辑成功！');window.location.href='/tasks/sublist';</script>";
            } else {
                echo "<script>alert('编辑失败！');window.location.href='/tasks/editsub?id=$id';</script>";
            }
        }
    }

    function viewsub()
    {
        $id = $this->request->query('id');

        $params = $this->Task->query("select * from params");
        $this->set('params', $params);

        $groups = $this->Task->query("select * from groups");
        $this->set('groups', $groups);

        $statuses = $this->Task->query("select * from status");
        $this->set('statuses', $statuses);

        if ($this->request->is('get')) {
            $data = $this->Task->query("select tasks.*, tm.name from tasks tasks left join tasks tm on tasks.parent_id=tm.id where tasks.id=$id");
            $item = current($data);
            $this->set('item', $item);
            if (!empty($item['tasks']['start_time']) && !empty($item['tasks']['end_time'])) {
                $start = strtotime($item['tasks']['start_time']);
                $end = strtotime($item['tasks']['end_time']);
                $cle = $end - $start;

                $work = ceil(($cle % (3600 * 24)) / 3600);

                $this->Task->query("update tasks set work = $work where id=$id");
            }

            $group_id = $item['tasks']['group_id'];
            $users = $this->Task->query("select * from users where group_id=$group_id");
            $this->set('users', $users);
            $all_users = $this->Task->query("select * from users");
            $this->set('all_users', $all_users);
        }
    }

    function deletesub()
    {
        $this->layout = 'ajax';
        $id = $this->request->query('id');
        $data = $this->Task->query("select * from tasks where id=$id");
        $item = current($data);
        if (!empty($id) && $this->Task->delete($id)) {
            $task_id = $item['tasks']['id'];
            $task_name = $item['tasks']['name'];
            $task_level = $item['tasks']['level'];
            $user_id = $item['tasks']['owner_user_id'];
            $userInfo = $this->Session->read('user_info');
            $created = $userInfo['userid'];
            //update notice
            $updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status) values($task_id, $user_id, $created, 'delete', 0, 0, 1, '$task_name', $task_level)");

            echo "<script>alert('删除成功！');window.location.href='/tasks/sublist';</script>";
        }
    }

    function checkSubExist()
    {
        $this->layout = 'ajax';

        $name = $this->request->query('name');
        $id = $this->request->query('id');
        $name = trim($name);
        $id = trim($id);

        if (empty($id) || $id == 'undefined') {
            $data = $this->Task->query("select * from tasks where name='$name' and rank=2");
        } else {
            $data = $this->Task->query("select * from tasks where id!=$id and name='$name' and rank=2");
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

    function start()
    {
        $this->layout = 'ajax';

        $id = $this->request->query('id');
        $id = trim($id);


        try {
            $data = $this->Task->query("select * from tasks where id=$id");
            $item = current($data);
            $task_id = $item['tasks']['id'];
            $task_name = $item['tasks']['name'];
            $task_level = $item['tasks']['level'];
            $user_id = $item['tasks']['owner_user_id'];
            $created = $item['tasks']['report_user_id'];
            $task_percent = $item['tasks']['percent'];
            $task_hours = $item['tasks']['estimate_hours'];
            $task_delivery = $item['tasks']['delivery_date'];

            //update notice
            $updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status, task_percent, task_hours, task_delivery) values($task_id, $user_id, $created, 'start', 0, 0, 1, '$task_name', '$task_level', '$task_percent', '$task_hours', '$task_delivery')");

            $data = $this->Task->query("update tasks t1, tasks t2 set t1.status=2, t1.start_time=now(), t2.status = 2 where t2.id = t1.parent_id and t1.id=$id");
            $task = $this->Task->query("select * from tasks t left join status s on t.status = s.id left join users u on t.report_user_id = u.id where t.id=$id");
            $this->send_email($task[0]['u']['email'], $task[0]['t']['name'], $task[0]['s']['name']);
        } catch (Exception $e) {
        }

        $this->redirect('/tasks/sublist');
    }

    function complete()
    {
        $this->layout = 'ajax';

        $id = $this->request->query('id');
        $id = trim($id);

        try {
            $data = $this->Task->query("select * from tasks where id=$id");
            $item = current($data);
            $task_id = $item['tasks']['id'];
            $task_name = $item['tasks']['name'];
            $task_level = $item['tasks']['level'];
            $user_id = $item['tasks']['owner_user_id'];
            $created = $item['tasks']['report_user_id'];
            $task_percent = $item['tasks']['percent'];
            $task_hours = $item['tasks']['estimate_hours'];
            $task_delivery = $item['tasks']['delivery_date'];
            //update notice
            $updateNotice = $this->Task->query("Insert into notices(task_id, owner, created, type, is_project, is_main, is_sub, task_name, task_status, task_percent, task_hours, task_delivery) values($task_id, $user_id, $created, 'complete', 0, 0, 1, '$task_name', '$task_level', '$task_percent', '$task_hours', '$task_delivery')");

            $data = $this->Task->query("update tasks t1, tasks t2 set t1.status=3, t1.end_time=now(),t2.progress = t2.progress+t1.percent, t1.cow=t1.percent*t2.cow/100 where t2.id = t1.parent_id and t1.id=$id");
            $data = $this->Task->query("update tasks set status=3, end_time=now() where parent_id = 0 and progress=100");
            $task = $this->Task->query("select * from tasks t left join status s on t.status = s.id left join users u on t.report_user_id = u.id where t.id=$id");
            $this->send_email($task[0]['u']['email'], $task[0]['t']['name'], $task[0]['s']['name']);
        } catch (Exception $e) {
        }

        $this->redirect('/tasks/sublist');
    }

    function hours_min($start_time, $end_time)
    {
        if (strtotime($start_time) > strtotime($end_time)) list($start_time, $end_time) = array($end_time, $start_time);
        $sec = $start_time - $end_time;
        $sec = round($sec / 60);
        $min = str_pad($sec % 60, 2, 0, STR_PAD_LEFT);
        $hours_min = floor($sec / 60);
        $min != 0 && $hours_min .= ':' . $min;
        return $hours_min;
    }

    /**
     * 报表
     */
    function reports()
    {
        $projects = $this->Task->query("select * from projects");
        $this->set('projects', $projects);

        $users = $this->Task->query("select * from users");
        $this->set('users', $users);

        $beginDate = $this->request->query('begindate');
        $endDate = $this->request->query('enddate');
        $project = $this->request->query('search_project');
        $user = $this->request->query('search_user');


        $this->set('search_begindate', $beginDate);
        $this->set('search_enddate', $endDate);
        $this->set('search_project', $project);
        $this->set('search_user', $user);
        $results = [];

        if ($this->request->is('post')) {
            $results = [];

            $data = $this->request->data;

            $search_begindate = $data['begindate'];
            $search_enddate = $data['enddate'];
            $project = $data['search_project'];
            $user = $data['search_user'];

            $this->set('search_begindate', $search_begindate);
            $this->set('search_enddate', $search_enddate);
            $this->set('search_project', $project);
            $this->set('search_user', $user);

            $condition = '';

            if ($search_begindate != '' && $search_enddate != '') {
                $condition .= "and task.created >= '$search_begindate' and task.created <= '$search_enddate'";
            }

            //project condition
            if (isset($project) && $project) {
                if ($project != 'all') {
                    $condition .= "and task.project_id = '$project'";
                }
            }

            if (isset($user) && $user) {
                if ($user != 'all') {
                    $condition .= " and task.owner_user_id = '$user'";
                }
            }

            $sql = "select u.fullname,count(*) as tasktotal, sum(task.work) as worktotal, sum(task.cow) as cowtotal, sum(task.estimate_hours) as estimatetotal from tasks as task " .
                "left join projects as p on task.project_id = p.id " .
                "left join users as u on task.owner_user_id = u.id " .
                "where task.status=3 $condition group by task.owner_user_id";

            $results = $this->Task->query($sql);


        }

        $this->set('results', $results);

    }


}