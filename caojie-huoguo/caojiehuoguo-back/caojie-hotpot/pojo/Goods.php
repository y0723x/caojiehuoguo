<?php

class Goods
{
    private $id;
    private $goodsName;
    private $goodsUrl;
    private $goodsIntro;
    private $goodsPrice;
    private $cateId;
    private $isEnabled;
    private $goodsCount;

    public function __construct($row){
        $this->id = $row['goodsId'];
        $this->goodsIntro = $row['goods_intro'];
        $this->goodsName = $row['goods_name'];
        $this->goodsPrice = $row['goods_price'];
        $this->goodsUrl = $row['goods_url'];
        $this->cateId = $row['cate_id'];
        $this->goodsCount = $row['goods_count'];
    }

    public function show(){
        return array("goodsId"=>$this->id, "goodsIntro"=>$this->goodsIntro, "goodsName"=>$this->goodsName,
            "goodsPrice"=>$this->goodsPrice,"goodsUrl"=>$this->goodsUrl, "cateId"=>$this->cateId,
            "goodsCount"=>$this->goodsCount
        );
    }
}