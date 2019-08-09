<?php


namespace FondOfSpryker\Zed\CompanyApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api\CompanyBusinessUnitApiValidatorPlugin;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyBusinessUnitApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api\CompanyBusinessUnitApiValidatorPlugin
     */
    protected $companyBusinessUnitApiValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade
     */
    protected $companyBusinessUnitApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitApiFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApiValidatorPlugin = new CompanyBusinessUnitApiValidatorPlugin();

        $this->companyBusinessUnitApiValidatorPlugin->setFacade($this->companyBusinessUnitApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertSame(CompanyBusinessUnitApiConfig::RESOURCE_COMPANY_BUSINESS_UNITS, $this->companyBusinessUnitApiValidatorPlugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        $this->assertIsArray($this->companyBusinessUnitApiValidatorPlugin->validate($this->apiDataTransferMock));
    }
}
