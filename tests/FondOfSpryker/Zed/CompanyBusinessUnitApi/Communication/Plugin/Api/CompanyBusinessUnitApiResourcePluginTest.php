<?php


namespace FondOfSpryker\Zed\CompanyApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api\CompanyBusinessUnitApiResourcePlugin;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyBusinessUnitApiResourcePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api\CompanyBusinessUnitApiResourcePlugin
     */
    protected $companyBusinessUnitApiResourcePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade
     */
    protected $companyBusinessUnitApiFacadeMock;

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
     * @var int
     */
    protected $idCompanyBusinessUnit;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApiFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitApiResourcePlugin = new CompanyBusinessUnitApiResourcePlugin();

        $this->companyBusinessUnitApiResourcePlugin->setFacade($this->companyBusinessUnitApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertSame(CompanyBusinessUnitApiConfig::RESOURCE_COMPANY_BUSINESS_UNITS, $this->companyBusinessUnitApiResourcePlugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects($this->atLeastOnce())
            ->method('addCompanyBusinessUnit')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiResourcePlugin->add($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->with($this->idCompanyBusinessUnit)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiResourcePlugin->get($this->idCompanyBusinessUnit));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects($this->atLeastOnce())
            ->method('updateCompanyBusinessUnit')
            ->with($this->idCompanyBusinessUnit, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiResourcePlugin->update($this->idCompanyBusinessUnit, $this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects($this->atLeastOnce())
            ->method('removeCompanyBusinessUnit')
            ->with($this->idCompanyBusinessUnit)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApiResourcePlugin->remove($this->idCompanyBusinessUnit));
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects($this->atLeastOnce())
            ->method('findCompanyBusinessUnits')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(ApiCollectionTransfer::class, $this->companyBusinessUnitApiResourcePlugin->find($this->apiRequestTransferMock));
    }
}
