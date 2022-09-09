<?php
include_once(realpath("./../../")."\pojo\Shop.php");
class Table
{
    private $id;
    private $status;
    private $orderId;
    private $tableName;
    private $isEnabled;
    private $shopId;
    private $shop;

    public function __construct($row){

        $this->id = $row["tableId"];
        $this->status = $row["status"];
        $this->orderId = $row["orderId"];
        $this->tableName = $row["tableName"];
        $this->shopId = $row["shopId"];
        $this->shop = (new Shop($row))->show();

    }

    public function show(){
        return array('id'=>$this->id, 'status'=>$this->status, 'orderId'=>$this->orderId, 'tableName'=>$this->tableName,
            'shopId'=>$this->shopId, 'shop'=>$this->shop
        );
    }
}