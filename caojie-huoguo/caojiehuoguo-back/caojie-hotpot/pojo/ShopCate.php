<?php
include_once(realpath("./../../")."\pojo\Goods.php");
class ShopCate
{
    private $id;
    private $shopId;
    private $cateName;
    private $goodsIds;
    private $isEnabled;
    private $goods;

    public function __construct($row){
        $this->id = $row['shopCateId'];
        $this->cateName = $row['cate_name'];
        $this->goods = (new Goods($row))->show();
    }

    public function show(){
        return array("shopCateId"=>$this->id,"cateName"=>$this->cateName,"goods"=>$this->goods);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param mixed $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @return mixed
     */
    public function getCateName()
    {
        return $this->cateName;
    }

    /**
     * @param mixed $cateName
     */
    public function setCateName($cateName)
    {
        $this->cateName = $cateName;
    }

    /**
     * @return mixed
     */
    public function getGoodsIds()
    {
        return $this->goodsIds;
    }

    /**
     * @param mixed $goodsIds
     */
    public function setGoodsIds($goodsIds)
    {
        $this->goodsIds = $goodsIds;
    }

    /**
     * @return mixed
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param mixed $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return array
     */
    public function getGoods()
    {
        return $this->goods;
    }

    /**
     * @param array $goods
     */
    public function setGoods($goods)
    {
        $this->goods = $goods;
    }


}