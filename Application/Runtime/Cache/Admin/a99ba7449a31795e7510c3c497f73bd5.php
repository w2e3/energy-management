<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="/Public/vendor/bootstrap-table/bootstrap/css/bootstrap.css" rel="stylesheet" >
    <link href="/Public/adminframework/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/adminframework/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/adminframework/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/Public/vendor/bootstrap-table/bootstrap-table/src/bootstrap-table.css" rel="stylesheet" >
    <link href="/Public/adminframework/css/animate.css" rel="stylesheet">
    <link href="/Public/adminframework/css/style.css?v=4.0.0" rel="stylesheet">
    <link rel="stylesheet" href="/Public/vendor/zTree_v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <base target="_blank">
    <style>
        .table
        {
            max-width: none;
        }

        .main-left{width: 200px;float: left;background-color: #fff;overflow-y:scroll;}
        .main-right{ margin-left:215px;overflow: hidden;}

        .fixed-table-container tbody .selected td {
            /*background-color: yellow;*/
        }

        .table-hover > tbody > tr:hover > td,
        .table-hover > tbody > tr:hover > th {
            /*background-color: yellow;*/
        }

        .bootstrap-table .table:not(.table-condensed),
        .bootstrap-table .table:not(.table-condensed) > tbody > tr > th,
        .bootstrap-table .table:not(.table-condensed) > tfoot > tr > th,
        .bootstrap-table .table:not(.table-condensed) > thead > tr > td,
        .bootstrap-table .table:not(.table-condensed) > tbody > tr > td,
        .bootstrap-table .table:not(.table-condensed) > tfoot > tr > td {
            padding: 4px 8px 4px 8px;
        }


        .fixed-table-container thead th .th-inner,
        .fixed-table-container tbody td .th-inner {
            padding: 4px 8px 4px 8px;
            line-height: 24px;
            vertical-align: top;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .fixed-table-container .bs-checkbox .th-inner {
            padding: 8px 0;
        }
        #treesearchcontent{width: 130px;float: left;;margin-left: 10px;}
        #treesearch{width: 50px;border:0;height: 25.5px;background-color: #009688;line-height: 24px;color: #fff}

    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content" style="padding: 10px 10px 10px 10px;margin-bottom: -15px;">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <i class="fa fa-hand-o-right"></i>&nbsp;当前位置:【园区漫游】
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                <input type="hidden" id="sss" value="asdasd">
                    <?php if($_SESSION['is_hnwl']!= ''): ?><iframe id="contentframe" src="/index.php/Admin/RgGeneral/indexregion?regiontype=rg&snname=&regionlevel=<?php echo ($_GET['regionlevel']); ?>&tabindex=0&rgn_atpid=<?php echo ($_GET['rgn_atpid']); ?>&rgn_atpidcurrent=<?php echo ($_GET['rgn_atpidcurrent']); ?>"  frameborder="no" width="100%" scrolling="yes" height="1400px" ></iframe>
                        <?php else: ?>
                        <iframe id="contentframe" src="/index.php/Admin/RgAlarmConfirm/index?regiontype=rg&snname=&regionlevel=<?php echo ($_GET['regionlevel']); ?>&tabindex=2&rgn_atpid=<?php echo ($_GET['rgn_atpid']); ?>&rgn_atpidcurrent=<?php echo ($_GET['rgn_atpidcurrent']); ?>"  frameborder="no" width="100%" scrolling="yes" height="1400px" ></iframe><?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="sys_dlg" role="dialog" class="modal fade "></div>
<div id="sys_searchdlg" role="dialog" class="modal fade "></div>

<script src="/Public/vendor/bootstrap-table/jquery.min.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/vendor/My97DatePicker/WdatePicker.js"></script>
<script src="/Public/adminframework/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/adminframework/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
<script src="/Public/adminframework/js/plugins/switchery/switchery.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap-table/src/bootstrap-table.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap-table/src/locale/bootstrap-table-zh-CN-atp.js"></script>
<script type="text/javascript" src="/Public/vendor/zTree_v3/js/jquery.ztree.core.js"></script>
<script type="text/javascript" src="/Public/vendor/zTree_v3/js/jquery.ztree.excheck.js"></script>
<script src="/Public/vendor/html5Validate/src/jquery-html5Validate.js"></script>
<script src="/Public/vendor/diy_component/func_scrolltab/atppagetab.js"></script>
<script src="/Public/js/atptab.js"></script>

<script>
    RGN_ATPID="<?php echo ($_GET['rgn_atpid']); ?>";
    $(document).ready(function(){
        $(".js-switch").each(function(){
            new Switchery(this, {color: '#1AB394'});
        });
        $(".file-pretty").prettyFile();
        $(".chosen-select").chosen({disable_search_threshold: 6, search_contains: true,width:'284px'});
    });
    // 联动左树右页,报警
    ATP_REGIONJUMbj = function (rgn_atpid) {
        var regionlevel = "region";
        $('#contentframe').attr('src', "/index.php/Admin/RgAlarmConfirm?regiontype=rg&snname=<?php echo ($_GET['snname']); ?>&regionlevel=" + regionlevel + "&tabindex=2&rgn_atpid=" + RGN_ATPID + "&rgn_atpidcurrent=" + rgn_atpid);
        document.body.scrollTop = document.documentElement.scrollTop = 0;
    };

    ATP_REGIONJUMZH = function (devicepoint_rgn_atpid) {
        var regionlevel = "region";
        $('#contentframe').attr('src',"/index.php/Admin/RgGeneral/indexregion?regiontype=rg&snname=<?php echo ($_GET['snname']); ?>&regionlevel=region&tabindex=0&rgn_atpid=" + RGN_ATPID);
        document.body.scrollTop = document.documentElement.scrollTop = 0;
    };


    function ATP_FRAME_SECOND_ENTER_CALLBACK() {

    }
</script>
</body>
</html>