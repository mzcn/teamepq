<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">项目管理</h1>

            <div class="form-group col-md-12 text-right">
                <a href="/projects/add" class="btn btn-primary btn-sm right">新建项目</a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    项目列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-project">
                            <thead>
                            <tr>
                                <th>项目编号</th>
                                <th>项目名称</th>
                                <th>负 责 人</th>
                                <th>状 态</th>
                                <th>交付时间</th>
                                <th>操 作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                        foreach($list as $item) {?>
                            <tr class="odd gradeX">
                                <td><?php echo $item['p']['num'];?></td>
                                <td><?php echo $item['p']['name'];?></td>
                                <td><?php echo $item['u']['fullname'];?></td>
                                <td><?php echo $item['p']['status'];?></td>
                                <td><?php echo $item['p']['delivery_date'];?></td>
                                <td>
                                    <a href="/projects/view?id=<?php echo $item['p']['id'];?>"
                                       class="btn btn-outline btn-primary btn-sm">查看</a>
                                    <a href="/projects/edit?id=<?php echo $item['p']['id'];?>"
                                       class="btn btn-outline btn-primary btn-sm">修改</a>
                                    <a href="/projects/delete?id=<?php echo $item['p']['id'];?>"
                                       onclick="if(!confirm('确定删除该条记录吗？')) return false;"
                                       class="btn btn-outline btn-danger btn-sm">删除</a>
                                    <a href="/tasks/addmain?project_id=<?php echo $item['p']['id'];?>"
                                       class="btn btn-outline btn-primary btn-sm">添加主任务</a>
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
</div>
<!-- /#page-wrapper -->
<script src="../js/project.js"></script>