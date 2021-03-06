<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\EntityManager;

use Magento\Framework\ObjectManagerInterface as ObjectManager;

/**
 * Class OperationPool
 */
class OperationPool
{
    /**
     * @var array
     */
    private $operations;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * OrchestratorPool constructor.
     * @param ObjectManager $objectManager
     * @param string[] $operations
     */
    public function __construct(
        ObjectManager $objectManager,
        $operations
    ) {
        $this->objectManager = $objectManager;
        $this->operations = $operations;
    }

    /**
     * Returns operation by name by entity type
     *
     * @param string $entityType
     * @param string $operationName
     * @return object
     */
    public function getOperation($entityType, $operationName)
    {
        if (!isset($this->operations[$entityType][$operationName])) {
            return $this->objectManager->get($this->operations['default'][$operationName]);
        }
        return $this->objectManager->get($this->operations[$entityType][$operationName]);
    }
}
