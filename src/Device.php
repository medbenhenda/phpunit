<?php
/**
 * Created by PhpStorm.
 * User: m.benhenda(benhenda.med@gmail.com)
 * Date: 30/04/2016
 * Time: 00:23
 */

namespace Med\Demo;


/**
 * Class Device
 *
 * @package Med\Demo
 */
class Device
{
    /**
     * @var
     */
    private $email;

    /**
     * @param $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Method description
     *
     * @param $imei
     * @param $regId
     * @param $os
     * @param $brand
     * @param $model
     */
    public function registerDevice($imei, $regId, $os, $brand, $model)
    {

    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}