<?php
    include_once(realpath("./../../")."\config\db\DbManager.php");
    include_once(realpath("./../../")."\pojo\RespBean.php");
    include_once(realpath("./../../")."\pojo\Shop.php");
    include_once(realpath("./../../")."\pojo\ShopCate.php");
    include_once(realpath("./../../")."\pojo\Goods.php");
    include_once ("../../service/ShopCateService.php");
class ShopService
{
    public function getShopDetail(){
        $shopId = $_GET['shopId'];
        $dbManager = new DbManager();
        $shopCateService = new ShopCateService();
        $sqlTxt = "SELECT
                        s.id as shopId,
                        s.shop_url,
                        s.shop_name,
                        s.shop_address,
                        s.shop_intro,
                        s.shop_distribution,
                        sc.id as shopCateId,
                        sc.cate_name,
                        g.id as goodsId,
                        g.goods_url,
                        g.goods_name,
                        g.goods_intro,
                        g.goods_price,
                        g.cate_id
                    FROM
                        t_shop s,
                        t_shop_cate sc,
                        t_goods g
                    WHERE
                        s.is_enabled = 1
                    AND
                        sc.is_enabled = 1 
                    AND
                        g.is_enabled = 1
                    AND
                        s.id = sc.shop_id
                    AND
                        sc.id = g.cate_id
                    AND
                        s.id = ".$shopId.";";
        $result = $dbManager->executeSql($sqlTxt);

        // 获取数据
        $cateList = $shopCateService->getAllCatesByShopId($shopId);
        $catesWithGoods = array();
        while($row = mysqli_fetch_assoc($result)){
            $shop = new Shop($row);
            array_push($catesWithGoods, $shop->show());
        }

        // 处理数据
        // 得到所有产品
        $goodsList = array();
        for($i = 0; $i < count($catesWithGoods); $i++ ){
            array_push($goodsList, $catesWithGoods[$i]['cate']['goods']);
        }

        // 将产品放在所属类下
        for ($i = 0; $i < count($cateList); $i++) {
            $cate = $cateList[$i];
            for($j = 0; $j < count($goodsList); $j++){
                $goods = $goodsList[$j];
                if ($cate['shopCateId'] == $goods['cateId']) {
                    array_push($cateList[$i]['goods'], $goods);
                }
            }
        }

        // 将分类放在shop中
        $shop = array('shopId'=>$catesWithGoods[0]['shopId'], 'shopName'=>$catesWithGoods[0]['shopName'],
            'shopIntro'=>$catesWithGoods[0]['shopIntro'], 'shopUrl'=>$catesWithGoods[0]['shopUrl'],
            'shopAddress'=>$catesWithGoods[0]['shopAddress'], 'shopDistribution'=>$catesWithGoods[0]['shopDistribution'],
            'cateList'=>$cateList
            );

        // 关闭连接
        $dbManager->closeConnection($result);

        if ($catesWithGoods == null) {
            return RespBean::error("获取catesWithGoods失败",$catesWithGoods);
        }
        return RespBean::success("获取catesWithGoods成功",$shop);
    }
}