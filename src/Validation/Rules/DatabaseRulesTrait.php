<?php declare (strict_types=1);

namespace Orzford\Limoncello\Validation\JsonApi\Rules;

use Limoncello\Validation\Contracts\Rules\RuleInterface;
use Limoncello\Validation\Rules\Generic\AndOperator;

/**
 * @package Orzford\Limoncello\Validation\JsonApi\Rules
 */
trait DatabaseRulesTrait
{
    /**
     * @param string             $tableName
     * @param string             $primaryName
     * @param null|string        $primaryKey
     * @param RuleInterface|null $next
     *
     * @return RuleInterface
     */
    protected static function isUnique(
        string $tableName,
        string $primaryName,
        ?string $primaryKey = null,
        RuleInterface $next = null
    ): RuleInterface
    {
        $primary = new UniqueInDbTableSingleWithDoctrineRule($tableName, $primaryName, $primaryKey);

        return $next === null ?
            $primary :
            new AndOperator($primary, $next);
    }
}
