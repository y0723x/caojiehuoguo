<?php
    require_once ("../../service/OrderService.php");

    header('Content-Type:application/json');

    $shopId = $_GET['shopId'];
    $total = json_decode($_GET['total']);
    $productList = $_GET['goodsList'];
    $tableId = $_SERVER['HTTP_TABLEID'];

    $orderService = new OrderService();

    $resp = $orderService->getSubmitOrder($shopId, $total, $productList, $tableId);

    echo json_encode($resp);