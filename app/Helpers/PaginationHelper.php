<?php

namespace App\Helpers;

Class PaginationHelper
{
    public function getPaginationData($request)
    {
        $paginationDefaults = [
            'page' => config('pagination.default.page'),
            'per_page' => config('pagination.default.per_page')
        ];

        $page = (int) $request->query('page', config('pagination.default.page', 1));
        $take = (int) $request->query('per_page',  config('pagination.default.per_page', 10));
        $take = (int) $take > config('pagination.default.max_per_page', 100) ? config('pagination.default.max_per_page', 100) : $take;

        $offset = ($page -1 ) * $take;

        return compact('take', 'offset');
    }
}
