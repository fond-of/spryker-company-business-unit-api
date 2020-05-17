<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitApiTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitApiTransfer
     */
    public function toTransfer(array $data): CompanyBusinessUnitApiTransfer
    {
        return (new CompanyBusinessUnitApiTransfer())->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitApiTransfer[]
     */
    public function toTransferCollection(array $data): array
    {
        $transferCollection = [];

        foreach ($data as $itemData) {
            $transferCollection[] = $this->toTransfer($itemData);
        }

        return $transferCollection;
    }
}
