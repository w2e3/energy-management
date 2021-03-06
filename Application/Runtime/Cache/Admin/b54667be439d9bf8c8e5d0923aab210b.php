<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="/Public/vendor/bootstrap-table/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link href="/Public/adminframework/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/adminframework/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/adminframework/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/Public/vendor/bootstrap-table/bootstrap-table/src/bootstrap-table.css" rel="stylesheet" >
    <link href="/Public/adminframework/css/animate.css" rel="stylesheet">
    <link href="/Public/adminframework/css/style.css?v=4.0.0" rel="stylesheet">
    <link rel="stylesheet" href="/Public/vendor/zTree_v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <script src="/Public/vendor/bootstrap-table/jquery.min.js"></script>
    <script src="/Public/vendor/bootstrap-table/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/vendor/My97DatePicker/WdatePicker.js"></script>
    <script src="/Public/adminframework/js/plugins/chosen/chosen.jquery.js"></script>
    <script src="/Public/adminframework/js/plugins/chosen/chosen.order.jquery.js"></script>
    <script src="/Public/vendor/chosen-ajax-addition/chosen.ajaxaddition.jquery.js"></script>

    <script src="/Public/adminframework/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
    <script src="/Public/adminframework/js/plugins/switchery/switchery.js"></script>
    <script src="/Public/vendor/bootstrap-table/bootstrap-table/src/bootstrap-table.js"></script>
    <!--<script src="/Public/vendor/bootstrap-table/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>-->
    <script src="/Public/vendor/bootstrap-table/bootstrap-table/src/locale/bootstrap-table-zh-CN-atp.js"></script>
    <script type="text/javascript" src="/Public/vendor/zTree_v3/js/jquery.ztree.core.js"></script>
    <script src="/Public/vendor/html5Validate/src/jquery-html5Validate.js"></script>
    <base target="_blank">
    <style>
        .table
        {
            max-width: none;
        }
        .main-left{width: 200px;float: left;background-color: #fff}
        .main-right{ margin-left:220px;overflow: hidden;}

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

        /*.chosen-disabled{*/
        /*border: 1px solid red;*/
        /*background-color: #eee;*/
        /*}*/
        /*.chosen-container-single .chosen-single{*/
        /*background-color: #eee;*/
        /*}*/
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content" style="padding: 10px 10px 10px 10px;margin-bottom: -15px;">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <i class="fa fa-hand-o-right"></i>&nbsp;当前位置:【设备管理】/【设备参数】
                </div>
            </div>
        </div>
    </div>
    <div class="main-left">
        <div class="content_wrap" style="width: 100%;max-height: 700px;overflow: auto;">
            <!--<div style="margin-top: 4px;width: 99%">-->
            <!--<input type="text" id="treesearchcontent" placeholder="请输入筛选内容" >-->
            <!--<input type="button" id="treesearch" value="搜索" >-->
            <!--</div>-->
            <ul id="treeDemo" class="ztree"></ul>
        </div>
    </div>
    <div class="main-right">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div id="atpbiztoolbar">
                        <button class="btn btn-info " type="button" id="sys_add"><i class="fa fa-pencil"></i>&nbsp;添加</button>
                        <!--<button class="btn btn-info " type="button" id="sys_update"><i class="fa fa-pencil-square"></i>&nbsp;编辑</button>-->
                        <!--<button class="btn btn-danger " type="button" id="sys_del"><i class="fa fa-eraser"></i>&nbsp;批量删除</button>-->
                    </div>
                    <table id="atpbiztable"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sys_dlg" role="dialog" class="modal fade "></div>

<div class="modal fade" id="loading" role="dialog" data-backdrop='static'>
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">处理中</h4>
            </div>
            <div class="modal-body">
                <img src="/Public/img/loading/loading9.gif" style='display: block;margin: 0 auto'>
                <div id="loadingText" style="text-align: center"></div>
            </div>
        </div>
    </div>
</div>


<script>
    GLOBAL_SEARCHNAME = "名称";
    DM_ATPID="";
    ET_ATPID="";
    DEV_ATPID="";
    var setting = {
        view:{
            selectedMulti:true
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "pid",
                rootPId: 0
            }
        },
        callback: {
            beforeClick: function (treeId, treeNode, clickFlag) {

            },
            onClick: function (event, treeId, treeNode) {
//                console.log(treeNode);
                if ('设备' == treeNode.type) {
                    DM_ATPID = '设备,'+ treeNode.id;
                    $('#atpbiztable').bootstrapTable('refresh')
                }else if ('能源' == treeNode.type) {
                    DM_ATPID = '能源,'+ treeNode.id;
                    $('#atpbiztable').bootstrapTable('refresh')
                }else if ('总设备' == treeNode.type) {
                    DM_ATPID = '';
                    $('#atpbiztable').bootstrapTable('refresh')
                }
            }
        }
    };
    var zNodes =<?php echo ($treedatas); ?>;
    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
