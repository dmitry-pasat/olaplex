<?php

class ValidationRules
{

    public static function _validation_in_array_keys($val, $list)
    {
        return in_array($val, array_keys($list));
    }

    public static function _validation_in_array($val, $list, $caseSensitive = true)
    {
        if ($caseSensitive) return in_array($val, $list);
        return in_array(strtolower($val), array_map('strtolower', $list));
    }

    public static function _validation_exists($val, $options, $filter = null)
    {
        list($table, $field) = explode('.', $options);

        $q = DB::select("LOWER (\"$field\")")->where($field, '=', Str::lower($val));
        if ($filter) $q->where($filter[0], $filter[1], $filter[2]);
        $result = $q->from($table)->execute();

        return ($result->count() > 0);
    }

    public function _validation_is_upper($val)
    {
        return $val === strtoupper($val);
    }


}

