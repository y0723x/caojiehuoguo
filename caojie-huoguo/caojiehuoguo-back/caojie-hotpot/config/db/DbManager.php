<?php

class DbManager
{
    private $conn;
    private $mysql_host = "localhost";
    private $mysql_username = "root";
    private $mysql_password = "123456";
    private $mysql_port = "3307";
    private $mysql_database = "caojiehuoguo";

    // 执行sql
    public function executeSql($sqlTxt){
        // 连接数据库
        $this->conn = mysqli_connect($this->mysql_host, $this->mysql_username, $this->mysql_password, $this->mysql_database, $this->mysql_port)
            or die("失败".mysqli_error());

        // 获取结果
        $result = mysqli_query($this->conn, $sqlTxt);

        // 返回结果
        return $result;
    }

    // 关闭连接
    public function closeConnection($result){
        mysqli_free_result($result);
        mysqli_close($this->conn);
    }

    // 返回conn
    public function getConn(){
        $this->conn = mysqli_connect($this->mysql_host, $this->mysql_username, $this->mysql_password, $this->mysql_database, $this->mysql_port)
            or die("失败".mysqli_error());
        return $this->conn;
    }
}