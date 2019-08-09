<?php


namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyBusinessUnitApiValidatorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator
     */
    protected $companyBusinessUnitApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var array
     */
    protected $transferData;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferData = [['name' => 'Lorem Ipsum']];

        $this->companyBusinessUnitApiValidator = new CompanyBusinessUnitApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->assertIsArray($this->companyBusinessUnitApiValidator->validate($this->apiDataTransferMock));
    }
}
