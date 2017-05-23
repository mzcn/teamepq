       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">编辑工作系数</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            工作系数
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="param_form" name="param_form" method="post" action="/params/edit">
                                        <div class="form-group row">

                                            <div class="form-group row">

                                                <div class="col-md-8">

                                                    <div class="col-md-2">
                                                        <label>区间</label>
                                                        <font color="red"
                                                              style="margin-left:5px;">*</font>
                                                    </div>
                                                    <div class="col-md-3"><input id="from" name="from" maxlength="100"
                                                                                 class="form-control" value="<?php echo $item['params']['from'];?>"> <span
                                                            id="from_error"></span>
                                                    </div>
                                                    <div class="col-xs-1 text-center">-</div>
                                                    <div class="col-md-3"><input id="to" name="to" maxlength="100"
                                                                                 class="form-control" value="<?php echo $item['params']['to'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-8">
                                                    <div class="col-md-2">
                                                        <label>系数值</label>
                                                        <font color="red" style="margin-left:5px;">*</font>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input id="value" name="value" maxlength="100" class="form-control" value="<?php echo $item['params']['value'];?>">
                                                        <span id="value_error"></span>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="id" name="id" value="<?php echo $item['params']['id'];?>" />
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
        <script src="../js/param.js"></script>