<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi;

use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerBridge;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerBridge;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyBusinessUnitApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY_BUSINESS_UNIT = 'FACADE_COMPANY_BUSINESS_UNIT';
    public const PROPEL_QUERY_COMPANY_BUSINESS_UNIT = 'PROPEL_QUERY_COMPANY_BUSINESS_UNIT';
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';
    public const QUERY_CONTAINER_API_QUERY_BUILDER = 'QUERY_CONTAINER_API_QUERY_BUILDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyBusinessUnitFacade($container);
        $container = $this->addApiQueryContainer($container);
        $container = $this->addApiQueryBuilderQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCompanyBusinessUnitPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyBusinessUnitFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_BUSINESS_UNIT] = function (Container $container) {
            return new CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge(
                $container->getLocator()->companyBusinessUnit()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyBusinessUnitPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_BUSINESS_UNIT] = function () {
            return SpyCompanyBusinessUnitQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API] = function (Container $container) {
            return new CompanyBusinessUnitApiToApiQueryContainerBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryBuilderQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API_QUERY_BUILDER] = function (Container $container) {
            return new CompanyBusinessUnitApiToApiQueryBuilderQueryContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer()
            );
        };

        return $container;
    }
}
