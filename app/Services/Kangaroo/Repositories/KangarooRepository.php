<?php

namespace App\Services\Kangaroo\Repositories;

use App\Services\Kangaroo\Models\Kangaroo;

/**
 * KangarooRepository
 *
 * @author Limuel Bassig
 * @since 2023.09.07
 * @package App\Services\Kangaroo\Repositories
 */
class KangarooRepository
{
    /**
     * getKangaroos
     * @return array
     */
    public function getKangaroos() : array
    {
        return Kangaroo::orderBy('kangaroo_id', 'DESC')->get()->toArray();
    }

    /**
     * createKangaroo
     * @param array $aParams
     * @return mixed
     */
    public function createKangaroo(array $aParams) : mixed
    {
        return Kangaroo::create($aParams);
    }

    /**
     * updateKangaroo
     * @param int $iKangarooId
     * @param array $aParams
     * @return mixed
     */
    public function updateKangaroo(int $iKangarooId, array $aParams) : mixed
    {
        return Kangaroo::where('kangaroo_id', $iKangarooId)->update($aParams);
    }

    /**
     * getKangarooData
     * @param array $aParams
     * @return mixed
     */
    public function getKangarooData(array $aParams) : mixed
    {
        return Kangaroo::where($aParams)->first();
    }
}
