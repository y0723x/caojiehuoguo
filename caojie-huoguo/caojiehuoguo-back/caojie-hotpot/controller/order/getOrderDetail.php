<?php
    require_once ("../../service/OrderService.php");

    header('Content-Type:application/json');

    $orderId = $_GET['orderId'];

    $orderService = new OrderService();

    $resp = $orderService->getOrderDetail($orderId);

    echo json_encode($resp);