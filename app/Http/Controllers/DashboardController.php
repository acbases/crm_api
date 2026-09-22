<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use App\Services\PlvStatsService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;
    protected $plvStatsService;

    public function __construct(DashboardService $dashboardService, PlvStatsService $plvStatsService)
    {
        $this->dashboardService = $dashboardService;
        $this->plvStatsService = $plvStatsService;
    }

    public function getProduitStats(Request $request)
    {
        $request->validate([
            'limit' => ['nullable', 'integer', 'min:1'],
            'annee' => ['nullable', 'integer', 'digits:4'],
            'mois' => ['nullable', 'integer', 'between:1,12'],
        ]);

        $limit = $request->query('limit') ? (int) $request->query('limit') : null;
        $annee = $request->query('annee') ? (int) $request->query('annee') : null;
        $mois = $request->query('mois') ? (int) $request->query('mois') : null;

        return response()->json(
            $this->dashboardService->getProduitStats($limit, $annee, $mois)
        );
    }

    public function getProduitDetail(Request $request)
    {
        $request->validate([
            'type' => ['required', 'in:catalogue,autre'],
            'produit_id' => ['required_if:type,catalogue', 'integer'],
            'nom' => ['required_if:type,autre', 'string'],
            'annee' => ['nullable', 'integer', 'digits:4'],
            'mois' => ['nullable', 'integer', 'between:1,12'],
        ]);

        $type = $request->query('type');
        $produitId = $request->query('produit_id') ? (int) $request->query('produit_id') : null;
        $nom = $request->query('nom');
        $annee = $request->query('annee') ? (int) $request->query('annee') : null;
        $mois = $request->query('mois') ? (int) $request->query('mois') : null;

        $detail = $this->dashboardService->getProduitDetail($type, $produitId, $nom, $annee, $mois);

        if (! $detail) {
            return response()->json([
                'message' => 'Produit introuvable ou aucune donnée sur la période demandée',
            ], 404);
        }

        return response()->json($detail);
    }

    public function getPlvStats(Request $request)
    {
        $request->validate([
            'annee' => ['nullable', 'integer', 'digits:4'],
            'mois' => ['nullable', 'integer', 'between:1,12'],
        ]);

        $annee = $request->query('annee') ? (int) $request->query('annee') : null;
        $mois = $request->query('mois') ? (int) $request->query('mois') : null;

        return response()->json(
            $this->plvStatsService->getPlvStats($annee, $mois)
        );
    }
}
