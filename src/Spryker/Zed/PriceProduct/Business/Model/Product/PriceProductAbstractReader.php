<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\PriceProduct\Business\Model\Product;

use Generated\Shared\Transfer\PriceProductCriteriaTransfer;
use Orm\Zed\PriceProduct\Persistence\Map\SpyPriceProductStoreTableMap;
use Orm\Zed\PriceProduct\Persistence\Map\SpyPriceProductTableMap;
use Propel\Runtime\Formatter\ArrayFormatter;
use Spryker\Zed\PriceProduct\Business\Model\PriceProductCriteriaBuilderInterface;
use Spryker\Zed\PriceProduct\Dependency\Facade\PriceProductToProductInterface;
use Spryker\Zed\PriceProduct\Persistence\PriceProductQueryContainerInterface;

class PriceProductAbstractReader implements PriceProductAbstractReaderInterface
{
    /**
     * @var \Spryker\Zed\PriceProduct\Persistence\PriceProductQueryContainerInterface;
     */
    protected $priceProductQueryContainer;

    /**
     * @var \Spryker\Zed\PriceProduct\Business\Model\Product\PriceProductMapperInterface
     */
    protected $priceProductMapper;

    /**
     * @var \Spryker\Zed\PriceProduct\Dependency\Facade\PriceProductToProductInterface
     */
    protected $productFacade;

    /**
     * @var \Spryker\Zed\PriceProduct\Business\Model\PriceProductCriteriaBuilderInterface
     */
    protected $priceProductCriteriaBuilder;

    /**
     * @param \Spryker\Zed\PriceProduct\Persistence\PriceProductQueryContainerInterface $priceProductQueryContainer
     * @param \Spryker\Zed\PriceProduct\Business\Model\Product\PriceProductMapperInterface $priceProductMapper
     * @param \Spryker\Zed\PriceProduct\Dependency\Facade\PriceProductToProductInterface $productFacade
     * @param \Spryker\Zed\PriceProduct\Business\Model\PriceProductCriteriaBuilderInterface $priceProductCriteriaBuilder
     */
    public function __construct(
        PriceProductQueryContainerInterface $priceProductQueryContainer,
        PriceProductMapperInterface $priceProductMapper,
        PriceProductToProductInterface $productFacade,
        PriceProductCriteriaBuilderInterface $priceProductCriteriaBuilder
    ) {
        $this->priceProductQueryContainer = $priceProductQueryContainer;
        $this->priceProductMapper = $priceProductMapper;
        $this->productFacade = $productFacade;
        $this->priceProductCriteriaBuilder = $priceProductCriteriaBuilder;
    }

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return bool
     */
    public function hasPriceForProductAbstract($sku, PriceProductCriteriaTransfer $priceProductCriteriaTransfer)
    {
        $productAbstract = $this->priceProductQueryContainer
            ->queryPriceEntityForProductAbstract($sku, $priceProductCriteriaTransfer)
            ->select([SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT])
            ->findOne();

        return $productAbstract !== null;
    }

    /**
     * @param string $sku
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function findProductAbstractPricesBySku($sku)
    {
        $abstractSku = $this->getAbstractSku($sku);

        $productAbstractPriceEntities = $this->priceProductQueryContainer
            ->queryPricesForProductAbstractBySku($abstractSku)
            ->find();

        return $this->priceProductMapper->mapPriceProductTransferCollection($productAbstractPriceEntities);
    }

    /**
     * @param string $sku
     *
     * @return string
     */
    public function getAbstractSku($sku)
    {
        $abstractSku = $sku;
        if ($this->productFacade->hasProductConcrete($sku)) {
            $abstractSku = $this->productFacade->getAbstractSkuFromProductConcrete($sku);
        }

        return $abstractSku;
    }

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return array
     */
    public function getPriceForProductAbstract($sku, PriceProductCriteriaTransfer $priceProductCriteriaTransfer)
    {
        return $this->priceProductQueryContainer
            ->queryPriceEntityForProductAbstract($sku, $priceProductCriteriaTransfer)
            ->withColumn(SpyPriceProductStoreTableMap::COL_GROSS_PRICE, PriceProductQueryContainerInterface::COL_GROSS_PRICE)
            ->withColumn(SpyPriceProductStoreTableMap::COL_NET_PRICE, PriceProductQueryContainerInterface::COL_NET_PRICE)
            ->setFormatter(ArrayFormatter::class)
            ->findOne();
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function findProductAbstractPricesById($idProductAbstract)
    {
        $productAbstractPriceEntities = $this->priceProductQueryContainer
            ->queryPricesForProductAbstractById($idProductAbstract)
            ->find();

        return $this->priceProductMapper->mapPriceProductTransferCollection($productAbstractPriceEntities);
    }

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\PriceProductCriteriaTransfer $priceProductCriteriaTransfer
     *
     * @return int
     */
    public function findPriceProductId($sku, PriceProductCriteriaTransfer $priceProductCriteriaTransfer)
    {
        return $this->priceProductQueryContainer
            ->queryPriceEntityForProductAbstract($sku, $priceProductCriteriaTransfer)
            ->findOne()
            ->getIdPriceProduct();
    }

    /**
     * @param int $idAbstractProduct
     * @param string|null $priceTypeName
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer
     */
    public function findProductAbstractPrice($idAbstractProduct, $priceTypeName = null)
    {
        $priceProductCriteriaTransfer = $this->priceProductCriteriaBuilder
            ->buildCriteriaWithDefaultValues($priceTypeName);

        $priceProductStoreEntity = $this->priceProductQueryContainer
            ->queryPriceEntityForProductAbstractById($idAbstractProduct, $priceProductCriteriaTransfer)
            ->findOne();

        return $this->priceProductMapper->mapProductPriceTransfer(
            $priceProductStoreEntity,
            $priceProductStoreEntity->getPriceProduct()
        );
    }
}