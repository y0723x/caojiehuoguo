<?php
    require_once ("../../service/TableService.php");
//    require_once ("../../pojo/RespBean.php");
    header('Content-Type:application/json');

    $tableService = new TableService();

    $resp = $tableService->getTableList();

//    echo json_encode($tableService->getTableList(),JSON_UNESCAPED_UNICODE);
//    if ($tableList == null) {
//        echo json_encode(RespBean::error("获取tableList失败",$tableList));
//    }
//    echo json_encode(RespBean::success("获取tableList成功",$tableList));
    echo json_encode($resp);