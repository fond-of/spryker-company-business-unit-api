<?php


namespace FondOfSpryker\Zed\CompanyApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacade;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge
     */
    protected $companyBusinessUnitApiToCompanyBusinessUnitFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacade
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer
     */
    protected $companyBusinessUnitResponseTransferMock;

    /**
     * @var int
     */
    protected $idCompanyBusinessUnit;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitResponseTransferMock = $this->getMockBuilder(CompanyBusinessUnitResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitApiToCompanyBusinessUnitFacadeBridge = new CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge(
            $this->companyBusinessUnitFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyBusinessUnitById(): void
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->assertInstanceOf(CompanyBusinessUnitTransfer::class, $this->companyBusinessUnitApiToCompanyBusinessUnitFacadeBridge->getCompanyBusinessUnitById($this->companyBusinessUnitTransferMock));
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('create')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->assertInstanceOf(CompanyBusinessUnitResponseTransfer::class, $this->companyBusinessUnitApiToCompanyBusinessUnitFacadeBridge->create($this->companyBusinessUnitTransferMock));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->assertInstanceOf(CompanyBusinessUnitResponseTransfer::class, $this->companyBusinessUnitApiToCompanyBusinessUnitFacadeBridge->update($this->companyBusinessUnitTransferMock));
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('delete')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->assertInstanceOf(CompanyBusinessUnitResponseTransfer::class, $this->companyBusinessUnitApiToCompanyBusinessUnitFacadeBridge->delete($this->companyBusinessUnitTransferMock));
    }
}
