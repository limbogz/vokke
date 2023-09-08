<?php

namespace App\Services\Kangaroo;

use App\Services\Kangaroo\Repositories\KangarooRepository;
use Illuminate\Support\Arr;

/**
 * KangarooService
 *
 * @author Limuel Bassig
 * @since 2023.09.07
 * @package App\Services\Kangaroo
 */
class KangarooService
{
    /**
     * constructor
     * @param KangarooRepository $oKangarooRepo
     */
    public function __construct(private KangarooRepository $oKangarooRepo) {}

    /**
     * getAllKangaroo
     * @return array
     */
    public function getAllKangaroo() : array
    {
        return $this->oKangarooRepo->getKangaroos();
    }

    /**
     * getKangarooById
     * @param array $aParams
     * @return mixed
     */
    public function getKangarooData(array $aParams) : mixed
    {
        return $this->oKangarooRepo->getKangarooData($aParams);
    }

    /**
     * processKangaroo
     * @param array $aParams
     * @param string $sType
     * @return mixed
     */
    public function processKangaroo(array $aParams, string $sType) : mixed
    {
        if ($sType === 'create') {
            //create kangaroo
            return $this->oKangarooRepo->createKangaroo($aParams);
        }
        //update kangaroo
        $iKangarooId = Arr::pull($aParams, 'kangaroo_id', 0);
        return $this->oKangarooRepo->updateKangaroo($iKangarooId, $aParams);
    }

    /**
     * checkDuplicateName
     * @param array $aParams
     * @return array
     */
    public function checkDuplicateName(array $aParams) : array
    {
        $sName = Arr::get($aParams, 'name', '');
        $aDupParams = [['name', $sName]];
        if (Arr::has($aParams, 'kangaroo_id') === true) {
            $aDupParams[] = ['kangaroo_id', '<>', $aParams['kangaroo_id']];
        }

        $aData = $this->oKangarooRepo->getKangarooData($aDupParams);
        if (empty($aData) === false) {
            return [
                'data' => [
                    'message' => 'The kangaroo name has already been taken.'
                ]
            ];
        }

        return [];
    }
}
