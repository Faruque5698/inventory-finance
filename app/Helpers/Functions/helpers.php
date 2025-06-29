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
