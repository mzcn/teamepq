<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">新建用户</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    用户
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="user_form" name="user_form" method="post" action="/users/add">
                                <div class="form-group">
                                    <label>用户名</label>
                                    <input id="username" name="username" maxlength="100" class="form-control">
                                    <font color="red" style="margin-left:5px;">*</font><span id="name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>姓名</label>
                                    <input id="fullname" name="fullname" maxlength="100" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>手机</label>
                                    <input id="phone" name="phone" maxlength="100" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>邮件</label>
                                    <input id="email" name="email" maxlength="100" class="form-control">
                                    <span id="email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="password" id="password" name="password" maxlength="20"
                                           class="form-control">
                                    <font color="red" style="margin-left:5px;">*</font><span id="userpass_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>确认密码</label>
                                    <input type="password" id="confirm_password" name="confirm_password" maxlength="20"
                                           class="form-control">
                                    <font color="red" style="margin-left:5px;">*</font><span
                                        id="confirmpass_error"></span>
                                </div>
                                　　　　　　　　　　　　　　　　　　　　
                                <div class="form-group">
                                    <label>角色</label>
                                    <select id="role_id" name="role_id" class="form-control">
                                        <option value="">---请选择---</option>
                                        <?php foreach($roles as $item) { ?>
                                        <option id="<?php echo $item['roles']['id'];?>"
                                                value="<?php echo $item['roles']['id'];?>"><?php echo $item['roles']['name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <font color="red" style="margin-left:5px;">*</font><span id="userrole_error"></span>
                                </div>

                                <div class="form-group">
                                    <label>所属部门</label>
                                    <select id="group_id" name="group_id" class="form-control">
                                        <option value="">---请选择---</option>
                                        <?php foreach($groups as $item) { ?>
                                        <option id="<?php echo $item['groups']['id'];?>"
                                                value="<?php echo $item['groups']['id'];?>"><?php echo $item['groups']['name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>是否为部门执行人</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" id="is_leader" name="is_leader" value="1"/>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" id="btn_save" name="btn_save" class="btn btn-default">保存
                                    </button>
                                    <button type="reset" id="btn_reset" name="btn_reset" class="btn btn-default">重置
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
<script src="../js/users.js"></script>
