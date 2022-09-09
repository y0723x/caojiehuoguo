<?php
include_once(realpath("./../../")."\pojo\Shop.php");
include_once(realpath("./../../")."\pojo\OrderGoods.php");
class Order
{
    private $id;
    private $status;
    private $goodsIds;
    private $isEnabled;
    private $shopId;
    private $totalPrice;
    private $totalCount;
    private $tableId;
    private $createTime;
    private $shop;
    private $goodsList;

    public function __construct($row){
        $this->id = $row['orderId'];
        $this->status = $row['status'];
        $this->goodsIds = $row['goods_ids'];
        $this->isEnabled = $row['is_enabled'];
        $this->shopId = $row['shopId'];
        $this->totalCount = $row['total_count'];
        $this->totalPrice = $row['total_price'];
        $this->tableId = $row['table_id'];
        $this->createTime = $row['create_time'];
        $this->shop = (new Shop($row))->show();
        $this->orderGoods = (new OrderGoods($row))->show();
        $this->goodsList = array();
    }

    public function show(){
        return array('orderId'=>$this->id, 'status'=>$this->status, 'goodsIds'=>$this->goodsIds, 'shopId'=>$this->shopId,
            'totalCount'=>$this->totalCount, 'totalPrice'=>$this->totalPrice, 'tableId'=>$this->tableId,
            'createTime'=>$this->createTime, 'shop'=>$this->shop, 'orderGoods'=>$this->orderGoods,
            'goodsList'=>$this->goodsList);
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @param mixed $totalCount
     */
    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
    }

    /**
     * @return mixed
     */
    public function getTableId()
    {
        return $this->tableId;
    }

    /**
     * @param mixed $tableId
     */
    public function setTableId($tableId)
    {
        $this->tableId = $tableId;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param mixed $createTime
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @return Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param Shop $shop
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
    }

    /**
     * @return array
     */
    public function getGoodsList()
    {
        return $this->goodsList;
    }

    /**
     * @param array $goodsList
     */
    public function setGoodsList($goodsList)
    {
        $this->goodsList = $goodsList;
    }


}