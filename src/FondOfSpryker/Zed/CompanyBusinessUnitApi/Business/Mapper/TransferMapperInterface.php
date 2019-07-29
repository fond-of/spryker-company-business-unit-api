<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitApiTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitApiTransfer
     */
    public function toTransfer(array $data): CompanyBusinessUnitApiTransfer;

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyApiTransfer[]
     */
    public function toTransferCollection(array $data): array;
}
