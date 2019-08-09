<?php

namespace FondOfSpryker\Zed\CompanyApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyBusinessUnitApiFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade
     */
    protected $companyBusinessUnitApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory
     */
    protected $companyBusinessUnitApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi
     */
    protected $companyBusinessUnitApiMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator
     */
    protected $companyBusinessUnitApiValidatorMock;

    /**
     * @var int
     */
    protected $idCompany;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitApiBusinessFactoryMock = $this->getMockBuilder(CompanyBusinessUnitApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApiMock = $this->getMockBuilder(CompanyBusinessUnitApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApiValidatorMock = $this->getMockBuilder(CompanyBusinessUnitApiValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompany = 1;

        $this->companyBusinessUnitApiFacade = new CompanyBusinessUnitApiFacade();

        $this->companyBusinessUnitApiFacade->setFactory($this->companyBusinessUnitApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddCompany(): void
    {
        $this->companyBusinessUnitApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiFacade->addCompanyBusinessUnit($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testGetCompany(): void
    {
        $this->companyBusinessUnitApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('get')
            ->with($this->idCompany)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiFacade->getCompanyBusinessUnit($this->idCompany));
    }

    /**
     * @return void
     */
    public function testUpdateCompany(): void
    {
        $this->companyBusinessUnitApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->idCompany, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiFacade->updateCompanyBusinessUnit($this->idCompany, $this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testRemoveUpdate(): void
    {
        $this->companyBusinessUnitApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('remove')
            ->with($this->idCompany)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiFacade->removeCompanyBusinessUnit($this->idCompany));
    }

    /**
     * @return void
     */
    public function testFindCompanies(): void
    {
        $this->companyBusinessUnitApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(ApiCollectionTransfer::class, $this->companyBusinessUnitApiFacade->findCompanyBusinessUnits($this->apiRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyBusinessUnitApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApiValidator')
            ->willReturn($this->companyBusinessUnitApiValidatorMock);

        $this->companyBusinessUnitApiValidatorMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        $this->assertIsArray($this->companyBusinessUnitApiFacade->validate($this->apiDataTransferMock));
    }
}
