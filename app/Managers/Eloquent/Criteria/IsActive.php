<?php
namespace App\Managers\Eloquent\Criteria;

use App\Managers\Contracts\Criteria\CriterionInterface;

/**
 * Class IsActive
 *
 * Find entity(ies) that has (have) the active state.
 *
 * @package App\Managers\Eloquent\Criteria
 */
class IsActive implements CriterionInterface
{
    /**
     * @inheritdoc
     */
    public function apply($entity)
    {
        return $entity->active();
    }
}
