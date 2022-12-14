<?php


namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\ResponseMessageTransfer;
use Iterator;

class CompanyBusinessUnitApiTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainerInterface
     */
    protected $queryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapperMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi
     */
    protected $companyBusinessUnitApi;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var array
     */
    protected $transferData;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitResponseTransferMock;

    /**
     * @var int
     */
    protected $idCompanyBusinessUnit;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseMessageTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $iteratorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperMock = $this->getMockBuilder(TransferMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitResponseTransferMock = $this->getMockBuilder(CompanyBusinessUnitResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMessageTransferMock = $this->getMockBuilder(ResponseMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->iteratorMock = $this->getMockBuilder(Iterator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferData = [["Lorem Ipsum"]];

        $this->idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitApi = new CompanyBusinessUnitApi(
            $this->apiQueryContainerMock,
            $this->apiQueryBuilderQueryContainerMock,
            $this->queryContainerMock,
            $this->companyBusinessUnitFacadeMock,
            $this->transferMapperMock
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApi->add($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testAddEntityNotSavedException(): void
    {
        $errors = new ArrayObject();
        $errors->append($this->responseMessageTransferMock);

        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->companyBusinessUnitResponseTransferMock->expects($this->atLeastOnce())
            ->method('getMessages')
            ->willReturn($errors);

        $this->responseMessageTransferMock->expects($this->atLeastOnce())
            ->method('getText')
            ->willReturn("message");

        try {
            $this->companyBusinessUnitApi->add($this->apiDataTransferMock);
            $this->fail();
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($this->idCompanyBusinessUnit);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyBusinessUnitTransferMock, $this->idCompanyBusinessUnit);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApi->get($this->idCompanyBusinessUnit));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($this->idCompanyBusinessUnit);

        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApi->update($this->idCompanyBusinessUnit, $this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotFoundException()
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        try {
            $this->companyBusinessUnitApi->update($this->idCompanyBusinessUnit, $this->apiDataTransferMock);
            $this->fail();
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->companyBusinessUnitFacadeMock->expects($this->atLeastOnce())
            ->method('delete')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyBusinessUnitApi->remove($this->idCompanyBusinessUnit));
    }
}
