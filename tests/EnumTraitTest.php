<?php


use PHPUnit\Framework\TestCase;
use Sezer\EnumHelpers\Exceptions\InvalidEnumKeyException;
use Sezer\EnumHelpers\Traits\EnumTrait;

enum Status: string
{
    use EnumTrait;

    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}

class EnumTraitTest extends TestCase
{
    public function testOnly()
    {
        $result = Status::only(['PENDING', 'APPROVED']);
        $this->assertArrayHasKey('PENDING', $result);
        $this->assertArrayHasKey('APPROVED', $result);
        $this->assertArrayNotHasKey('REJECTED', $result);
    }

    public function testInvalidKey(): void
    {
        $this->expectException(InvalidEnumKeyException::class);
        Status::only(['INVALID']);
    }

    public function testExcept(): void
    {
        $result = Status::except(['REJECTED']);
        $this->assertArrayHasKey('PENDING', $result);
        $this->assertArrayHasKey('APPROVED', $result);
        $this->assertArrayNotHasKey('REJECTED', $result);
    }
    public function testInvalidKeyInExcept(): void
    {
        $this->expectException(InvalidEnumKeyException::class);
        Status::except(['NOT_A_REAL_CASE']);
    }
}