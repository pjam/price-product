<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\PriceProduct\Dependency\Client;

interface PriceProductToPriceClientInterface
{
    /**
     * @return string
     */
    public function getCurrentPriceMode();

    /**
     * @return string
     */
    public function getGrossPriceModeIdentifier();

    /**
     * @return string
     */
    public function getNetPriceModeIdentifier();
}
