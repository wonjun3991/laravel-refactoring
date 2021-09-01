<?php

namespace App\Http\Controllers;

use App\Consultants\ClinicCounselor;
use App\Consultants\DietExpert;
use App\Consultants\FitnessCoach;
use App\Consultants\PersonalTrainer;
use App\Http\Requests\FatRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FatController extends Controller
{
    private $personalTrainer;

    public function __construct(PersonalTrainer $personalTrainer)
    {
        $this->personalTrainer = $personalTrainer;
    }

    public function __invoke(FatRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $isRich = in_array('rich', $validatedData['life_style_tag']);
        $hasAStrongWill = in_array('strong_will', $validatedData['life_style_tag']);
        $hasGoodHealth = in_array('healthy', $validatedData['life_style_tag']);
        $hasEnoughTime = in_array('enough_time', $validatedData['life_style_tag']);

        $result = $this->personalTrainer->recommend($validatedData['preferred_types_order'], $isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        return response()->json($result);
    }
}
