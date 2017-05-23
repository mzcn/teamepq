<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">任务详情</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    任务
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="project_form" name="project_form" method="post" action="/tasks/editsub">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>所属任务</label>

                                        <p class="form-control"><?php echo $item['tm']['name']; ?></p>
                                    </div>

                                    <div class="col-md-4">
                                        <label>任务名称</label>

                                        <p class="form-control"><?php echo $item['tasks']['name']; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>任务等级</label>

                                        <p class="form-control">
                                            <?php if( $item['tasks']['level'] == '1') echo '紧急'; ?>
                                            <?php if( $item['tasks']['level'] == '2') echo '重要'; ?>
                                            <?php if( $item['tasks']['level'] == '3') echo '一般'; ?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>占比%</label>

                                        <p class="form-control"><?php echo $item['tasks']['percent']; ?></p>
                                    </div>

                                    <div class="col-md-4">
                                        <label>预估工时</label>

                                        <p class="form-control"><?php echo $item['tasks']['estimate_hours']; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>截止时间</label>

                                        <p class="form-control"><?php echo $item['tasks']['delivery_date']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>监督人</label>

                                        <p class="form-control">
                                            <?php foreach($all_users as $user) {
                                             if($user['users']['id'] == $item['tasks']['report_user_id']) echo $user['users']['fullname']; } ?>
                                        </p>
                                    </div>

                                    <div class="col-md-4">
                                        <label>负责部门</label>

                                        <p class="form-control">
                                            <?php foreach($groups as $group) { if($item['tasks']['group_id'] == $group['groups']['id']) echo $group['groups']['name']; } ?>
                                        </p>
                                    </div>

                                    <div class="col-md-4">
                                        <label>负责人</label>

                                        <p class="form-control">
                                            <?php foreach($users as $user) {
                                             if($user['users']['id'] == $item['tasks']['report_user_id']) echo $user['users']['fullname']; } ?>
                                        </p>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>开始时间</label>

                                        <p class="form-control"><?php echo $item['tasks']['start_time']; ?></p>
                                    </div>

                                    <div class="col-md-4">
                                        <label>结束时间</label>

                                        <p class="form-control"><?php echo $item['tasks']['end_time']; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>实际工时</label>

                                        <p class="form-control">
                                            <?php echo $item['tasks']['work']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label>服务器地址</label>

                                        <p class="form-control"><?php echo $item['tasks']['server']; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>任务状态</label>
                                        <p class="form-control">
                                            <?php foreach($statuses as $staus) { ?>
                                            <?php if($staus['status']['id'] == $item['tasks']['status']) echo $staus['status']['name']; ?>
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>任务描述</label>
                                    <textarea id="description" name="description"
                                              class="form-control"
                                    ><?php echo $item['tasks']['description']; ?></textarea>
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
<script src="../js/subtask.js"></script>