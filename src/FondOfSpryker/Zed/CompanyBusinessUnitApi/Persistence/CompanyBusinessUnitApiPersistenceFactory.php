<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence;

use FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiDependencyProvider;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainerInterface getQueryContainer()
 */
class CompanyBusinessUnitApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitApiDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT
        );
    }
}
