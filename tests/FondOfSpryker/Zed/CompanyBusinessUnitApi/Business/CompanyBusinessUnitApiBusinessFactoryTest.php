<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiDependencyProvider;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainer;
use Spryker\Zed\Kernel\Container;

class CompanyBusinessUnitApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory
     */
    protected $companyBusinessUnitApiBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig
     */
    protected $companyBusinessUnitApiConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainer
     */
    protected $queryContainerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitApiConfigMock = $this->getMockBuilder(CompanyBusinessUnitApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApiBusinessFactory = new CompanyBusinessUnitApiBusinessFactory();

        $this->companyBusinessUnitApiBusinessFactory->setConfig($this->companyBusinessUnitApiConfigMock);
        $this->companyBusinessUnitApiBusinessFactory->setQueryContainer($this->queryContainerMock);
        $this->companyBusinessUnitApiBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitApi(): void
    {
        $apiQueryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiQueryBuilderQueryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiToCompanyFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER],
                [CompanyBusinessUnitApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT]
            )->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER],
                [CompanyBusinessUnitApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT]
            )
            ->willReturnOnConsecutiveCalls(
                $apiQueryContainerMock,
                $apiQueryBuilderQueryContainerMock,
                $apiToCompanyFacadeMock
            );

        $company = $this->companyBusinessUnitApiBusinessFactory->createCompanyBusinessUnitApi();

        $this->assertInstanceOf(CompanyBusinessUnitApi::class, $company);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitApiValidator(): void
    {
        $validator = $this->companyBusinessUnitApiBusinessFactory->createCompanyBusinessUnitApiValidator();

        $this->assertInstanceOf(CompanyBusinessUnitApiValidator::class, $validator);
    }
}
