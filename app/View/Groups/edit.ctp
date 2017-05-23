       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">编辑部门</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            部门
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="company_form" name="company_form" method="post" action="/groups/edit">
                                        <div class="form-group">
                                            <label>部门名称</label>
                                            <input id="name" name="name" maxlength="100" class="form-control" value="<?php echo $item['groups']['name'] ?>">
                                            <font color="red" style="margin-left:5px;">*</font><span id="company_name_error"></span>
                                        </div>
                                        <input type="hidden" id="id" name="id" value="<?php echo $item['groups']['id'];?>" />

                                        <div class="form-group text-center">
                                        <button type="submit" id="btn_save" name="btn_save" class="btn btn-default">保存</button>
                                        <button type="reset" id="btn_reset" name="btn_reset" class="btn btn-default">重置</button>
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
        <script src="../js/group.js"></script>