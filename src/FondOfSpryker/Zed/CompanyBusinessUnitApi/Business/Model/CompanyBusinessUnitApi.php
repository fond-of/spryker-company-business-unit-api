<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Model;

use FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiPaginationTransfer;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyBusinessUnitApi implements CompanyBusinessUnitApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface $apiQueryBuilderQueryContainer
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiQueryContainerInterface $queryContainer
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitApi\Business\Mapper\TransferMapperInterface $transferMapper
     */
    public function __construct(
        CompanyBusinessUnitApiToApiQueryContainerInterface $apiQueryContainer,
        CompanyBusinessUnitApiToApiQueryBuilderQueryContainerInterface $apiQueryBuilderQueryContainer,
        CompanyBusinessUnitApiQueryContainerInterface $queryContainer,
        CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade,
        TransferMapperInterface $transferMapper
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->apiQueryBuilderQueryContainer = $apiQueryBuilderQueryContainer;
        $this->queryContainer = $queryContainer;
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
        $this->transferMapper = $transferMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = (array)$apiDataTransfer->getData();
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())->fromArray($data, true);
        $companyBusinessUnitResponseTransfer = $this->companyBusinessUnitFacade->create($companyBusinessUnitTransfer);

        if (!$companyBusinessUnitResponseTransfer->getIsSuccessful()) {
            $errors = [];

            foreach ($companyBusinessUnitResponseTransfer->getMessages() as $error) {
                $errors[] = $error->getText();
            }

            throw new EntityNotSavedException('Could not add company business unit: ' . implode(',', $errors));
        }

        $companyBusinessUnitTransfer = $this->companyBusinessUnitFacade->getCompanyBusinessUnitById(
            $companyBusinessUnitTransfer
        );

        return $this->apiQueryContainer->createApiItem(
            $companyBusinessUnitTransfer,
            $companyBusinessUnitTransfer->getIdCompanyBusinessUnit()
        );
    }

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyBusinessUnit): ApiItemTransfer
    {
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

        $companyBusinessUnitTransfer = $this->companyBusinessUnitFacade->getCompanyBusinessUnitById(
            $companyBusinessUnitTransfer
        );

        if ($companyBusinessUnitTransfer === null || $companyBusinessUnitTransfer->getIdCompanyBusinessUnit() === null) {
            throw new EntityNotFoundException(sprintf(
                'Company business unit not found for id %s',
                $idCompanyBusinessUnit
            ));
        }

        return $this->apiQueryContainer->createApiItem($companyBusinessUnitTransfer, $idCompanyBusinessUnit);
    }

    /**
     * @param int $idCompanyBusinessUnit
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompanyBusinessUnit, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

        $companyBusinessUnitTransfer = $this->companyBusinessUnitFacade->getCompanyBusinessUnitById(
            $companyBusinessUnitTransfer
        );

        if ($companyBusinessUnitTransfer === null || $companyBusinessUnitTransfer->getIdCompanyBusinessUnit() === null) {
            throw new EntityNotFoundException(sprintf(
                'Company business unit not found for id %s',
                $idCompanyBusinessUnit
            ));
        }

        $data = (array)$apiDataTransfer->getData();
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->fromArray($data, true)
            ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

        $companyBusinessUnitResponseTransfer = $this->companyBusinessUnitFacade->update($companyBusinessUnitTransfer);

        if (!$companyBusinessUnitResponseTransfer->getIsSuccessful()) {
            $errors = [];

            foreach ($companyBusinessUnitResponseTransfer->getMessages() as $message) {
                $errors[] = $message->getText();
            }

            throw new EntityNotSavedException('Could not update company: ' . implode(',', $errors));
        }

        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

        $companyBusinessUnitTransfer = $this->companyBusinessUnitFacade->getCompanyBusinessUnitById(
            $companyBusinessUnitTransfer
        );

        return $this->apiQueryContainer->createApiItem(
            $companyBusinessUnitTransfer,
            $companyBusinessUnitTransfer->getIdCompanyBusinessUnit()
        );
    }

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompanyBusinessUnit): ApiItemTransfer
    {
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

        $companyBusinessUnitResponseTransfer = $this->companyBusinessUnitFacade->delete($companyBusinessUnitTransfer);

        return $this->apiQueryContainer->createApiItem([], $idCompanyBusinessUnit);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $query = $this->buildQuery($apiRequestTransfer);
        $collection = $this->transferMapper->toTransferCollection($query->find()->toArray());

        foreach ($collection as $k => $companyBusinessUnitApiTransfer) {
            $collection[$k] = $this->get($companyBusinessUnitApiTransfer->getIdCompanyBusinessUnit())->getData();
        }

        $apiCollectionTransfer = $this->apiQueryContainer->createApiCollection($collection);
        $apiCollectionTransfer = $this->addPagination($query, $apiCollectionTransfer, $apiRequestTransfer);

        return $apiCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function buildQuery(ApiRequestTransfer $apiRequestTransfer): ModelCriteria
    {
        $apiQueryBuilderQueryTransfer = $this->buildApiQueryBuilderQuery($apiRequestTransfer);
        $query = $this->queryContainer->queryFind();
        $query = $this->apiQueryBuilderQueryContainer->buildQueryFromRequest($query, $apiQueryBuilderQueryTransfer);

        return $query;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected function buildApiQueryBuilderQuery(ApiRequestTransfer $apiRequestTransfer): ApiQueryBuilderQueryTransfer
    {
        $columnSelectionTransfer = $this->buildColumnSelection();

        $apiQueryBuilderQueryTransfer = (new ApiQueryBuilderQueryTransfer())
            ->setApiRequest($apiRequestTransfer)
            ->setColumnSelection($columnSelectionTransfer);

        return $apiQueryBuilderQueryTransfer;
    }

    /**
     * @throws
     *
     * @return \Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer
     */
    protected function buildColumnSelection(): PropelQueryBuilderColumnSelectionTransfer
    {
        $columnSelectionTransfer = new PropelQueryBuilderColumnSelectionTransfer();
        $tableColumns = SpyCompanyBusinessUnitTableMap::getFieldNames(TableMap::TYPE_FIELDNAME);

        foreach ($tableColumns as $columnAlias) {
            $columnTransfer = (new PropelQueryBuilderColumnTransfer())
                ->setName(SpyCompanyBusinessUnitTableMap::TABLE_NAME . '.' . $columnAlias)
                ->setAlias($columnAlias);

            $columnSelectionTransfer->addTableColumn($columnTransfer);
        }

        return $columnSelectionTransfer;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\ApiCollectionTransfer $apiCollectionTransfer
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return array|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected function addPagination(
        ModelCriteria $query,
        ApiCollectionTransfer $apiCollectionTransfer,
        ApiRequestTransfer $apiRequestTransfer
    ): ApiCollectionTransfer {
        $query->setOffset(0)
            ->setLimit(-1);

        $total = $query->count();
        $page = $apiRequestTransfer->getFilter()->getLimit() ? ($apiRequestTransfer->getFilter()->getOffset() / $apiRequestTransfer->getFilter()->getLimit() + 1) : 1;
        $pageTotal = ($total && $apiRequestTransfer->getFilter()->getLimit()) ? (int)ceil($total / $apiRequestTransfer->getFilter()->getLimit()) : 1;

        if ($page > $pageTotal) {
            throw new NotFoundHttpException('Out of bounds.', null, ApiConfig::HTTP_CODE_NOT_FOUND);
        }

        $apiPaginationTransfer = (new ApiPaginationTransfer())
            ->setItemsPerPage($apiRequestTransfer->getFilter()->getLimit())
            ->setPage($page)
            ->setTotal($total)
            ->setPageTotal($pageTotal);

        $apiCollectionTransfer->setPagination($apiPaginationTransfer);

        return $apiCollectionTransfer;
    }
}
