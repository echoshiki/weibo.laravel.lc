<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2022 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

namespace LaravelLang\Publisher\Exceptions;

use LaravelLang\Publisher\Constants\Locales;

class UnknownLocaleCodeException extends BaseException
{
    public function __construct(array|Locales|string $locale)
    {
        $locale = $this->stringify($locale);

        parent::__construct("Unknown locale code: $locale.");
    }
}
