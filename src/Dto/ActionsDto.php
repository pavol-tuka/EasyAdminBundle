<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Dto;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

final class ActionsDto
{
    private $pageName;
    /** @var ActionDto[] */
    private $actions = [
        Crud::PAGE_DETAIL => [],
        Crud::PAGE_EDIT => [],
        Crud::PAGE_INDEX => [],
        Crud::PAGE_NEW => [],
    ];
    /** @var string[] */
    private $disabledActions = [];
    /** @var string[] */
    private $actionPermissions = [];

    public function __construct()
    {
    }

    public function setPageName(string $pageName): void
    {
        $this->pageName = $pageName;
    }

    public function setActionPermission(string $actionName, string $permission): void
    {
        $this->actionPermissions[$actionName] = $permission;
    }

    public function setActionPermissions(array $permissions): void
    {
        $this->actionPermissions = $permissions;
    }

    public function prependAction(string $pageName, ActionDto $actionDto): void
    {
        $this->actions[$pageName][$actionDto->getName()] = $actionDto;
    }

    public function appendAction(string $pageName, ActionDto $actionDto): void
    {
        $this->actions[$pageName] = array_merge([$actionDto->getName() => $actionDto], $this->actions[$pageName]);
    }

    public function setAction(string $pageName, ActionDto $actionDto): void
    {
        $this->actions[$pageName][$actionDto->getName()] = $actionDto;
    }

    public function getAction(string $pageName, string $actionName): ?ActionDto
    {
        return $this->actions[$pageName][$actionName] ?? null;
    }

    public function removeAction(string $pageName, string $actionName): void
    {
        unset($this->actions[$pageName][$actionName]);
    }

    public function reorderActions(string $pageName, array $orderedActionNames): void
    {
        $orderedActions = [];
        foreach ($orderedActionNames as $actionName) {
            $orderedActions[$actionName] = $this->actions[$actionName];
        }

        $this->actions[$pageName] = $orderedActions;
    }

    public function disableActions(array $actionNames): void
    {
        $this->disabledActions = $actionNames;
    }

    /**
     * @return ActionDto[]
     */
    public function getActions(): array
    {
        return null === $this->pageName ? $this->actions : $this->actions[$this->pageName];
    }

    /**
     * @param ActionDto[] $newActions
     */
    public function setActions(string $pageName, array $newActions): void
    {
        $this->actions[$pageName] = $newActions;
    }

    public function getDisabledActions(): array
    {
        return $this->disabledActions;
    }

    public function getActionPermissions(): array
    {
        return $this->actionPermissions;
    }

    /**
     * @return ActionDto[]
     */
    public function getGlobalActions(): array
    {
        return array_filter($this->actions[$this->pageName], static function (ActionDto $action) {
            return $action->isGlobalAction();
        });
    }

    /**
     * @return ActionDto[]
     */
    public function getBatchActions(): array
    {
        return array_filter($this->actions[$this->pageName], static function (ActionDto $action) {
            return $action->isBatchAction();
        });
    }

    /**
     * @return ActionDto[]
     */
    public function getEntityActions(): array
    {
        return array_filter($this->actions[$this->pageName], static function (ActionDto $action) {
            return $action->isEntityAction();
        });
    }
}