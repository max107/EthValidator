<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\EthValidator\Tests;

use Max107\EthValidator\Ethereum;
use Max107\EthValidator\EthereumUtil;
use Max107\EthValidator\EthereumValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilder;

class EthereumValidatorTest extends TestCase
{
    public function testEthereumUtil()
    {
        $v = new EthereumUtil();
        $this->assertTrue($v->validate('0xde0B295669a9FD93d5F28D9Ec85E40f4cb697BAe'));
        $this->assertFalse($v->validate('1xde0B295669a9FD93d5F28D9Ec85E40f4cb697BAe'));
        $this->assertFalse($v->validate('0xde0B295669a9FD93d5F28D9Ec85E40f4cb697BA'));
        $this->assertTrue($v->validate(null));
        $this->assertTrue($v->validate(''));
        $this->assertFalse($v->validate('test'));
    }

    public function testEthereumConstraint()
    {
        $builder = $this
            ->getMockBuilder(ConstraintViolationBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['addViolation'])
            ->getMock();

        // mock the validator context
        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation'])
            ->getMock();

        $context
            ->expects($this->once())
            ->method('buildViolation')
            ->with($this->equalTo('Incorrect ethereum wallet "{{ string }}"'))
            ->will($this->returnValue($builder));

        // initialize the validator with the mocked context
        $validator = new EthereumValidator(new EthereumUtil());
        $validator->initialize($context);

        // return the SomeConstraintValidator
        $validator->validate('someInvalidValue', new Ethereum());
    }

    public function testEthereumConstraintValid()
    {
        // mock the validator context
        $context = $this
            ->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation'])
            ->getMock();

        $context
            ->expects($this->never())
            ->method('buildViolation');

        // initialize the validator with the mocked context
        $validator = new EthereumValidator(new EthereumUtil());
        $validator->initialize($context);

        // return the SomeConstraintValidator
        $validator->validate('0xde0B295669a9FD93d5F28D9Ec85E40f4cb697BAe', new Ethereum());
    }
}
