<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Max107\EthValidator;

class EthereumUtil
{
    public function validate($wallet): bool
    {
        if (empty($wallet)) {
            return true;
        }

        return (bool) preg_match('/^(0x)?[0-9a-fA-F]{40}$/', (string) $wallet, $matches);
    }
}
