<?php
/**
 * Created by PhpStorm.
 * User: m.benhenda(benhenda.med@gmail.com)
 * Date: 30/04/2016
 * Time: 00:24
 */

namespace Med\Demo\Test;

use Med\Demo\Math;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public function testDouble()
    {
        $this->assertEquals(4, Math::double(2));
    }
}
