<?php

class OrderGoods
{
    private $id;
    private $orderId;
    private $goodsId;
    private $isEnabled;
    private $goodsCount;

    public function __construct($row){
        $this->id = $row['orderGoodsId'];
        $this->orderId = $row['order_id'];
        $this->goodsId = $row['goodsId'];
        $this->isEnabled = $row['is_enabled'];
        $this->goodsCount = $row['goods_count'];
    }

    public function show(){
        return array('orderGoodsId'=>$this->id, 'goodsCount'=>$this->goodsCount, 'goodsId'=>$this->goodsId);
    }
}