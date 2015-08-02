<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Criteria and condition helper
 *
 * @package     Application
 * @category    Helper
 * @author      Todd Wirth
 * @copyright   (c) 2013
 */
class Criteria {

    const EQ  = 0;  // Equal
    const NE  = 1;  // Not equal
    const GT  = 2;  // Greater than
    const LT  = 3;  // Less than
    const GTE = 4;  // Greater than or equal
    const LTE = 5;  // Less than or equal
    const EEE = 6;  // Identical
    const NEE = 7;  // Not identical

    /**
     * Determine if an array or scalar matches the given criteria
     *
     *     $criteria = array('property', Criteria::EQ, 'foo');
     *     $result = Criteria::matches(array('property' => 'bar'), $criteria); // FALSE
     *
     *     $criteria = array(Criteria::NE, 'foo');
     *     $result = Criteria::matches('bar', $criteria); // TRUE
     *
     * @param   mixed       Value or array to be tested
     * @param   array       Criteria to match
     * @return  boolean
     * @throws  Kohana_Exception
     */
    public static function matches($value, array $criteria)
    {
        if (count($criteria) < 2)
        {
            throw new Kohana_Exception("Criteria must be an array containing at least 2 values");
        }

        if (count($criteria) == 2)
        {
            list($operator, $operand, ) = $criteria;
        }
        else
        {
            list($property, $operator, $operand, ) = $criteria;

            $value = Arr::get($value, $property);
        }

        switch ($operator)
        {
            case self::EQ :
                return (bool) $value == $operand;

            case self::NE :
                return (bool) $value != $operand;

            case self::GT :
                return (bool) $value > $operand;

            case self::LT :
                return (bool) $value < $operand;

            case self::GTE:
                return (bool) $value >= $operand;

            case self::LTE:
                return (bool) $value <= $operand;

            case self::EEE:
                return (bool) $value === $operand;

            case self::NEE:
                return (bool) $value !==  $operand;
        }

        return FALSE;
    }

    /**
     * Determine if a value matches all of the given criterion
     *
     * @param   mixed       Value to check, array or scalar
     * @param   array       Array of criteria objects see [Criteria::matches]
     * @return  boolean
     */
    public static function matches_all($value, array $criterion)
    {
        foreach ($criterion as $criteria)
        {
            if ( ! self::matches($value, $criteria))
            {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * Determine if a value matches any of the given criterion
     *
     * @param   mixed       Value to check, array or scalar
     * @param   array       Array of criteria objects see [Criteria::matches]
     * @return  boolean
     */
    public static function matches_any($value, array $criterion)
    {
        foreach ($criterion as $criteria)
        {
            if (self::matches($value, $criteria))
            {
                return TRUE;
            }
        }

        return FALSE;
    }
}

