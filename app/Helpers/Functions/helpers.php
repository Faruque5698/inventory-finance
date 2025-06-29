<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

if (!function_exists('limit')) {
    /**
     * @param $query
     * @return int|mixed $paginate,
     */
    function limit($query)
    {
        $paginate = 10;

        if (array_key_exists('limit', $query)) {
            if ($query['limit']) {
                $paginate = $query['limit'];
            }
        }

        return $paginate;
    }
}

if (!function_exists('slugGenerate')){
    /**
     * @param $name
     * @param $table_name
     * @return string
     */
    function slugGenerate($name, $table_name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $i = 1;

        while (DB::table($table_name)->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}

if (!function_exists('generateSequentialUniqueCode')) {
    /**
     * @param string $prefix
     * @param string $table
     * @param string $column
     * @param int $padLength
     * @return string
     */
    function generateSequentialUniqueCode(string $prefix, string $table, string $column = 'code', int $padLength = 6)
    {
        $latestCode = DB::table($table)
            ->where($column, 'like', "$prefix-%")
            ->orderByDesc($column)
            ->value($column);

        if ($latestCode) {
            $number = (int) str_replace($prefix . '-', '', $latestCode);
        } else {
            $number = 0;
        }

        $newNumber = $number + 1;
        $formattedNumber = str_pad($newNumber, $padLength, '0', STR_PAD_LEFT);

        return $prefix . '-' . $formattedNumber;
    }
}
