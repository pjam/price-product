<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\PriceProduct\Business\Model\Product;

use Generated\Shared\Transfer\PriceProductCriteriaTransfer;

interface PriceProductAbstractReaderInterface
{
    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return bool
     */
    public function hasPriceForProductAbstract($sku, PriceProductCriteriaTransfer $priceProductCriteriaTransfer);

    /**
     * @param string $sku
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function findProductAbstractPricesBySku($sku);

    /**
     * @param string $sku
     *
     * @return string
     */
    public function getAbstractSku($sku);

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return array
     */
    public function getPriceForProductAbstract($sku, PriceProductCriteriaTransfer $priceProductCriteriaTransfer);

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function findProductAbstractPricesById($idProductAbstract);

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return int
     */
    public function findPriceProductId($sku, PriceProductCriteriaTransfer $priceProductCriteriaTransfer);

    /**
     * @param int $idAbstractProduct
     * @param string|null $priceTypeName
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer
     */
    public function findProductAbstractPrice($idAbstractProduct, $priceTypeName = null);
}