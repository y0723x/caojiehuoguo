<?php
include_once(realpath("./../../")."\config\db\DbManager.php");
include_once(realpath("./../../")."\pojo\ShopCate.php");
class ShopCateService
{
    public function getAllCatesByShopId($shopId){
        $dbManager = new DbManager();
        $sqlTxt = "SELECT
                        sc.id as shopCateId,
                        sc.cate_name
                    FROM
                        t_shop_cate sc
                    WHERE
                        sc.is_enabled = 1
                    AND
                        sc.shop_id = ".$shopId;
        $result = $dbManager->executeSql($sqlTxt);

        $cateList = array();
        while($row = mysqli_fetch_assoc($result)){
            $shopCate = new ShopCate($row);
            $shopCate->setGoods(array());
            array_push($cateList, $shopCate->show());
        }

        $dbManager->closeConnection($result);

        return $cateList;
    }
}