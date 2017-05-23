<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">添加主任务</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    主任务
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="task_form" name="task_form" method="post" action="/tasks/addmain">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>所属项目</label>
                                        <select id="project_id" name="project_id" class="form-control">
                                            <option>---请选择项目---</option>
                                            <?php foreach($projects as $item) { ?>
                                            <option value="<?php echo $item['projects']['id'];?>"
                                            <?php if($item['projects']['id'] == $project_id) echo 'selected'; ?>
                                            ><?php echo $item['projects']['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>名称</label>
                                        <input id="name" name="name" maxlength="100" class="form-control">
                                        <font color="red" style="margin-left:5px;">*</font><span id="name_error"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <label>金额</label>
                                        <input id="price" name="price" maxlength="40" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label>任务等级</label>
                                        <select id="level" name="level" class="form-control">
                                            <option>---请选择等级---</option>
                                            <option value="1">紧急</option>
                                            <option value="2">重要</option>
                                            <option value="3">一般</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>负责人</label>
                                        <select id="group_id" name="group_id" class="form-control">
                                            <option>---请选择部门---</option>
                                            <?php foreach($groups as $group) { ?>
                                            <option value="<?php echo $group['groups']['id'];?>"><?php echo $group['groups']['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>&nbsp;</label>

                                        <select id="owner_user_id" name="owner_user_id" class="form-control">
                                            <option>---请选择负责人---</option>
                                            <?php foreach($users as $user) { ?>
                                            <option value="<?php echo $user['users']['id'];?>"><?php echo $user['users']['fullname'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>描述</label>
                                    <textarea id="description" name="description"
                                              class="form-control"></textarea>
                                </div>

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
<script src="../js/task.js"></script>
