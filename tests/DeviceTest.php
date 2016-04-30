<?php
/**
 * Created by PhpStorm.
 * User: m.benhenda(benhenda.med@gmail.com)
 * Date: 30/04/2016
 * Time: 00:24
 */

namespace Med\Demo\Test;

use Med\Demo\Device;

class DeviceTest extends \PHPUnit_Framework_TestCase
{
    private $device;

    public function setUp()
    {
        $this->device = new Device('benhenda.med@gmail.com');
    }
    public function testRegisterDevice()
    {

    }

}
