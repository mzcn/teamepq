<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑主任务</h1>
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
                            <form id="project_form" name="project_form" method="post" action="/tasks/editmain">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>所属项目</label>
                                        <select id="project_id" name="project_id" class="form-control">
                                            <option value="">---请选择项目---</option>
                                            <?php foreach($projects as $item1) { ?>
                                            <option value="<?php echo $item1['projects']['id'];?>"
                                            <?php if($item1['projects']['id'] == $item['tasks']['project_id']) echo 'selected'; ?>
                                            ><?php echo $item1['projects']['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>名称</label>
                                        <input id="name" name="name" maxlength="100" class="form-control"
                                               value="<?php echo $item['tasks']['name']; ?>">
                                        <font color="red" style="margin-left:5px;">*</font><span id="name_error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>金额</label>
                                        <input id="price" name="price" maxlength="40" class="form-control"
                                               value="<?php echo $item['tasks']['price']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>任务等级</label>
                                        <select id="level" name="level" class="form-control">
                                            <option value="">---请选择等级---</option>
                                            <option value="1"
                                            <?php if( $item['tasks']['level'] == '1') echo 'selected'; ?> >紧急</option>
                                            <option value="2"
                                            <?php if( $item['tasks']['level'] == '2') echo 'selected'; ?> >重要</option>
                                            <option value="3"
                                            <?php if( $item['tasks']['level'] == '3') echo 'selected'; ?> >一般</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>负责人</label>
                                        <select id="group_id" name="group_id" class="form-control">
                                            <option value="">---请选择部门---</option>
                                            <?php foreach($groups as $group) { ?>
                                            <option value="<?php echo $group['groups']['id'];?>"
                                            <?php if($item['tasks']['group_id'] == $group['groups']['id']) echo 'selected';?>
                                            ><?php echo $group['groups']['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>&nbsp;</label>
                                        <select id="owner_user_id" name="owner_user_id" class="form-control">
                                            <option value="">---请选择负责人---</option>
                                            <?php foreach($users as $user) { ?>
                                            <option value="<?php echo $user['users']['id'];?>"
                                            <?php if($item['tasks']['owner_user_id'] == $user['users']['id']) echo 'selected';?>
                                            ><?php echo $user['users']['fullname'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>任务描述</label>
                                    <textarea id="description" name="description"
                                              class="form-control"><?php echo $item['tasks']['description']; ?></textarea>
                                </div>

                                <input type="hidden" id="id" name="id" value="<?php echo $item['tasks']['id'];?>"/>

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
    <script src="../js/task.js"></script>