<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyBusinessUnitApiValidator implements CompanyBusinessUnitApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        $data = $apiDataTransfer->getData();

        return $this->assertRequiredField($data, 'name', []);
    }

    /**
     * @param array $data
     * @param string $field
     * @param array $errors
     *
     * @return array
     */
    protected function assertRequiredField(array $data, string $field, array $errors): array
    {
        if (!isset($data[$field]) || (array_key_exists($field, $data) && !$data[$field])) {
            $message = sprintf('Missing value for required field "%s"', $field);
            $errors[$field][] = $message;
        }

        return $errors;
    }
}
