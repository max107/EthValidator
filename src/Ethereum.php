<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\EthValidator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Ethereum extends Constraint
{
    public $message = 'Incorrect ethereum wallet "{{ string }}"';
}
