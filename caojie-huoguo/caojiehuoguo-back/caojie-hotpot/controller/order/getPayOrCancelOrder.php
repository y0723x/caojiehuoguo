<?php
    require_once ("../../service/OrderService.php");

    header('Content-Type:application/json');

    $orderId = $_GET['orderId'];
    $choice = $_GET['choice'];
    $tableId = $_GET['tableId'];

    $orderService = new OrderService();

    $resp = $orderService->getPayOrCancelOrder($orderId, $choice, $tableId);

    echo json_encode($resp);