<?php
include_once(realpath("./../../")."\config\db\DbManager.php");
include_once(realpath("./../../")."\pojo\RespBean.php");
include_once(realpath("./../../")."\pojo\Order.php");
include_once(realpath("./../../")."\service\GoodsService.php");
include_once(realpath("./../../")."\service\TableService.php");
class OrderService
{
    /**
     * 得到所有订单
     * @return array|RespBean
     */
    public function getAllOrder(){
        $dbManager = new DbManager();
        $sqlTxt = "SELECT 
            o.id as orderId,
            o.status,
            o.goods_ids,
            o.total_count,
            o.total_price,
            o.table_id,
            o.create_time,
            s.id as shopId,
            s.shop_name,
            s.shop_url
        FROM
            t_order o,
            t_shop s
        WHERE
            o.shop_id = s.id
        AND
            o.is_enabled = 1
        AND
            s.is_enabled = 1
        AND
            s.id = 1";

        $result = $dbManager->executeSql($sqlTxt);

        // 获取数据
        $orderList = array();
        while($row = mysqli_fetch_assoc($result)){
            $order = new Order($row);
            array_push($orderList, $order->show());
        }

        // 获取goodsList

        $goodsService = new GoodsService();
        for($i = 0; $i < count($orderList); $i++){
            $goodsIds = $orderList[$i]['goodsIds'];
            $goodsList = $goodsService->getGoodsListByGoodsIds($goodsIds);
            $orderList[$i]['goodsList'] = $goodsList;
        }

        // 关闭连接
        $dbManager->closeConnection($result);

        if ($orderList == null) {
            return RespBean::error("获取orderList失败",$orderList);
        }
        return RespBean::success("获取orderList成功",$orderList);
    }

    /**
     * 订单详情
     * @param $orderId
     * @return array|RespBean
     */
    public function getOrderDetail($orderId){
        $dbManager = new DbManager();
        $sqlTxt = "SELECT
                        s.id as shopId,
                        s.shop_name,
                        o.id as orderId,
                        o.status,
                        o.goods_ids,
                        o.table_id,
                        o.total_price,
                        o.total_count,
                        og.id as orderGoodsId,
                        og.goods_count,
                        g.id as goodsId,
                        g.goods_url,
                        g.goods_name,
                        g.goods_price,
                        g.goods_intro
                    FROM
                        t_order o,
                        t_order_goods og,
                        t_goods g,
                        t_shop s
                    WHERE
                        o.id = og.order_id
                    AND
                        og.goods_id = g.id
                    AND
                        o.shop_id = s.id
                    AND 
                        s.is_enabled = 1
                    AND 
                        g.is_enabled = 1
                    AND
                        o.is_enabled = 1
                    AND
                        og.is_enabled = 1
                    AND
                        o.id = {$orderId}";

        $result = $dbManager->executeSql($sqlTxt);

        // 获取数据
        $orderGoodsList = array();
        while($row = mysqli_fetch_assoc($result)){
            $order = new Order($row);
            array_push($orderGoodsList, $order->show());
        }

        // 获取goodsList
        $goodsService = new GoodsService();
        $goodsIds = $orderGoodsList[0]['goodsIds'];
        $goodsList = $goodsService->getGoodsListByGoodsIds($goodsIds);

        // 处理数据
        // 将count放在各自goods中
        for($i = 0; $i < count($orderGoodsList); $i++){
            for($j = 0; $j < count($goodsList); $j++){
                if($orderGoodsList[$i]['orderGoods']['goodsId'] == $goodsList[$j]['goodsId']){
                    $goodsList[$j]['goodsCount'] = $orderGoodsList[$i]['orderGoods']['goodsCount'];
                }
            }
        }

        $orderDetail = array('orderId'=>$orderGoodsList[0]['orderId'], 'status'=>$orderGoodsList[0]['status'],
            'tableId'=>$orderGoodsList[0]['tableId'], 'shop'=>$orderGoodsList[0]['shop'], 'goodsList'=>$goodsList,
            'totalCount'=>$orderGoodsList[0]['totalCount'], 'totalPrice'=>$orderGoodsList[0]['totalPrice']
        );

        // 关闭连接
        $dbManager->closeConnection($result);

        if ($orderDetail == null) {
            return RespBean::error("获取orderDetail失败",$orderDetail);
        }
        return RespBean::success("获取orderDetail成功",$orderDetail);
    }

