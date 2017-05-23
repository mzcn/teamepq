<div id="page-wrapper">
            <div class="row">
                  <div class="col-lg-12">
                    <h1 class="page-header">任务列表</h1>
                  </div>
                  <!-- /.col-lg-12 -->
                </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-heading"> <i class="fa fa-bell fa-fw"></i> 当前的工作任务有： </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-baojias">
                                    <thead>
                                        <tr>
                                            <th>编号</th>
                                            <th>任务名称</th>
                                            <th>所属项目</th>
                                            <th>关联主任务</th>
                                            <th>执行人</th>
                                            <th>等级</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($list as $item) {?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $item['t']['id'];?></td>
                                        <td><?php echo $item['t']['name'];?></td>
                                        <td><?php echo $item['p']['name'];?></td>
                                        <td><?php echo $item['tm']['parent_name'];?></td>
                                        <td><?php echo $item['u']['fullname'];?></td>
                                        <td><?php
                                        if($item['t']['level'] == 2) {
                                            echo "重要";
                                        } else if($item['t']['level'] == 3) {
                                            echo "一般";
                                        } else {
                                            echo "紧急";
                                        } ?></td>
                                        <td><?php echo $item['s']['name'];?></td>
                                        <td>
                                        <?php if ($role_id == 1 || $role_id == 3) { ?>
                                        <a href="/tasks/editsub?id=<?php echo $item['t']['id'];?>" class="btn btn-outline btn-primary btn-sm">修改</a>
                                        <a href="/tasks/deletesub?id=<?php echo $item['t']['id'];?>" onclick="if(!confirm('确定删除该条记录吗？')) return false;" class="btn btn-outline btn-danger btn-sm">删除</a>
                                        <?php } ?>
                                        <a href="/tasks/start?id=<?php echo $item['t']['id'];?>" class="btn btn-outline btn-primary btn-sm">开始</a>
                                        <a href="/tasks/complete?id=<?php echo $item['t']['id'];?>" class="btn btn-outline btn-primary btn-sm">完成</a>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <a href="/tasks/sublist" class="btn btn-default btn-block">查看所有任务</a> </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        <!-- /#page-wrapper -->
