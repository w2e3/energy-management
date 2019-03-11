<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
        /*.main-left{width: 20%;float: left;background-color: #fff}*/
        /*.main-right{width: 79%;float: left; margin-left:1%}*/
        .main-left{width: 200px;float: left;background-color: #fff}
        .main-right{ margin-left:220px;overflow: hidden;}
        /*.fixed-table-container tbody .selected td {*/
            /*background-color: yellow;*/
        /*}*/

        /*.table-hover > tbody > tr:hover > td,*/
        /*.table-hover > tbody > tr:hover > th {*/
            /*background-color: yellow;*/
        /*}*/
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
    <style type="text/css">
        .ztree li button.switch {visibility:hidden; width:1px;}
        .ztree li button.switch.roots_docu {visibility:visible; width:16px;}
        .ztree li button.switch.center_docu {visibility:visible; width:16px;}
        .ztree li button.switch.bottom_docu {visibility:visible; width:16px;}
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content" style="padding: 10px 10px 10px 10px;margin-bottom: -15px;">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <i class="fa fa-hand-o-right"></i>&nbsp;当前位置:【基础数据管理】/【园区管理】
                </div>
            </div>
        </div>
    </div>
    <div class="main-left">
        <div class="content_wrap" style="width: 100%;height: 100%;overflow: auto">
            <ul id="treeDemo" class="ztree"></ul>
        </div>
    </div>
    <div class="main-right">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div id="atpbiztoolbar">
                        <button class="btn btn-info" type="button" id="sys_add_root"><i class="fa fa-pencil"></i>&nbsp;添加根节点</button>
                        <button class="btn btn-info" type="button" id="sys_add_child"><i class="fa fa-pencil"></i>&nbsp;添加子节点</button>
                        <button class="btn btn-info" type="button" id="sys_update"><i class="fa fa-pencil-square"></i>&nbsp;更新节点</button>
                        <button class="btn btn-danger" type="button" id="sys_del"><i class="fa fa-eraser"></i>&nbsp;批量删除</button>
                    </div>
                    <table id="atpbiztable" style="width: 1400px"></table>
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


<script src="/Public/vendor/bootstrap-table/jquery.min.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/vendor/My97DatePicker/WdatePicker.js"></script>
<script src="/Public/adminframework/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/adminframework/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
<script src="/Public/adminframework/js/plugins/switchery/switchery.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap-table/src/bootstrap-table.js"></script>
<script src="/Public/vendor/bootstrap-table/bootstrap-table/src/locale/bootstrap-table-zh-CN-atp.js"></script>
<script type="text/javascript" src="/Public/vendor/zTree_v3/js/jquery.ztree.core.js"></script>
<script src="/Public/vendor/html5Validate/src/jquery-html5Validate.js"></script>
<script>
    // 托选
    var mousedownleft, btnmarginleft, flagFollow = false;
    $(".bar_btn").bind({
        "mousedown": function(e) {
            mousedownleft = e.pageX;
            btnmarginleft = parseInt($(this).css("marginLeft")) || 0;
            flagFollow = $(this);
        }
    });
    $(document).bind({
        "mousemove": function(e) {
            var nowmouseleft = e.pageX, finalposleft = nowmouseleft - mousedownleft + btnmarginleft;
            if (flagFollow) {
                if (finalposleft > 190) {
                    finalposleft = 190;
                } else if (finalposleft < -10) {
                    finalposleft = -10;
                }
                var score = Math.round((finalposleft + 10) / 40);
                flagFollow.css("marginLeft", finalposleft).attr("data-content", score);
                $("#" + flagFollow.attr("data-rel")).val(score);
            }
        },
        "mouseup": function() {
            flagFollow = false;
        }
    });
</script>
<SCRIPT type="text/javascript">
    <!--
    RGN_ATPID="";
    var setting = {
        view: {
            dblClickExpand: false,
            showLine: false
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "pid",
                rootPId: null
            }
        },
        callback: {
            beforeExpand: beforeExpand,
            onExpand: onExpand,
            onClick: onClick
        }
    };
    var zNodes = <?php echo ($treedatas); ?>;
    selectzNodes = null;

    var curExpandNode = null;
    function beforeExpand(treeId, treeNode) {
        var pNode = curExpandNode ? curExpandNode.getParentNode():null;
        var treeNodeP = treeNode.parentTId ? treeNode.getParentNode():null;
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        for(var i=0, l=!treeNodeP ? 0:treeNodeP.children.length; i<l; i++ ) {
            if (treeNode !== treeNodeP.children[i]) {
                zTree.expandNode(treeNodeP.children[i], false);
            }
        }
        while (pNode) {
            if (pNode === treeNode) {
                break;
            }
            pNode = pNode.getParentNode();
        }
        if (!pNode) {
            singlePath(treeNode);
        }

    }
    function singlePath(newNode) {
        if (newNode === curExpandNode) return;

        var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
            rootNodes, tmpRoot, tmpTId, i, j, n;

        if (!curExpandNode) {
            tmpRoot = newNode;
            while (tmpRoot) {
                tmpTId = tmpRoot.tId;
                tmpRoot = tmpRoot.getParentNode();
            }
            rootNodes = zTree.getNodes();
            for (i=0, j=rootNodes.length; i<j; i++) {
                n = rootNodes[i];
                if (n.tId != tmpTId) {
                    zTree.expandNode(n, false);
                }
            }
        } else if (curExpandNode && curExpandNode.open) {
            if (newNode.parentTId === curExpandNode.parentTId) {
                zTree.expandNode(curExpandNode, false);
            } else {
                var newParents = [];
                while (newNode) {
                    newNode = newNode.getParentNode();
                    if (newNode === curExpandNode) {
                        newParents = null;
                        break;
                    } else if (newNode) {
                        newParents.push(newNode);
                    }
                }
                if (newParents!=null) {
                    var oldNode = curExpandNode;
                    var oldParents = [];
                    while (oldNode) {
                        oldNode = oldNode.getParentNode();
                        if (oldNode) {
                            oldParents.push(oldNode);
                        }
                    }
                    if (newParents.length>0) {
                        zTree.expandNode(oldParents[Math.abs(oldParents.length-newParents.length)-1], false);
                    } else {
                        zTree.expandNode(oldParents[oldParents.length-1], false);
                    }
                }
            }
        }
        curExpandNode = newNode;
    }
    function onExpand(event, treeId, treeNode) {
        curExpandNode = treeNode;
    }
    function onClick(e,treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.expandNode(treeNode, null, null, null, true);
        selectzNodes = treeNode;
        if ('园区' == treeNode.type) {
            RGN_ATPID = treeNode.id;
            $('#atpbiztable').bootstrapTable('refresh')
        }
    }

    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });
    //-->
