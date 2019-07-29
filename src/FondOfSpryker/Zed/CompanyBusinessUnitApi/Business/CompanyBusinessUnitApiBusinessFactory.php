<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business;

use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapper;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApiInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidatorInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiDependencyProvider;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainerInterface getQueryContainer()
 */
class CompanyBusinessUnitApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApiInterface
     */
    public function createCompanyBusinessUnitApi(): CompanyBusinessUnitApiInterface
    {
        return new CompanyBusinessUnitApi(
            $this->getApiQueryContainer(),
            $this->getApiQueryBuilderQueryContainer(),
            $this->getQueryContainer(),
            $this->getCompanyFacade(),
            $this->createTransferMapper()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CompanyBusinessUnitApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface
     */
    protected function getApiQueryBuilderQueryContainer(): CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
     */
    protected function getCompanyFacade(): CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapperInterface
     */
    protected function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidatorInterface
     */
    public function createCompanyBusinessUnitApiValidator(): CompanyBusinessUnitApiValidatorInterface
    {
        return new CompanyBusinessUnitApiValidator();
    }
}
