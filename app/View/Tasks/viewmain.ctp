<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">主任务详细</h1>
        </div>
        <!-- /.col-sm-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    主任务
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="project_form" name="project_form" method="post" action="/projects/edit"
                                  class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label">所属项目</label>

                                        <div class="col-md-8">

                                            <p class="form-control-static"><?php echo $item['p']['name'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label">名称</label>

                                        <div class="col-md-8">

                                            <p class="form-control-static"><?php echo $item['t']['name'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label">任务状态</label>

                                        <div class="col-md-8">

                                            <p class="form-control-static"><?php echo $item['s']['name'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label">任务等级</label>

                                        <div class="col-sm-4">
                                            <p class="form-control-static">
                                                <?php if( $item['t']['level'] == '1') echo '紧急'; ?>
                                                <?php if( $item['t']['level'] == '2') echo '重要'; ?>
                                                <?php if( $item['t']['level'] == '3') echo '一般'; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label">负 责 人</label>

                                        <div class="col-md-8">

                                            <p class="form-control-static"><?php echo $item['u']['fullname'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">

                                    <label class="col-md-4 control-label">项目描述</label>

                                    <div class="col-md-8">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-10 col-md-offset-1">

                                        <textarea class="form-control"><?php echo $item['t']['description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">

                                    <label class="col-md-4 control-label">任务列表</label>

                                    <div class="col-md-8">
                                    </div>
                                </div>
                                <?php if(count($list)>0){?>
                                <div class="dataTable_wrapper col-md-offset-1 col-md-10">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-maintask">
                                        <thead>
                                        <tr>
                                            <th>任务名称</th>
                                            <th>执行人</th>
                                            <th>等级</th>
                                            <th>占比%</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($list as $task) {?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $task['t']['name'];?></td>
                                            <td><?php echo $task['u']['fullname'];?></td>
                                            <td>
                                                <?php
                                            if($task['t']['level'] == 2) {
                                                echo "重要";
                                            } else if($task['t']['level'] == 3) {
                                                echo "一般";
                                            } else {
                                                echo "紧急";
                                            }
                                            ?>
                                            </td>
                                            <td><?php echo $task['t']['percent'];?></td>
                                            <td><?php echo $task['s']['name'];?></td>
                                            <td>
                                                <a href="/tasks/viewsub?id=<?php echo $task['t']['id'];?>"
                                                   class="btn btn-outline btn-primary btn-sm">查看</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?}?>

                            </form>
                        </div>
                        <!-- /.col-sm-6 (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-sm-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<script src="../js/tasks.js"></script>