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

    /**
     * Restricts a query (which must already join 'visite') to visits made at clients
     * of a given agence. No-op if $agenceId is null. Joins 'client' if not already
     * joined by the caller.
     */
    private function filtrerParAgence(Builder $query, ?int $agenceId, bool $clientDejaJoint = false): Builder
    {
        if (! $agenceId) {
            return $query;
        }

        if (! $clientDejaJoint) {
            $query->join('client', 'visite.idclient', '=', 'client.id');
        }

        return $query->where('client.idagence', $agenceId);
    }

    private function pourcentage(float $valeur, float $total): ?float
    {
        return $total > 0 ? round($valeur / $total * 100, 2) : null;
    }
}