//        zTree.expandAll(true);
    });

    $(function () {
        $('#treesearchcontent').bind("keypress",function(){
            if(event.keyCode == '13')
            {
                var content = $("#treesearchcontent").val();
                alert('回车事件'+ content);
            }
        });
        $('#treesearch').on("click",function()
        {
            var content = $("#treesearchcontent").val();
            alert('树搜索事件'+ content);
        });
        function getName() {

        }
        $('#atpbiztable').bootstrapTable({
            url: '/index.php/Admin/Devicemodelparam/getData',         //请求后台的URL（*）
            method: 'post',                      //请求方式（*）
            toolbar: '#atpbiztoolbar',                //工具按钮用哪个容器
            striped: true,                      //是否显示行间隔色
            cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
            pagination: true,                   //是否显示分页（*）
            iconSize: 'outline',
            sortable: true,                     //是否启用排序
            sortName:"",
            sortOrder: "",                   //排序方式
            queryParams: queryParams,        //传递参数（*）
            sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                       //初始化加载第一页，默认第一页
            pageSize: 10,                       //每页的记录行数（*）
            pageList: [5,10, 25, 50, 100],        //可供选择的每页的行数（*）
            search: true,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
//            strictSearch: true,
//            showColumns: true,                  //是否显示所有的列
            showRefresh: true,                  //是否显示刷新按钮
            minimumCountColumns: 2,             //最少允许的列数
            clickToSelect: true,                //是否启用点击选中行
//            height: 600,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
            uniqueId: "dmp_atpid",                     //每一行的唯一标识，一般为主键列
//            showToggle: true,                    //是否显示详细视图和列表视图的切换按钮
//            cardView: true,                    //是否显示详细视图
            detailView: false,                   //是否显示父子表
            detailFormatter: "detailFormatter",
            height:510,
            columns: [
                [
                    {checkbox: true},
                    {title: '序号', width: 50,align:'center',
                        formatter: function (value, row, index)
                        {
                            var option =  $('#atpbiztable').bootstrapTable("getOptions");
                            return option.pageSize * (option.pageNumber - 1) + index + 1;
                        }
                    },
                    {field: 'dm_name', title: '厂家设备', align:'center', valign:'middle',sortable: true,
                        formatter: function (value, row, index) {
                            var inp = "'"+  row['dm_atpid'] +"'";
                            var value = value;
                            if (null != value){
                                var a = '<a onclick="check ('+ inp +')">'+value+'</a>&nbsp;<br>';
                            }
                            return a;
                        }
                    },
                    {field: 'dmp_name', title: ' 参数名称', align:'center', valign:'middle',sortable: true},
                    {field: 'dmp_shortname', title: ' 参数字段', align:'center', valign:'middle',sortable: true},
                    {field: 'dmp_style', title: ' 数值类型', align:'center', valign:'middle',sortable: true},
                    {field: 'dmp_unit', title: ' 数值单位', align:'center', valign:'middle',sortable: true},

                    {field:'dmp_atpid',title:'主键',visible:false},
                    {field:'dmp_atpcreatedatetime',title:'创建时间',visible:false},
                    {field:'dmp_atpcreateuser',title:'创建人',visible:false},
                    {field:'dmp_atplastmodifydatetime',title:'最后修改时间',visible:false},
                    {field:'dmp_atplastmodifyuser',title:'最后修改人',visible:false},
                    {field:'dmp_atpstatus',title:'数据状态',visible:false},
                    {field:'dmp_atpsort',title:'数据排序',visible:false},
                    {field:'dmp_atpremark',title:'数据备注',visible:false},
                    {field: 'dmp_atpid', title: '操作',align:'center',sortable: false,width:100,
                        formatter: function (value, row, index) {
                            var inp = "'"+  value +"'";
                            var a = '<a  class="btn btn-info btn-xs" onclick="updateInRow('+ inp +')">编辑</a>&nbsp;';
                            a += '<a  class="btn btn-danger btn-xs" onclick="delInRow('+ inp +')">删除</a>';
                            return a;
                        }
                    },
                ]
            ],
            onDblClickRow: function (row) {
                $("#sys_dlg").load('/index.php/Admin/Devicemodelparam/edit?id=' + row['dmp_atpid'], function() {
                    $('#sys_dlg_submit').on('click',submitdata);
                    $("#sys_dlg").modal({backdrop: false});
                });
            },
            onSort: function (name, order) {
//                console.log(name+order);
            },
        });
    });

    function queryParams(params) {  //配置参数
        var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
            limit: params.limit,   //页面大小
            offset: params.offset,  //页码
            search: params.search,
            dm_atpid: DM_ATPID,
            et_atpid: ET_ATPID,
            dev_atpid: DEV_ATPID,
            sort: params.sort,  //排序列名
            sortOrder: params.order//排位命令（desc，asc）
        };
        return temp;
    }

    $('#sys_add').on('click',function(){
        var array =  DM_ATPID.split(",");
        if('总设备' == array[0] || '能源' == array[0] || null == array[1] || '' == array[1]) {
            alert("请先选所在设备后再进行添加操作！");
        }else{
            $("#sys_dlg").load('/index.php/Admin/Devicemodelparam/add?dm_atpid='+array[1], function() {
                $("button[name ='bc']").attr("data-dismiss","");
                $('#sys_dlg_submit').on('click', submitdata);
                $("#sys_dlg").modal({backdrop: false});
            });
        }
    });
    function submitdata()
    {
        if ($.html5Validate.isAllpass($("#sys_dlg_form"))) {
            $("#loadingText").html("正在处理请稍后<br>本操作逻辑处理较复杂，处理完成后本弹出框会自动关闭");
            $('#loading').modal('show');
            $('#sys_dlg').modal('hide');
            $("#sys_dlg_form").submit(function (e) {
                $("button[name ='bc']").attr("data-dismiss", "modal");
                var formObj = $(this);
                var formURL = formObj.attr("action");
                var formData = new FormData(this);
                $.ajax({
                    url: '/index.php/Admin/Devicemodelparam/submit',
                    type: 'POST',
                    data: formData,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data, textStatus, jqXHR) {
                        $('#loading').modal('hide');
                        if ('' != data) {
                            alert(data);
                        }
                        $('#atpbiztable').bootstrapTable('refresh')
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#loading').modal('hide');
                        alert('创建失败，可能是因为【参数字段】重复，请调整后重新添加');
                        $('#atpbiztable').bootstrapTable('refresh')
                    }
                });
                e.preventDefault();
            });
            $("#sys_dlg_form").submit();
        }
    }

    $('#sys_update').on('click',function() {
        var tablerow = $('#atpbiztable').bootstrapTable('getSelections');
        if(tablerow.length!=1)
        {
            alert("您已多选或者少选，仅能对一条数据进行操作");
        }
        else {
            $("#sys_dlg").load('/index.php/Admin/Devicemodelparam/edit?id=' + tablerow[0]['dmp_atpid'], function() {
                $('#sys_dlg_submit').on('click',submitdata);
                $("#sys_dlg").modal({backdrop: false});
            });
        }
    });


    function updateInRow(id)
    {
        $("#sys_dlg").load('/index.php/Admin/Devicemodelparam/edit?id=' + id, function() {
            $('#sys_dlg_submit').on('click',submitdata);
            $("#sys_dlg").modal({backdrop: false});
        });
    }

    function delInRow(id)
    {
        if (confirm('确认删除数据?')) {
            var ids = [];
            ids.push(id);
            $.post('/index.php/Admin/Devicemodelparam/del', {ids: ids.join(',')}, function (rep, status) {
                if ('' == rep) {
                    $('#atpbiztable').bootstrapTable('refresh')
                }
                else {
                    alert('删除失败' + "可能是因为数据存在关联无法删除<br>错误详情：" + rep);
                }
            });
        }
    }

    $('#sys_del').on('click',function() {
        var tablerow = $('#atpbiztable').bootstrapTable('getSelections');
        if (tablerow.length == 0) {
            alert("您尚未选择数据");
        }
        else {
            if (confirm('确认删除' + tablerow.length + '条数据?')) {
                var ids = [];
                $.each(tablerow, function () {
                    ids.push(this['dmp_atpid']);
                });
                $.post('/index.php/Admin/Devicemodelparam/del', {ids: ids.join(',')}, function (rep, status) {
                    if ('' == rep) {
                        $('#atpbiztable').bootstrapTable('refresh')
                    }
                    else {
                        alert('删除失败' + "可能是因为数据存在关联无法删除<br>错误详情：" + rep);
                    }
                });
            }
        }
    });

    function check(id){
        $("#sys_dlg").load('/index.php/Admin/Devicemodelparam/check?id=' + id, function() {
            $("#sys_dlg").modal({backdrop: false});
        });
    }
    function checkdev(id){
        $("#sys_dlg").load('/index.php/Admin/Devicemodelparam/checkdev?id=' + id, function() {
            $("#sys_dlg").modal({backdrop: false});
        });
    }
    function checkregion(id){
        $("#sys_dlg").load('/index.php/Admin/Devicemodelparam/checkregion?id=' + id, function() {
            $("#sys_dlg").modal({backdrop: false});
        });
    }

    function ATP_FRAME_SECOND_ENTER_CALLBACK()
    {
        $('#atpbiztable').bootstrapTable('refresh');
    }
</script>
</body>

</html>