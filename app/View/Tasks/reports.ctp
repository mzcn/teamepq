<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">报表中心</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div>
        <form action="/tasks/reports" method="POST">
            <div class="form-group col-md-11">
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="begindate">开始日期:</label>
                    </div>
                    <div class="col-md-8"><input type="text" id="begindate" name="begindate" class="form-control"
                                                 value="<?php echo $search_begindate;?>" data-date="2013-01-02"
                                                 data-date-format="yyyy-mm-dd" class="datepicker span11" readonly></div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="enddate">结束日期:</label>
                    </div>
                    <div class="col-md-8"><input type="text" id="enddate" name="enddate"
                                                 value="<?php echo $search_enddate;?>" class="form-control"
                                                 data-date="2013-01-02" data-date-format="yyyy-mm-dd"
                                                 class="datepicker span11" readonly></div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="search_project">项目:</label>
                    </div>
                    <div class="col-md-8"><select name="search_project" id="search_project" class="form-control">
                        <option value="all"
                        <?php if($search_project == 'all') echo 'selected'; ?>>全部</option>
                        <?php
                              foreach($projects as $item) {
                                  ?>
                        <option value="<?php echo $item['projects']['name'];?>"
                        <?php if($search_project == $item['projects']['name']) echo 'selected'; ?>
                        ><?php echo $item['projects']['name']; ?></option>
                        <?php } ?>
                    </select></div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="search_user">员工:</label>
                    </div>
                    <div class="col-md-8">
                        <select name="search_user" id="search_user" class="form-control">
                            <option value="all"
                            <?php if($search_user == 'all') echo 'selected'; ?>>全部</option>
                            <?php foreach($users as $item) {?>
                            <option value="<?php echo $item['users']['id'];?>"
                            <?php if($search_user == $item['users']['id']) echo 'selected'; ?>
                            ><?php echo $item['users']['fullname']; ?></option>
                            <?php } ?>
                        </select></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-1 col-md-offset-11">
                    <button id="btn_submit" name="btn_submit" type="submit" class="btn btn-default">查询</button>

                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i>汇总
                    <div class="pull-right">

                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>员工姓名</th>
                                        <th>工作产出</th>
                                        <th>耗费工时</th>
                                        <th>工作系数</th>
                                        <th>绩效等级</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($results as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['u']['fullname']; ?></td>
                                        <td><?php echo $item[0]['tasktotal']; ?></td>
                                        <td><?php echo $item[0]['worktotal']; ?></td>
                                        <td><?php echo $item[0]['cowtotal']; ?></td>
                                        <td><?php echo $item[0]['estimatetotal']-$item[0]['worktotal']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.col-lg-4 (nested) -->
                        <div class="col-lg-6">
                            <div id="morris-bar-chart"></div>
                        </div>
                        <!-- /.col-lg-8 (nested) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.col-lg-8 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<script>
    $(document).ready(function () {
        $('#begindate').datepicker({
            dateFormat: 'yy-mm-dd ',
            changeMonth: true,
            changeYear: true
        });

        $('#enddate').datepicker({
            dateFormat: 'yy-mm-dd ',
            changeMonth: true,
            changeYear: true
        });

        $('#reset').click(function () {
            $('#begindate').val('');
            $('#enddate').val('');

            $('#search_name').val('');
            $('#s2id_search_name span').html('全部');
        });

        $('#export').click(function () {
            window.location.href = "export.php";
        });

        $('#btn_submit').click(function () {
            if ($.trim($('#begindate').val()) == '' || $.trim($('#enddate').val()) == '') {
                alert('请选择日期!');
                return false;
            }
        });
    });
</script>

<script>
    $(function () {
        Morris.Area({
            element: 'morris-area-chart',
            data: [ < ? php echo $chartData;
        ?
        > ],
        xkey: 'period',
                ykeys
        :
        [ < ? php echo
        $ykeys;
        ?
        >],
        labels: [ < ? php echo
        $labels;
        ?
        >],
        pointSize: 2,
                hideHover
        :
        'auto',
                resize
        :
        true
    })
        ;

        Morris.Donut({
            element: 'morris-donut-chart',
            data: [ < ? php echo $pieData;
        ?
        >],
        resize: true
    })
        ;

        Morris.Bar({
            element: 'morris-bar-chart',
            data: [ < ? php echo $barData;
        ?
        >],
        xkey: 'period',
                ykeys
        :
        [ < ? php echo
        $ykeys;
        ?
        >],
        labels: [ < ? php echo
        $labels;
        ?
        >],
        hideHover: 'auto',
                resize
        :
        true
    })
        ;
    });

</script>