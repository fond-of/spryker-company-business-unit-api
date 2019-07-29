<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence;

use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiPersistenceFactory getFactory()
 */
class CompanyBusinessUnitApiQueryContainer extends AbstractQueryContainer implements CompanyBusinessUnitApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function queryFind(): SpyCompanyBusinessUnitQuery
    {
        return $this->getFactory()->getCompanyBusinessUnitQuery();
    }
}
