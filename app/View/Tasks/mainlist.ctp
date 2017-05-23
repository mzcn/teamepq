<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">主任务管理</h1>

            <div class="form-group col-md-12 text-right">
                <a href="/tasks/addmain" class="btn btn-primary btn-sm right">新建主任务</a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    主任务列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-maintask">
                            <thead>
                            <tr>
                                <th>编号</th>
                                <th>名称</th>
                                <th>所属项目</th>
                                <th>负责部门</th>
                                <th>等级</th>
                                <th>金额</th>
                                <th>系数</th>
                                <th>状态</th>
                                <th>进度</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $item) {?>
                            <tr class="odd gradeX">
                                <td><?php echo $item['t']['id'];?></td>
                                <td><?php echo $item['t']['name'];?></td>
                                <td><?php echo $item['p']['name'];?></td>
                                <td><?php echo $item['g']['name'];?></td>
                                <td>
                                    <?php
                                            if($item['t']['level'] == 2) {
                                                echo "重要";
                                            } else if($item['t']['level'] == 3) {
                                                echo "一般";
                                            } else {
                                                echo "紧急";
                                            }
                                            ?>
                                </td>
                                <td><?php echo $item['t']['price'];?></td>
                                <td><?php echo $item['t']['cow'];?></td>
                                <td><?php echo $item['s']['name'];?></td>
                                <td><?php echo $item['t']['progress'];?>%</td>
                                <td>
                                    <a href="/tasks/viewmain?id=<?php echo $item['t']['id'];?>"
                                       class="btn btn-outline btn-primary btn-sm">查看</a>
                                    <a href="/tasks/editmain?id=<?php echo $item['t']['id'];?>"
                                       class="btn btn-outline btn-primary btn-sm">修改</a>
                                    <a href="/tasks/deletemain?id=<?php echo $item['t']['id'];?>"
                                       onclick="if(!confirm('确定删除该条记录吗？')) return false;"
                                       class="btn btn-outline btn-danger btn-sm">删除</a>
                                    <a href="/tasks/addsub?parent_id=<?php echo $item['t']['id'];?>"
                                       class="btn btn-outline btn-primary btn-sm">拆分任务</a>
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
</div>
<script src="../js/task.js"></script>