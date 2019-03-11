<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="modal-dialog" style="width: 1000px;z-index: 10;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" data-dismiss="modal" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">数据编辑</h4>
        </div>
        <div class="modal-body">
            <form onkeydown="if(event.keyCode==13){return false;}"  id="sys_dlg_form" role="form" class="form-horizontal">
                <div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        <span style="color:red;">*</span>
                                        公司名称：
                                    </label>
                                    <div class="col-sm-4">
                                        <input name="us_companyname" type="text"  value="<?php echo ($data["us_companyname"]); ?>" class="form-control" required>
                                    </div>

                                    <label class="col-sm-2 control-label">
                                        <span style="color:red;">*</span>
                                        姓名：
                                    </label>
                                    <div class="col-sm-4">
                                        <input name="us_name" type="text" value="<?php echo ($data["us_name"]); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        联系方式：
                                    </label>
                                    <div class="col-sm-4">
                                        <input name="us_linkphone" type="text"  value="<?php echo ($data["us_linkphone"]); ?>" class="form-control">
                                    </div>
                                    <label class="col-sm-2 control-label">
                                        备注：
                                    </label>
                                    <div class="col-sm-4">
                                        <input name="us_remark" type="text"  value="<?php echo ($data["us_remark"]); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="us_atpid" type="hidden" value="<?php echo ($data["us_atpid"]); ?>" class="form-control">
                <input name="us_category" type="hidden" value="<?php echo ($bs); ?>" class="form-control">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">关闭</button>
            <button type="button" name="bc" id="sys_dlg_submit" class="btn btn-primary">保存</button>
        </div>
    </div>
</div>
<div class="modal-backdrop fade in" style="z-index: -101;"></div>
<script>
$(function () {
    $(".js-switch").each(function(){
        new Switchery(this, {color: '#1AB394'});
    });
    $(".file-pretty").prettyFile();
    $("#role").chosen({disable_search_threshold: 6, search_contains: true,width:'750px'});
    $(".chosen-select").chosen({disable_search_threshold: 6, search_contains: true,width:'284px'});
});
</script>