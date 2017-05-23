<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">项目详细</h1>
        </div>
        <!-- /.col-sm-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    项目
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="project_form" name="project_form" method="post" action="/projects/edit"
                                  class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">项目编号</label>

                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $item['p']['num'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">项目名称</label>

                                        <div class="col-sm-8">

                                            <p class="form-control-static"><?php echo $item['p']['name'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">项目状态</label>

                                        <div class="col-sm-8">

                                            <p class="form-control-static"><?php echo $item['p']['status'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">开始时间</label>

                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $item['p']['start_date'] ?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">交付时间</label>

                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $item['p']['delivery_date'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">负 责 人</label>

                                        <div class="col-sm-8">

                                            <p class="form-control-static"><?php echo $item['u']['fullname'] ?></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-sm-4 control-label">项目描述</label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 col-md-offset-1">
                                        <textarea
                                                class="form-control"><?php echo $item['p']['description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-sm-4 control-label">任务列表</label>
                                </div>
                                <?php if(count($list)>0){?>
                                <div class="dataTable_wrapper col-md-offset-1 col-md-10">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-maintask">
                                        <thead>
                                        <tr>
                                            <th>主任务名称</th>
                                            <th>负责部门</th>
                                            <th>等级</th>
                                            <th>金额</th>
                                            <th>工作系数</th>
                                            <th>状态</th>
                                            <th>进度</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($list as $task) {?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $task['t']['name'];?></td>
                                            <td><?php echo $task['g']['name'];?></td>
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
                                            <td><?php echo $task['t']['price'];?></td>
                                            <td><?php echo $task['t']['cow'];?></td>
                                            <td><?php echo $task['s']['name'];?></td>
                                            <td><?php echo $task['t']['progress'];?>%</td>
                                            <td>
                                                <a href="/tasks/viewmain?id=<?php echo $task['t']['id'];?>"
                                                   class="btn btn-outline btn-primary btn-sm">查看</a>
                                                <a href="/tasks/editmain?id=<?php echo $task['t']['id'];?>"
                                                   class="btn btn-outline btn-primary btn-sm">修改</a>
                                                <a href="/tasks/deletemain?id=<?php echo $task['t']['id'];?>"
                                                   onclick="if(!confirm('确定删除该条记录吗？')) return false;"
                                                   class="btn btn-outline btn-danger btn-sm">删除</a>
                                                <a href="/tasks/addsub?parent_id=<?php echo $task['t']['id'];?>"
                                                   class="btn btn-outline btn-primary btn-sm">拆分任务</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?}?>
                                <input type="hidden" id="id" name="id" value="<?php echo $item['p']['id'];?>"/>

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
<script src="../js/project.js"></script>