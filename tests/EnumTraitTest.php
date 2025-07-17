<?php


use PHPUnit\Framework\TestCase;
use Sezer\EnumHelpers\Exceptions\InvalidEnumKeyException;
use Sezer\EnumHelpers\Traits\EnumTrait;

enum OrderStatusEnum: string {
    use EnumTrait;

    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case COMPLETE = 'complete';
    case RETURNED = 'returned';
}

class EnumTraitTest extends TestCase
{
    public function testOnly()
    {
        $result = OrderStatusEnum::only(['PENDING', 'APPROVED']);
        $this->assertArrayHasKey('PENDING', $result);
        $this->assertArrayHasKey('APPROVED', $result);
        $this->assertArrayNotHasKey('REJECTED', $result);
    }

    public function testExcept()
    {
        $result = OrderStatusEnum::except(['COMPLETE']);
        $this->assertArrayNotHasKey('COMPLETE', $result);
        $this->assertArrayHasKey('PENDING', $result);
    }

    public function testOnlyList()
    {
        $result = OrderStatusEnum::onlyList(['PENDING', 'APPROVED']);
        $this->assertEquals(['pending', 'approved'], $result);
    }

    public function testExceptList()
    {
        $result = OrderStatusEnum::exceptList(['COMPLETE']);
        $this->assertNotContains('complete', $result);
        $this->assertContains('pending', $result);
        $this->assertContains('approved', $result);
    }

    public function testInvalidKeyOnly()
    {
        $this->expectException(InvalidEnumKeyException::class);
        OrderStatusEnum::only(['INVALID']);
    }

    public function testInvalidKeyExcept()
    {
        $this->expectException(InvalidEnumKeyException::class);
        OrderStatusEnum::except(['INVALID']);
    }

    public function testInvalidKeyOnlyList()
    {
        $this->expectException(InvalidEnumKeyException::class);
        OrderStatusEnum::onlyList(['INVALID']);
    }

    public function testInvalidKeyExceptList()
    {
        $this->expectException(InvalidEnumKeyException::class);
        OrderStatusEnum::exceptList(['INVALID']);
    }
}