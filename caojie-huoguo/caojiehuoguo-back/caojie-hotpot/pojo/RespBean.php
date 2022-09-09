<?php

class RespBean
{
    private $code;
    private $message;
    private $object;

    /**
     * @param $code
     * @param $message
     * @param $object
     */
    public function __construct($code, $message, $object)
    {
        $this->code = $code;
        $this->message = $message;
        $this->object = $object;
    }

    /**
     * @param $message
     * @param $object
     * @return RespBean
     */
    public static function success($message, $object){
        return array('code' => 200, 'message' => $message, 'object' => $object);
    }

    /**
     * @param $message
     * @param $object
     * @return RespBean
     */
    public static function error($message, $object){
        return array('code' => 500, 'message' => $message, 'object' => $object);
    }

}