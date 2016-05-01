<?php
/**
 * Created by PhpStorm.
 * User: m.benhenda(benhenda.med@gmail.com)
 * Date: 01/05/2016
 * Time: 01:11
 */

namespace Med\Demo\Test;


use Med\Demo\Advice;

class AdviceTest extends \PHPUnit_Framework_TestCase {

    private $advice;

    public function attributeAdvice()
    {
        return [
            [ 'name' ],
            [ 'description' ],
            [ 'width' ],
            [ 'height' ],
        ];
    }

    public function invalidInputForName()
    {
        return [
            'null'         => [ null ],
            'empty'        => [ '' ],
            'bool'         => [ true ],
            'array'        => [ ['2016-03-26'] ],
            'object'       => [ new \stdClass() ],
        ];

    }
    public function invalidInputForHeightAndWidth()
    {
        return [
            'null'          => [ null ],
            'empty'         => [ '' ],
            'bool'          => [ true ],
            'array'         => [ ['2016-03-26'] ],
            'object'        => [ new \stdClass() ],
            'string'        => ['string'],
            'decimal_error' => ['15,5'],
        ];

    }

    public function invalidInputForDesc()
    {
        return [
            'null'         => [ null ],
            'empty'        => [ '' ],
        ];

    }
    /**
     * @dataProvider attributeAdvice
     */
    public function testHasProperties($attribute)
    {
        $this->assertClassHasAttribute($attribute, Advice::class);
    }

    /**
     * @dataProvider invalidInputForName
     */
    public function testConstructorCall($name)
    {
        $stub = $this->getMockBuilder(Advice::class)
            ->disableOriginalConstructor()
            ->getMock();


        $stub->expects(static::once())
            ->method('setName')
            ->willThrowException(new \InvalidArgumentException(sprintf('The argument hould be a string. %s given', gettype($name))));
        $this->expectException('InvalidArgumentException');
        $reflectedClass = new \ReflectionClass(Advice::class);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($stub, $name, 'desc', 10, 45);

    }

}
