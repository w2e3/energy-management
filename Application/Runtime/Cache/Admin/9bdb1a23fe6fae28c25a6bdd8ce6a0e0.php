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
                    <i class="fa fa-hand-o-right"></i>&nbsp;当前位置:【审批中心】/【全部数据修改单】
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div id="atpbiztoolbar">
                        <label class="control-label">筛选状态：</label>
                        <select id="search_agreestatus" class="chosen-select2" width="200px;" >
                            <option value="">全部</option>
                            <option value="待审批" >待审批</option>
                            <option value="已通过" >已通过</option>
                            <option value="已打回" >已打回</option>
                            <option value="已取消" >已取消</option>
                        </select>
                        <button class="btn btn-success " type="button" id="sys_search">&nbsp;查询</button>
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
            url: '/index.php/Admin/TwicedataHistory/getData',         //请求后台的URL（*）
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
            showRefresh: true,                  //是否显示刷新按钮
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
                            if(row['d2mdf_agreestatus'] == '未审批'){
                                var inp = "'"+  value +"'";
                                var a = '<a  class="btn btn-info btn-xs" onclick="doshenpi('+ inp +')">审批</a>&nbsp;';
                                 a += '<a  class="btn btn-warning btn-xs" onclick="doxiangqing('+ inp +')">详情</a>&nbsp;';
                                 a += '<a  class="btn btn-danger btn-xs" onclick="dodel('+ inp +')">删除</a>';
                                return a;
                            }else{
                                var inp = "'"+  value +"'";
                                var a = '<a  class="btn btn-warning btn-xs" onclick="doxiangqing('+ inp +')">详情</a>&nbsp;';
//                                <?php echo (session('emp_atpid')); ?>
                                if(row['d2mdf_startempid'] == <?php echo (session('emp_atpid')); ?>)
                                {
                                    a += '<a  class="btn btn-danger btn-xs" onclick="update('+ inp +')">修改</a>&nbsp;';
                                }
                                return a;
                            }
                        }
                    },
                ]
            ],
            onDblClickRow: function (row) {
                doxiangqing(row['d2mdf_atpid']);
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
            search_agreestatus:$("#search_agreestatus").val()
        };
        return temp;
    }

    function submitdata()
    {
        $("#sys_dlg_form").submit(function(e)
        {
            var formObj = $(this);
            var formURL = formObj.attr("action");
            var formData = new FormData(this);
            $.ajax({
                url: '/index.php/Admin/TwicedataHistory/submit',
                type: 'POST',
                data:  formData,
                mimeType:"multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR)
                {
                    $('#atpbiztable').bootstrapTable('refresh')
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    $('#atpbiztable').bootstrapTable('refresh')
                }
            });
            e.preventDefault();
        });
        $("#sys_dlg_form").submit();
    }

    function update(id)
    {
        window.parent.ATP_MENUITEM_OPEN('/index.php/Admin/Twicedatamodify?redatamodify=true&d2mdf_atpid='+id+'&rgn_atpid=<?php echo ($rgn_atpid); ?>') ;
    }

    function doshenpi(id)
    {
        $("#sys_dlg").load('/index.php/Admin/TwicedataHistory/edit?id=' + id, function() {
            $('#sys_dlg_submit').on('click',submitdata);
            $("#sys_dlg").modal({backdrop: false});
        });

    }

    function doxiangqing(id){
         $("#sys_dlg").load('/index.php/Admin/TwicedataHistory/xiangqing?d2mdf_atpid=' + id, function() {
                $('#sys_dlg_submit').on('click',submitdata);
                $("#sys_dlg").modal({backdrop: false});
            });
    }

    function dodel(id)
    {
        if (confirm('确认删除数据?')) {
            var ids = [];
            ids.push(id);
            $.post('/index.php/Admin/TwicedataHistory/del', {ids: ids.join(',')}, function (rep, status) {
                if ('' == rep) {
                    $('#atpbiztable').bootstrapTable('refresh')
                }
                else {
                    alert('删除失败' + "可能是因为数据存在关联无法删除<br>错误详情：" + rep);
                }
            });
        }
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