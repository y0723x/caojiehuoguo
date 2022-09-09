<?php
    require_once ("../../service/ShopService.php");

    header('Content-Type:application/json');

    $shopService = new ShopService();

    $resp = $shopService->getShopDetail();

    echo json_encode($resp);