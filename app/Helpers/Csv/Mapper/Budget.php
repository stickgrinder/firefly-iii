<?php
/**
 * Budget.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

declare(strict_types = 1);
namespace FireflyIII\Helpers\Csv\Mapper;

use Auth;
use FireflyIII\Models\Budget as BudgetModel;

/**
 * Class Budget
 *
 * @package FireflyIII\Helpers\Csv\Mapper
 */
class Budget implements MapperInterface
{

    /**
     * @return array
     */
    public function getMap(): array
    {
        $result = Auth::user()->budgets()->get(['budgets.*']);
        $list   = [];

        /** @var BudgetModel $budget */
        foreach ($result as $budget) {
            $list[$budget->id] = $budget->name;
        }
        asort($list);

        $list = [0 => trans('firefly.csv_do_not_map')] + $list;

        return $list;
    }
}