    /**
     * 更新table和order状态
     * @param $orderId
     * @param $choice
     * @param $tableId
     * @return array|RespBean
     */
    public function getPayOrCancelOrder($orderId, $choice, $tableId){
        $dbManager = new DbManager();
        // 获取status
//        $orderStatus = 0;
//        $tableStatus = 1;

        if ($choice == 'pay') {
            $orderStatus = 1;
            $tableStatus = 0;
        } else if ($choice == 'cancel') {
            $orderStatus = 2;
            $tableStatus = 0;
        } else {
            $orderStatus = 3;
        }

        $conn = $dbManager->getConn();

        $tableId = number_format($tableId);

        // 更新订单status
        $sqlTxt = "update t_order set status = {$orderStatus} where id = {$orderId} ;";

        // 更新桌子status
        $sqlTxt .= "update t_table set status = {$tableStatus}, order_id = 0 where ` id` = {$tableId} ;";

        // 同时多个update操作
        if(!(mysqli_multi_query($conn,$sqlTxt))){
            return RespBean::error("更新状态失败", null);
        }

//        $dbManager->closeConnection($result);

        return RespBean::success("更新状态成功", null);
    }

    public function getSubmitOrder($shopId, $total, $productList, $tableId){
        $dbManager = new DbManager();
        $conn = $dbManager->getConn();

        // 准备参数
        $totalPrice = $total->totalPrice;
        $totalCount = $total->totalCount;
//        $createTime = date("Y-m-d");

        $goodsIds = array();
        for($i = 0; $i < count($productList); $i++){
            array_push($goodsIds, json_decode($productList[$i])->goodsId);
        }
        // string数组转换成string
        $goodsIds = implode(',',$goodsIds);

        // 添加t_order
        $sqlTxt = "insert into t_order (status, goods_ids, is_enabled, shop_id, table_id, total_price, total_count)
            values (0, '{$goodsIds}', 1, {$shopId}, {$tableId}, {$totalPrice}, {$totalCount});
        ";

        if(!(mysqli_query($conn, $sqlTxt))){
            return RespBean::error('添加order失败',$goodsIds);
        }

        // 获取最后一个订单
        $lastOrder = $this->getLastOrderByTableId($tableId);
        $lastOrderId = $lastOrder['orderId'];

        // 添加t_order_goods
        $sqlTxt = "";
        for($i = 0; $i < count($productList); $i++){
            $product = json_decode($productList[$i]);
            $sqlTxt .= "insert into t_order_goods (order_id, goods_id, goods_count, is_enabled) values
                ({$lastOrderId}, {$product->goodsId}, {$product->count}, 1);";
        }

        // 同时多个insert操作
        if(!(mysqli_multi_query($conn,$sqlTxt))){
            return RespBean::error("添加失败", $lastOrderId);
        }

        // 添加完后还要更新table状态(status,orderId)，即（在使用状态）
        $tableService = new TableService();
        $res = $tableService->updateTableStatus($tableId, $lastOrderId);
        if(!$res){
            return RespBean::success("更新table状态失败", null);
        }

        return RespBean::success("添加成功", $lastOrderId);
    }

    /**
     * 返回最后一个订单
     * @param $tableId
     * @return false|mixed
     */
    public function getLastOrderByTableId($tableId){
        $dbManager = new DbManager();
        $sqlTxt = "SELECT
                        o.id as orderId,
                        o.create_time
                    FROM
                        t_order o
                    WHERE
                        o.is_enabled = 1
                    AND
                        o.table_id = ".$tableId;

        $result = $dbManager->executeSql($sqlTxt);

        $orderList = array();
        while($row = mysqli_fetch_assoc($result)){
            $order = new Order($row);
            array_push($orderList, $order->show());
        }

        $dbManager->closeConnection($result);

        $lastOrder = end($orderList);

        return $lastOrder;
    }
}