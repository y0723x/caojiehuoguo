<?php
    include_once(realpath("./../../")."\config\db\DbManager.php");
    include_once(realpath("./../../")."\pojo\RespBean.php");
    include_once(realpath("./../../")."\pojo\Table.php");
class TableService
{
    /**
     * 获取所有桌子
     * @return array|RespBean
     */
    public function getTableList(){
        $dbManage = new DbManager();
        $sqlTxt = "SELECT
                        s.id as shopId,
                        s.shop_name,
                        s.shop_url,
                        s.shop_intro,
                        t.` id` as tableId,
                        t.status,
                        t.order_id as orderId,
                        t.table_name as tableName,
                        t.shop_id as shopId
                    FROM
                        t_table t,
                        t_shop s
                    WHERE
                        t.is_enabled = 1
                    AND
                        t.shop_id = s.id";
        $result = $dbManage->executeSql($sqlTxt);

        // 获取数据
        $tableList = array();
        while($row = mysqli_fetch_assoc($result)){
            $table = new Table($row);
            array_push($tableList, $table->show());
        }
//        foreach($result as $row){
//            array_push($tableList, $row);
//        }

        // 关闭连接
        $dbManage->closeConnection($result);

        if ($tableList == null) {
            return RespBean::error("获取tableList失败",$tableList);
//            return $tableList;
        }
        return RespBean::success("获取tableList成功",$tableList);
//        return $tableList;
    }

    public function updateTableStatus($tableId, $orderId){
        $dbManager = new DbManager();
        $conn = $dbManager->getConn();

        $sqlTxt = "update t_table set status = 1, order_id = {$orderId} where ` id` = {$tableId};";

        if(!mysqli_query($conn, $sqlTxt)){
            return 0;
        }
        return 1;
    }

}