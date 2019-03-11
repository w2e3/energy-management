<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="/Public/vendor/diy_component/yuanqu_page/css/bootstrap.css">
    <link rel="stylesheet" href="/Public/vendor/diy_component/yuanqu_page/css/bootstrap-table.css">
</head>
<body>
    <table class="table table-hover table-bordered">
        <tr>
            <th>序号</th>
            <th>能源类型</th>
            <th>本日</th>
            <th>本月</th>
            <th>本年</th>
        </tr>
        <tr>
            <td>1</td>
            <td>电能</td>
            <td><?php echo ($dayaccu["d2d_dglaccu"]); ?>Kwh</td>
            <td><?php echo ($monthaccu["d2m_dglaccu"]); ?>Kwh</td>
            <td><?php echo ($yaaraccu["d2y_dglaccu"]); ?>Kwh</td>
        </tr>
        <tr>
            <td>2</td>
            <td>水能</td>
            <td><?php echo ($dayaccu["d2d_syslaccu"]); ?>T</td>
            <td><?php echo ($monthaccu["d2m_syslaccu"]); ?>T</td>
            <td><?php echo ($yaaraccu["d2y_syslaccu"]); ?>T</td>
        </tr>
        <tr>
            <td>3</td>
            <td>暖能</td>
            <td><?php echo ($dayaccu["d2d_ynlaccu"]); ?>Kwh</td>
            <td><?php echo ($monthaccu["d2m_ynlaccu"]); ?>Kwh</td>
            <td><?php echo ($yaaraccu["d2y_ynlaccu"]); ?>Kwh</td>
        </tr>
        <tr>
            <td>4</td>
            <td>冷能</td>
            <td><?php echo ($dayaccu["d2d_yllaccu"]); ?>Kwh</td>
            <td><?php echo ($monthaccu["d2m_yllaccu"]); ?>Kwh</td>
            <td><?php echo ($yaaraccu["d2y_yllaccu"]); ?>Kwh</td>
        </tr>
    </table>
</body>
</html>