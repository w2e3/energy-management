<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
    <base target="_blank">
    <style>
        .float-e-margins .btn
        {
            margin-bottom: 1px;
        }
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content" style="padding: 10px 10px 10px 10px;margin-bottom: -15px;">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <i class="fa fa-hand-o-right"></i>&nbsp;当前位置:【审批中心】/【数据修改单审批】
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div id="atpbiztoolbar">
                    </div>
                    <table id="atpbiztable" ></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="sys_dlg" role="dialog" class="modal fade "></div>

<script src="/Public/vendor/bootstrap-table/jquery.min.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/vendor/My97DatePicker/WdatePicker.js"></script>
<script src="/Public/adminframework/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/adminframework/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
<script src="/Public/adminframework/js/plugins/switchery/switchery.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap-table/src/bootstrap-table.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>

<script>
    $(function () {
        $('#atpbiztable').bootstrapTable({
            url: '/index.php/Admin/Twicedatasp/getData',         //请求后台的URL（*）
            method: 'post',                      //请求方式（*）
            toolbar: '#atpbiztoolbar',                //工具按钮用哪个容器
            striped: true,                      //是否显示行间隔色
            cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
            pagination: true,                   //是否显示分页（*）
            iconSize: 'outline',
            sortable: true,                     //是否启用排序
            sortName:"d2mdf_startdt",
            sortOrder: "desc",                   //排序方式
            queryParams: queryParams,//传递参数（*）
            sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                       //初始化加载第一页，默认第一页
            pageSize: 10,                       //每页的记录行数（*）
            pageList: [5,10, 25, 50, 100],        //可供选择的每页的行数（*）
            search: false,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
//            strictSearch: true,
            showColumns: false,                  //是否显示所有的列
            showRefresh: false,                  //是否显示刷新按钮
            minimumCountColumns: 2,             //最少允许的列数
            clickToSelect: true,                //是否启用点击选中行
//            height: 600,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
            uniqueId: "d2mdf_atpid",                     //每一行的唯一标识，一般为主键列
//            showToggle: true,                    //是否显示详细视图和列表视图的切换按钮
//            cardView: true,                    //是否显示详细视图
            detailView: false,                   //是否显示父子表
            detailFormatter: "detailFormatter",
            height:510,
            columns: [
                [
                    {title: '序号', width: 40,
                        formatter: function (value, row, index)
                        {
                            var option =  $('#atpbiztable').bootstrapTable("getOptions");
                            return option.pageSize * (option.pageNumber - 1) + index + 1;
                        }
                    },
                    {field: 'd2mdf_name', title: '名称', sortable: true},
                    {field: 'd2mdf_desc', title: '描述', sortable: true},
                    {field: 'startempname', title: '发起人', sortable: true},
                    {field: 'd2mdf_startdt', title: '发起时间', sortable: true},
                    {field: 'agreeempname', title: '审批人', sortable: false},
                    {field: 'd2mdf_agreeempdt', title: '审批时间', sortable: true},
                    {field: 'd2mdf_agreestatus', title: '审批状态', sortable: false},
                    {field: 'd2mdf_remark', title: '审批备注', sortable: false},
                    {field: 'd2mdf_agreebackinfo', title: '打回意见', sortable: false},

                    {field:'d2mdf_atpid',title:'主键',visible:false},
                    {field:'d2mdf_atpcreatedatetime',title:'创建时间',visible:false},
                    {field:'d2mdf_atpcreateuser',title:'创建人',visible:false},
                    {field:'d2mdf_atplastmodifydatetime',title:'最后修改时间',visible:false},
                    {field:'d2mdf_atplastmodifyuser',title:'最后修改人',visible:false},
                    {field:'d2mdf_atpstatus',title:'数据状态',visible:false},
                    {field:'d2mdf_atpsort',title:'数据排序',visible:false},
                    {field:'d2mdf_atpremark',title:'数据备注',visible:false},
                    {field: 'd2mdf_atpid', title: '操作',align:'center', sortable: false,
                        formatter: function (value, row, index) {
                            var inp = "'"+  value +"'";
                            var a = '<a  class="btn btn-info btn-xs" onclick="doshenpi('+ inp +')">审批</a>&nbsp;';
                            return a;
                        }
                    },
                ]
            ],
            onDblClickRow: function (row) {
                doshenpi(row['d2mdf_atpid']);
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
            sort: params.sort,  //排序列名
            sortOrder: params.order,//排位命令（desc，asc）
        };
        return temp;
    }

    function submitdatapass()
    {
        if (confirm('确认同意?')) {
            $('#sys_dlg').modal('hide');
            $("#sys_dlg_form").submit(function (e) {
                var formObj = $(this);
                var formURL = formObj.attr("action");
                var formData = new FormData(this);
                $.ajax({
                    url: '/index.php/Admin/Twicedatasp/submitpass',
                    type: 'POST',
                    data: formData,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data, textStatus, jqXHR) {
                        alert("操作成功");
                        $('#atpbiztable').bootstrapTable('refresh')
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#atpbiztable').bootstrapTable('refresh')
                    }
                });
                e.preventDefault();
            });
            $("#sys_dlg_form").submit();
        }
    }

    function submitdataback() {
        if (confirm('确认打回?')) {
            $('#sys_dlg').modal('hide');
            $("#sys_dlg_form").submit(function (e) {
                var formObj = $(this);
                var formURL = formObj.attr("action");
                var formData = new FormData(this);
                $.ajax({
                    url: '/index.php/Admin/Twicedatasp/submitback',
                    type: 'POST',
                    data: formData,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data, textStatus, jqXHR) {
                        alert("操作成功");
                        $('#atpbiztable').bootstrapTable('refresh')
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#atpbiztable').bootstrapTable('refresh')
                    }
                });
                e.preventDefault();
            });
            $("#sys_dlg_form").submit();
        }
    }


    function doshenpi(id) {
        $("#sys_dlg").load('/index.php/Admin/Twicedatasp/shenpi?d2mdf_atpid=' + id, function () {
            $('#sys_dlg_pass').on('click', submitdatapass);
            $('#sys_dlg_back').on('click', submitdataback);
            $("#sys_dlg").modal({backdrop: false});
        });
    }


    $('#sys_search').on('click',function() {
        $('#atpbiztable').bootstrapTable('refresh')
    });

    $(function () {
        $(".chosen-select2").chosen({disable_search_threshold: 10, search_contains: true, width:'150px'});
    });

</script>
</body>
</html>