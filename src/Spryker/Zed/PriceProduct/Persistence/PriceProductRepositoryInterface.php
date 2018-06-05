<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\PriceProduct\Persistence;

use Generated\Shared\Transfer\PriceDimensionCriteriaTransfer;
use Generated\Shared\Transfer\PriceProductCriteriaTransfer;
use Generated\Shared\Transfer\SpyPriceProductDefaultEntityTransfer;

interface PriceProductRepositoryInterface
{
    /**
     * @api
     *
     * @param string $concreteSku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SpyPriceProductStoreEntityTransfer[]
     */
    public function findProductConcretePricesBySkuAndCriteria(
        $concreteSku,
        PriceProductCriteriaTransfer $priceProductCriteriaTransfer
    ): array;

    /**
     * @api
     *
     * @param string $abstractSku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SpyPriceProductStoreEntityTransfer[]
     */
    public function findProductAbstractPricesBySkuAndCriteria(
        $abstractSku,
        PriceProductCriteriaTransfer $priceProductCriteriaTransfer
    ): array;

    /**
     * @api
     *
     * @param int $idProductConcrete
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SpyPriceProductStoreEntityTransfer[]
     */
    public function findProductConcretePricesByIdAndCriteria(
        $idProductConcrete,
        PriceProductCriteriaTransfer $priceProductCriteriaTransfer
    ): array;

    /**
     * @api
     *
     * @param int $idProductAbstract
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SpyPriceProductStoreEntityTransfer[]
     */
    public function findProductAbstactPricesByIdAndCriteria(
        $idProductAbstract,
        PriceProductCriteriaTransfer $priceProductCriteriaTransfer
    ): array;

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PriceDimensionCriteriaTransfer|null
     */
    public function buildDefaultPriceDimensionCriteria(
        PriceProductCriteriaTransfer $priceProductCriteriaTransfer
    ): ?PriceDimensionCriteriaTransfer;

    /**
     * @param int $idPriceProductStore
     *
     * @return \Generated\Shared\Transfer\SpyPriceProductDefaultEntityTransfer|null
     */
    public function findPriceProductDefaultByIdPriceProductStore(int $idPriceProductStore): ?SpyPriceProductDefaultEntityTransfer;
}