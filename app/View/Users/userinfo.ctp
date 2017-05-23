       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">用户信息</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            用户: <?php echo $userinfo['u']['username'];?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="user_form" name="user_form" method="post" action="/users/userinfo">
                                        <div class="form-group">
                                            <label>密码</label>
                                            <input type="password" id="password" name="password" maxlength="20" class="form-control">
                                            <font color="red" style="margin-left:5px;">*</font><span id="userpass_error"></span>
                                        </div>
					<div class="form-group">
                                            <label>确认密码</label>
                                            <input type="password" id="confirm_password" name="confirm_password" maxlength="20" class="form-control">
                                            <font color="red" style="margin-left:5px;">*</font><span id="confirmpass_error"></span>
                                        </div>
					<div class="form-group">
                                            <label>姓名</label>
                                            <input id="fullname" name="fullname" maxlength="64" class="form-control" value="<?php echo $userinfo['u']['fullname']; ?>">
                                        </div>
					<div class="form-group">
                                            <label>角色：</label>
                                            <label><?php echo $userinfo['r']['name']; ?></label>
                                        </div>
					<div class="form-group">
                                            <label>所属部门：</label>
                                            <label><?php echo $userinfo['g']['name']; ?></label>
                                        </div>

                                        <div class="form-group text-center">
                                        <button type="submit" id="btn_save" name="btn_save" class="btn btn-default">更新</button>
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
        <script src="../js/userinfo.js"></script>