</SCRIPT>
<script>
    GLOBAL_SEARCHNAME = "名称";
    $(function () {
        $('#atpbiztable').bootstrapTable({
            url: '/index.php/Admin/Region/getData',         //请求后台的URL（*）
            method: 'post',                      //请求方式（*）
            toolbar: '#atpbiztoolbar',                //工具按钮用哪个容器
            striped: false,                      //是否显示行间隔色
            cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
            pagination: true,                   //是否显示分页（*）
            iconSize: 'outline',
            sortable: true,                     //是否启用排序
            sortName:"",
            sortOrder: "",                   //排序方式
            queryParams: queryParams,//传递参数（*）
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
            uniqueId: "rgn_atpid",                     //每一行的唯一标识，一般为主键列
//            showToggle: true,                    //是否显示详细视图和列表视图的切换按钮
//            cardView: true,                    //是否显示详细视图
            detailView: false,                   //是否显示父子表
            detailFormatter: "detailFormatter",
            height:510,
            columns: [
                [
                    {checkbox: true},
                    {title: '序号', width: 40,align:'center',
                        formatter: function (value, row, index)
                        {
                            var option =  $('#atpbiztable').bootstrapTable("getOptions");
                            return option.pageSize * (option.pageNumber - 1) + index + 1;
                        }
                    },

//                    {field: 'rgn_pregionid', title: '关联父组织', align:'center', valign:'middle',sortable: true},
                    {field: 'rgn_name', title: '名称', align:'center', valign:'middle',sortable: true},
//                    {field: 'rgn_codename', title: '代号', align:'center', valign:'middle',sortable: true},
                    {field: 'rgn_category', title: '类别', align:'center', valign:'middle',sortable: true},
                    {field: 'rgn_buildstatus', title: '使用类别', align:'center', valign:'middle',sortable: true},
                    {field: 'rgn_floorstatus', title: '楼宇状态', align:'center', valign:'middle',sortable: true},
                    {field: 'rgn_area', title: '面积', align:'center', valign:'middle',sortable: true,
                        formatter: function (value, row, index) {
                            var a = row['rgn_area'] + ' m²';
                            if (null == value || '' == value) {
                                return '';
                            }
                            else {
                                return a;
                            }
                        }
                    },
                    {field: 'rgn_location', title: '位置备注', align:'center', valign:'middle',sortable: true},
//                    {field: 'rg_picture', title: '平面图', align:'center', valign:'middle',sortable: true,
//                        formatter: function (value, row, index) {
//                            var a = '<img src="/Public/uploads/' + value + '" width="50px" /><br/>';
//                            if (null == value || '' == value) {
//                                return '<img src="/Public/uploads/default.png" width="50px" /><br/>';
//                            }
//                            else {
//                                return a;
//                            }
//                        }
//                    },
                    {field: 'energytype', title: '能源类别', align:'center', valign:'middle',sortable: true,
                        formatter: function (value, row, index) {
                            var inp = "'"+  row.et_atpid +"'";
                            var value = value;
                            if (null != value){
                                var a = '<a>'+value+'</a>&nbsp;<br>';
                            }
                            return a;
                        }
                    },
//                    {field: 'dev_name', title: '设备卡片', align:'center', valign:'middle',sortable: true,
//                        formatter: function (value, row, index) {
//                            var inp = "'"+  row.dev_atpid +"'";
//                            var value = value;
//                            if (null != value){
//                                var a = '<a onclick="checkdevice ('+ inp +')">'+value+'</a>&nbsp;<br>';
//                            }
//                            return a;
//                        }
//                    },

                    {field:'rgn_atpid',title:'主键',visible:false},
                    {field:'rgn_pregionid',title:'父级',visible:false},
                    {field:'rgn_atpcreatedatetime',title:'创建时间',visible:false},
                    {field:'rgn_atpcreateuser',title:'创建人',visible:false},
                    {field:'rgn_atplastmodifydatetime',title:'最后修改时间',visible:false},
                    {field:'rgn_atplastmodifyuser',title:'最后修改人',visible:false},
                    {field:'rgn_atpstatus',title:'数据状态',visible:false},
                    {field:'rgn_atpsort',title:'数据排序',visible:false},
                    {field:'rgn_atpremark',title:'数据备注',visible:false},
                    {field: 'rgn_atpid', title: '操作',align:'center', sortable: false,width:100,
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
                $("#sys_dlg").load('/index.php/Admin/Region/edit?id=' + row['rgn_atpid'], function() {
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
//            u_name: $("#search_u_name").val(),
//            u_type: $("#search_u_type").val(),
            rgn_atpid: RGN_ATPID,
            sort: params.sort,  //排序列名
            sortOrder: params.order//排位命令（desc，asc）
        };
        return temp;
    }

    $('#sys_add_root').on('click',function(){
        $("#sys_dlg").load('/index.php/Admin/Region/addroot', function() {
            $('#sys_dlg_submit').on('click', submitdata);
            $("#sys_dlg").modal({backdrop: false});
        });
    });
    $('#sys_add_child').on('click',function(){
        if(null==RGN_ATPID || ''==RGN_ATPID)
        {
            alert("请先选所在组织后再进行添加操作！");
        }
        else{
            $("#sys_dlg").load('/index.php/Admin/Region/addchild?rgn_atpid='+RGN_ATPID, function() {
                $('#sys_dlg_submit').on('click', submitdata);
                $("#sys_dlg").modal({backdrop: false});
            });
        }
    });
    function submitdata()
    {
        if ($.html5Validate.isAllpass($("#sys_dlg_form")))
        {
            $('#sys_dlg').modal('hide');
            $("#sys_dlg_form").submit(function(e)
            {
                var formObj = $(this);
                var formURL = formObj.attr("action");
                var formData = new FormData(this);//console.log(formData);
                $.ajax({
                    url: '/index.php/Admin/Region/submit',
                    type: 'POST',
                    data:  formData,
                    mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data, textStatus, jqXHR)
                    {
                        if('shebeidian' == data){
                            $('#atpbiztable').bootstrapTable('refresh')
                        }else if('yuanqu' == data){
                            $('#atpbiztable').bootstrapTable('refresh')
                            refreashtree();
                        }
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
    }

    $('#sys_update').on('click',function() {
        $("#loadingText").html("正在处理请稍后<br>本弹出框会在大概5秒左右自动关闭,表示处理完成");
        $('#loading').modal('show');
            $.get('/index.php/Admin/Region/updatenode',function(data,rep){
                $('#loading').modal('hide');
                alert(data);
           
            })
           
    });

    function updateInRow(id)
    {
        $("#sys_dlg").load('/index.php/Admin/Region/edit?id=' + id, function() {
            $('#sys_dlg_submit').on('click',submitdata);
            $("#sys_dlg").modal({backdrop: false});
        });
    }

    function delInRow(id)
    {
        if (confirm('园区节点数据属于重要数据，确认删除数据?')) {
            if(confirm('将要删除属于该节点后的所有节点,确认删除数据?')){
                var ids = [];
                ids.push(id);
                $.post('/index.php/Admin/Region/del', {ids: ids.join(',')}, function (rep, status) {
                    if ('' == rep) {
                        refreashtree();
                        $('#atpbiztable').bootstrapTable('refresh')
                    }
                    else {
                        alert('删除失败' + "可能是因为数据存在关联无法删除<br>错误详情：" + rep);
                    }
                });
            }
        }
    }

    $('#sys_del').on('click',function() {
        var tablerow = $('#atpbiztable').bootstrapTable('getSelections');
        if (tablerow.length == 0) {
            alert("您尚未选择数据");
        }
        else {
            if (confirm('园区节点数据属于重要数据，确认删除' + tablerow.length + '条数据?')) {
                if(confirm('将要删除属于该节点后的所有节点,确认删除数据?')){
                    var ids = [];
                    $.each(tablerow, function () {
                        ids.push(this['rgn_atpid']);
                    });
                    $.post('/index.php/Admin/Region/del', {ids: ids.join(',')}, function (rep, status) {
                        if ('' == rep) {
                            // location.reload();
                            refreashtree();
                            $('#atpbiztable').bootstrapTable('refresh')
                        }
                        else {
                            alert('删除失败' + "可能是因为数据存在关联无法删除<br>错误详情：" + rep);
                        }
                    });
                }
            }
        }
    });


    function refreashtree()
    {
        $.ajax({
            url: '/index.php/Admin/Region/regiontree',
            type: 'POST',
            data:  null,
            success: function(data, textStatus, jqXHR)
            {
                var tzNodes = $.parseJSON( data );
                $.fn.zTree.init($("#treeDemo"), setting, tzNodes);
                zTree = $.fn.zTree.getZTreeObj("treeDemo");
//                var node = zTree.getNodeByParam("id","guidEAADAB5F-707E-44A6-A04E-803D1B2716DF");
//                console.log(selectzNodes);
                var node = selectzNodes;
                var parent = node.getParentNode();
                zTree.expandNode(parent,true,true);
                zTree.selectNode(node);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });
    }


    function check(id){
        $("#sys_dlg").load('/index.php/Admin/Region/check?id=' + id, function() {
            $("#sys_dlg").modal({backdrop: false});
        });
    }
    function checkdevice(id){
        $("#sys_dlg").load('/index.php/Admin/Region/checkdevice?id=' + id, function() {
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