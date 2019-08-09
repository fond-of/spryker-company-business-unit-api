<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitApiTransfer;

class TransferMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapper
     */
    protected $transferMapper;

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

        $this->transferData = [];

        $this->transferMapper = new TransferMapper();
    }

    /**
     * @return void
     */
    public function testToTransfer(): void
    {
        $this->assertInstanceOf(CompanyBusinessUnitApiTransfer::class, $this->transferMapper->toTransfer($this->transferData));
    }

    /**
     * @return void
     */
    public function testToTransferCollection(): void
    {
        $this->assertIsArray($this->transferMapper->toTransferCollection($this->transferData));
    }
}
