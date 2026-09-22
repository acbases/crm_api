<?php

namespace App\Repositories\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait FiltrePeriode
{
    /** Restricts a query to a given year and/or month of the given date column. */
    private function filtrerParPeriode(Builder $query, string $colonneDate, ?int $annee, ?int $mois): Builder
    {
        if ($annee) {
            $query->whereYear($colonneDate, $annee);
        }

        if ($mois) {
            $query->whereMonth($colonneDate, $mois);
        }

        return $query;
    }

    private function pourcentage(float $valeur, float $total): ?float
    {
        return $total > 0 ? round($valeur / $total * 100, 2) : null;
    }
}
