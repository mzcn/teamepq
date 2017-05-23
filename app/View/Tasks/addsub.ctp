<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">新建任务</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    任务
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="task_form" name="task_form" method="post" action="/tasks/addsub">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>所属任务</label>
                                        <select id="parent_id" name="parent_id" class="form-control">
                                            <option value="">---请选择任务---</option>
                                            <?php foreach($parent_tasks as $item1) { ?>
                                            <option value="<?php echo $item1['tasks']['id'];?>"
                                            <?php if($item1['tasks']['id'] == $parent_id) echo 'selected'; ?>
                                            ><?php echo $item1['tasks']['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>任务名称</label>
                                        <input id="name" name="name" maxlength="100" class="form-control">
                                        <font color="red" style="margin-left:5px;">*</font><span id="name_error"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <label>任务等级</label>
                                        <select id="level" name="level" class="form-control">
                                            <option value="">---请选择等级---</option>
                                            <option value="1">紧急</option>
                                            <option value="2">重要</option>
                                            <option value="3">一般</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>占比%</label>
                                        <input id="percent" name="percent" maxlength="40" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label>预估工时</label>
                                        <input id="estimate_hours" name="estimate_hours" maxlength="40"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>截止时间</label>
                                        <input id="delivery_date" name="delivery_date" class="form-control"
                                               data-date-format="yyyy-mm-dd" class="datepicker">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>监督人</label>
                                        <select id="report_user_id" name="report_user_id" class="form-control">
                                            <option value="">---请选择负责人---</option>
                                            <?php foreach($all_users as $user) { ?>
                                            <option value="<?php echo $user['users']['id'];?>"
                                            <?php if($user['users']['id'] === $user_info['userid']) echo 'selected'; ?>
                                            ><?php echo $user['users']['fullname'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>负责部门</label>
                                        <select id="group_id" name="group_id" class="form-control">
                                            <option value="">---请选择部门---</option>
                                            <?php foreach($groups as $group) { ?>
                                            <option value="<?php echo $group['groups']['id'];?>"><?php echo $group['groups']['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>负责人</label>
                                        <select id="owner_user_id" name="owner_user_id" class="form-control">
                                            <option value="">---请选择负责人---</option>
                                            <?php foreach($users as $user) { ?>
                                            <option value="<?php echo $user['users']['id'];?>"><?php echo $user['users']['fullname'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>服务器地址</label>
                                        <input id="server" name="server" class="form-control"
                                               value="">
                                    </div>


                                </div>

                                <div class="form-group">
                                    <label>任务描述</label>
                                    <textarea id="description" name="description"
                                              class="form-control"></textarea>
                                </div>

                                <input type="hidden" id="project_id" name="project_id"
                                       value="<?php echo $parent_task['project_id'];?>"/>

                                <div class="form-group text-center">
                                    <button type="submit" id="btn_save" name="btn_save" class="btn btn-default">保存
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<script src="../js/subtask.js"></script>