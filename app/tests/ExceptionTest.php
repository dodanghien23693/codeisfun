<?php


class ExceptionTest extends PHPUnit_Framework_TestCase{
    
    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Message
     */
    public function testExceptionHasRightMessage()
    {
        throw new InvalidArgumentException('Some Message', 10);
    }

    /**
     * @expectedException              InvalidArgumentException
     * @expectedExceptionMessageRegExp /So** Message/
     */
    public function testExceptionMessageMatchesRegExp()
    {
        throw new InvalidArgumentException('Some Message', 10);
    }

    /**
     * @expectedException     InvalidArgumentException
     * @expectedExceptionCode 10
     */
    public function testExceptionHasRightCode()
    {
        throw new InvalidArgumentException('Some Message', 10);
    }
}
