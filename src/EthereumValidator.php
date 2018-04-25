<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\EthValidator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EthereumValidator extends ConstraintValidator
{
    /**
     * @var EthereumUtil
     */
    protected $util;

    /**
     * EthereumValidator constructor.
     *
     * @param EthereumUtil $util
     */
    public function __construct(EthereumUtil $util)
    {
        $this->util = $util;
    }

    public function validate($value, Constraint $constraint)
    {
        if (false === $this->util->validate($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
