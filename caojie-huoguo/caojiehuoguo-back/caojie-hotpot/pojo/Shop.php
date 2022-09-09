<?php
include_once(realpath("./../../")."\pojo\ShopCate.php");
class Shop
{
    private $id;
    private $shopName;
    private $shopUrl;
    private $shopAddress;
    private $shopIntro;
    private $shopPhone;
    private $shopContact;
    private $isEnabled;
    private $cateIds;
    private $tableIds;
    private $shopDistribution;
    private $cate;

    public function __construct($row){
        $this->id = $row['shopId'];
        $this->shopName = $row['shop_name'];
        $this->shopUrl = $row['shop_url'];
        $this->shopAddress = $row['shop_address'];
        $this->shopIntro = $row['shop_intro'];
        $this->shopPhone = $row['shop_phone'];
        $this->shopContact = $row['shop_contact'];
        $this->shopDistribution = $row['shop_distribution'];
        $this->cate = (new ShopCate($row))->show();
    }

    public function show(){
        return array('shopId'=>$this->id, 'shopName'=>$this->shopName, 'shopUrl'=>$this->shopUrl, 'shopAddress'=>$this->shopAddress,
            'shopIntro'=>$this->shopIntro, 'shopPhone'=>$this->shopPhone, 'shopContact'=>$this->shopContact,
            'shopDistribution'=>$this->shopDistribution, 'cate'=>$this->cate
            );
    }

}