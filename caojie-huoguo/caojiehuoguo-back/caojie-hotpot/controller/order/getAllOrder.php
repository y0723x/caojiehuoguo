<?php
    require_once ("../../service/OrderService.php");

    header('Content-Type:application/json');

    $orderService = new OrderService();

    $resp = $orderService->getAllOrder();

    echo json_encode($resp);
