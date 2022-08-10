<?php

namespace Marvel\Traits;

trait Excludable
{

    /**
     * Get the array of columns
     * @return mixed
     */
    private function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * Exclude an array of elements from the result.
     * @param $query
     * @param $columns
     * @return mixed
     */
    public function scopeExclude($query, $columns)
    {
        return $query->select(array_diff($this->getTableColumns(), (array) $columns));
    }
}
