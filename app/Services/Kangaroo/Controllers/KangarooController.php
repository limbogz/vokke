<?php

namespace App\Services\Kangaroo\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Kangaroo\KangarooService;
use App\Services\Kangaroo\Requests\KangarooIdRequest;
use App\Services\Kangaroo\Requests\KangarooRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * KangarooController
 *
 * @author Limuel Bassig
 * @since 2023.09.07
 * @package App\Services\Kangaroo\Controllers
 */
class KangarooController extends Controller
{
    /**
     * @param KangarooService $oKangarooService
     */
    public function __construct(private KangarooService $oKangarooService) {}

    /**
     * createKangaroo
     * @param KangarooRequest $oRequest
     * @return JsonResponse
     */
    public function createKangaroo(KangarooRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oKangarooService->processKangaroo($oRequest->validated(), 'create');
        return response()->json($aResult);
    }

    /**
     * updateKangaroo
     * @param KangarooRequest $oRequest
     * @return JsonResponse
     */
    public function updateKangaroo(KangarooRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oKangarooService->processKangaroo($oRequest->validated(), 'update');
        return response()->json($aResult);
    }

    /**
     * getAllKangaroo
     * @return JsonResponse
     */
    public function getAllKangaroo() : JsonResponse
    {
        return response()->json($this->oKangarooService->getAllKangaroo());
    }

    /**
     * getKangarooById
     * @param KangarooIdRequest $oRequest
     * @return JsonResponse
     */
    public function getKangarooById(KangarooIdRequest $oRequest) : JsonResponse
    {
        return response()->json($this->oKangarooService->getKangarooData($oRequest->validated()));
    }

    /**
     * getKangarooById
     * @param Request $oRequest
     * @return JsonResponse
     */
    public function checkDuplicateName(Request $oRequest) : JsonResponse
    {
        return response()->json($this->oKangarooService->checkDuplicateName($oRequest->all()));
    }
}
