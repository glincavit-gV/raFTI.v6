<?php

namespace App\Services\FTI;

use App\Http\Traits\FTITrait;
use App\Http\Traits\MatchingTrait;
use App\Repositories\GustosWineEntityRepository;
use App\Repositories\GustosWineRepository;
use App\Repositories\VintageRepository;
use App\Services\BaseServiceInterface;
use App\Services\MatchingService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

global $fti_gustos_db;
$fti_gustos_db = config('database.connections.gustosapp.database'); // 'gustos';//

include_once 'v5_4/nfc.php';
include_once 'v5_4/nfc_api.php';
include_once 'v5_4/nfc_rs.php';
include_once 'v5_4/nfc_sql.php';
include_once 'v5_4/nfc_rep.php';
include_once 'v5_4/nfc_dups_sql.php';
include_once 'v5_4/parsed__exDB.php';
include_once 'v5_4/parsed__exDB_sql.php';
include_once 'v5_4/nfc_updates.php';
include_once 'v5_4/nfc_word.php';
include_once 'v5_4/regions_preserv.php';
include_once 'v5_4/src_region_sql.php';
include_once 'v6/_m0_RA/_o00Za_raCORE__acPP_api.php';

class FTIService implements BaseServiceInterface
{
    use MatchingTrait;
    use FTITrait;

    public function __construct()
    {
        global $fti_seg, $fti_level, $fti_max_level, $fti_sq, $fti_expra, $fti_frpm_re, $fti_log, $fti_sw_term, $fti_sw_repl,
               $fti_dihotomy_on, $fti_word_1st, $fti_merged_forms, $fti_merged_terms, $fti_var,
               $fti_exWINE, $fti_exVINE, $fti_exREGI, $fti_exGRAP, $fti_exPARS, $fti_sttFINC, $fti_expr__arP, $fti_type__arP,
               $fti_scnMyNAM, $fti_scnMyNVV, $fti_scnMyALL, $fti_scnRaNAM, $fti_scnRaNVV, $fti_scnRaALL,
               $fti_expr_cnt, $fti_word_cnt, $fti_tables, $fti_gustos_db, $fti_project_db;
        $fti_project_db = 'parsedwine';
        // echo "\nHello from FTI\n";
    }

    public function jobAPI($step, $arg_val) {
      if (substr($step, 0, 2) == 'v6') {
        _raCORE_api($step, $arg_val);
      } else {
        nfc_api($step, $arg_val);
      }
    }

    public function match($wine_id): array
    {
        $fti_match_data = $this->getFtiMatchWinesData($wine_id);
        $fti_match = $fti_match_data['fti_match'];
        $gustos_wine = $fti_match_data['gustos_wines'];

        if (empty($gustos_wine)) {
            return [];
        }

        if (!empty($fti_match)) {
            $fti_match = object2Array($fti_match);
        }

        if (is_array($wine_id)) {
            $matchingData = [];
            $fti_match = array_combine(array_column($fti_match, 'parsedwine_id'), $fti_match);
            foreach($fti_match as $wineId => $match) {
                $matchingData[$wineId] = [
                    'score' => $match['score__niBQ'],
                    'action' => $match['action__dsP'],
                    'wine' => $gustos_wine->where('vintage_id', $match['wine_entity_id'])->first(),
                ];
            }
        }
        else {
            $matchingData = [
                'wine' => null,
                'count' => 0,
                'ids' => [],
            ];

            if ($gustos_wine->isNotEmpty()) {
                $matchingData['count'] = $gustos_wine->count();

                uasort($fti_match, function ($a, $b) {
                    return $a['score__arP'] <=> $b['score__arP'];
                });

                foreach($fti_match as $match) {
                    $gustosWine = $gustos_wine->where('vintage_id', $match['wine_entity_id'])->first();

                    $matchingData['ids'][$gustosWine->id] = [
                        'wine_id' => $gustosWine->id,
                        'vintage_id' => $gustosWine->vintage_id,
                        'description' => $this->buildMatchingWinesDescription($gustosWine),
                        'score' => $match['score__niBQ'],
                    ];

                    $matchingData['possible_actions'][] = ['action' => $match['action__dsP'], 'wine_id' => $gustosWine->id];
                    $matchingData['scores'][] = ['score' => number_format($match['score__niBQ'], 0, ',', ' '), 'wine_id' => $gustosWine->id];
                }

                // Reset array keys.
                $matchingData['ids'] = array_values($matchingData['ids']);
                usort($matchingData['ids'], function ($a, $b) {
                    return $b['score'] <=> $a['score'];
                });

                $firstWine = null;
                foreach ($gustos_wine as $wine) {
                    if ($wine->id == $matchingData['ids'][0]['wine_id'] && $wine->vintage_id == $matchingData['ids'][0]['vintage_id']) {
                        $firstWine = $wine;
                        break;
                    }
                }

                if (!empty($firstWine)) {
                    $matchingData['wine'] = $this->buildMatchingWine($firstWine, $firstWine->gustosWineEntityVintage);

                    $matchingData['selected_wine'] = [
                        'wine_id' => $firstWine->id,
                        'vintage_id' => $firstWine->vintage_id,
                    ];

                    $verifiedWineries = [];
                    if (!empty($firstWine->vineyard)) {
                        $verifiedWineries = app(MatchingService::class)->verifyWineries([$firstWine->vineyard]);
                    }
                    $matchingData['verified_winery'] = !empty($firstWine->vineyard) && in_array($firstWine->vineyard, $verifiedWineries);
                }
            }
        }
        return $matchingData;
    }

    private function getFtiMatchWinesData($wine_id): Collection
    {
        $result = [
            'fti_match' => [],
            'gustos_wines' => []
        ];
        $fti_match = nfc_match($wine_id);

        if (!empty($fti_match)) {
            $gustosWines = app(GustosWineRepository::class)->with(['gustosWineEntityVintage.grapes', 'vineyardGustos', 'colorGustos', 'co2Gustos', 'country_taxonomy'])->search(['filter' => ['wine_entity_id' => array_column($fti_match, 'wine_entity_id')]], [], null, null, ['gustosWineEntityJoin'], 'gustos_wine.*, gustos_wine_entity.id as vintage_id');
            $result['fti_match'] = $fti_match;
            $result['gustos_wines'] = $gustosWines;
        }

        return collect($result);
    }

    protected function buildMatchingWinesDescription($wine): string
    {
        $info = [];
        if ($wine instanceof \App\Models\GustosWine) {
            if ($wine->vineyardGustos) {
                $info[] = $wine->vineyardGustos->name;
            }
            $info[] = $wine->country_taxonomy->name;
            $info[] = $wine->name;
            $info[] = $wine->gustosWineEntityVintage->vintage;
        }
        elseif ($wine instanceof \App\Models\GustosWineEntity) {
            if ($wine->gustosWine->vineyardGustos) {
                $info[] = $wine->gustosWine->vineyardGustos->name;
            }
            $info[] = $wine->gustosWine->country_taxonomy->name;
            $info[] = $wine->gustosWine->name;
            $info[] = $wine->vintage;
        }

        return implode(' / ', $info);
    }

    public function useFTI(): bool{
        return (bool)nfc_getVar('match_new', 0);
    }
}



