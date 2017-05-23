<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">用户管理</h1>
                    <div class="form-group col-md-12 text-right">
                        <a href="/users/add" class="btn btn-primary btn-sm right">新建用户</a>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            用户列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                                    <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>用户</th>
                                            <th>姓名</th>
                                            <th>角色</th>
                                            <th>所属部门</th>
                                            <th>是否为执行人</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $index = 1;
                                        foreach($list as $item) {  ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $index++;?></td>
                                            <td><?php echo $item['users']['username'];?></td>
                                            <td><?php echo $item['users']['fullname'];?></td>
                                            <td><?php echo $item['roles']['name'];?></td>
                                            <td><?php echo $item['groups']['name'];?></td>
                                            <td><?php echo $item['users']['is_leader'] == '1' ? '是' : '否';?></td>
                                            <td>
                                            <?php if ($item['users']['active']) { ?>
                                                <a href="/users/disable?id=<?php echo $item['users']['id'];?>" class="btn btn-outline btn-default btn-sm">失效</a>
                                            <?php } else { ?>
                                                <a href="/users/enable?id=<?php echo $item['users']['id'];?>" class="btn btn-outline btn-success btn-sm">激活</a>
                                            <?php } ?>

                                            <a href="/users/edit?id=<?php echo $item['users']['id'];?>" class="btn btn-outline btn-primary btn-sm">修改</a>
                                            <a href="/users/delete?id=<?php echo $item['users']['id'];?>" onclick="if(!confirm('确定删除该条记录吗？')) return false;" class="btn btn-outline btn-danger btn-sm">删除</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        <!-- /#page-wrapper -->
        <script src="../js/users.js"></script>
