<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">新建项目</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    项目
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="project_form" name="project_form" method="post" action="/projects/add">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>项目编号</label>
                                        <input id="num" name="num" maxlength="20" class="form-control" value="<?=$projectId?>" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label>项目名称</label>
                                        <input id="name" name="name" maxlength="100" class="form-control">
                                        <span class="red">*</span><span id="name_error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>项目状态</label>
                                        <input id="status" name="status" maxlength="100" class="form-control">
                                        <span class="red">*</span><span id="status_error"></span>
                                    </div>

                                </div>
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label>开始时间</label>
                                        <input id="start_date" name="start_date" maxlength="100" class="form-control"
                                               data-date-format="yyyy-mm-dd" class="datepicker">
                                    </div>

                                    <div class="col-md-4">
                                        <label>交付时间</label>
                                        <input id="delivery_date" name="delivery_date" maxlength="100"
                                               class="form-control"
                                               data-date-format="yyyy-mm-dd" class="datepicker">
                                    </div>
                                    <div class="col-md-4">
                                        <label>项目负责人</label>
                                        <select id="owner_user_id" name="owner_user_id" class="form-control">
                                            <?php foreach($users as $user) { ?>
                                            <option value="<?php echo $user['users']['id'];?>"
                                            <?php if($user['users']['id'] == $user_info['userid']) echo 'selected'; ?>>
                                            <?php echo $user['users']['fullname'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>项目描述</label>
                                    <textarea id="description" name="description"
                                              class="form-control"></textarea>
                                    <span class="red">*</span><span id="desc_error"></span>
                                </div>
                                <input type="hidden" id="creater_user_id" name="creater_user_id" class="form-control"
                                       value="<?=$user_info['fullname']?>" readonly/>

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
    <script src="../js/project.js"></script>