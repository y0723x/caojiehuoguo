<?php
include_once(realpath("./../../")."\config\db\DbManager.php");
include_once(realpath("./../../")."\pojo\RespBean.php");
include_once(realpath("./../../")."\pojo\Goods.php");
class GoodsService
{
    public function getGoodsListByGoodsIds($goodsIds){
        $dbManager = new DbManager();
        $goodsIds = explode(',',$goodsIds);
        // 将string数组转换成int数组
        $goodsIds = implode(',',$goodsIds);

        $sqlTxt = "SELECT
                        g.id as goodsId,
                        g.goods_url,
                        g.goods_name,
                        g.goods_price
                    FROM
                        t_goods g
                    WHERE
                        g.is_enabled = 1
                    AND
                        g.id in ({$goodsIds})";

        $result = $dbManager->executeSql($sqlTxt);

        // 获取数据
        $goodsList = array();
        while($row = mysqli_fetch_assoc($result)){
            $goods = new Goods($row);
            array_push($goodsList, $goods->show());
        }

        return $goodsList;
    }
}