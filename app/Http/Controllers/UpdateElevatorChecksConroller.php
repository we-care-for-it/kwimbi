<?php
namespace App\Http\Controllers;

use App\Models\Elevator;
use Carbon\Carbon;
use DB;

class UpdateElevatorChecksConroller extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * process login with socialite package
     */

    /**
     * login with google and redirect to dashboard
     *
     * @return \Illuminate\View\View
     */

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && strtolower($d->format($format)) === strtolower($date);
    }

    public function update()
    {

        $elevators = Elevator::query()
            ->whereHas('latestInspection', fn($subQuery) => $subQuery
                    ->where('end_date', '<', Carbon::today())
                    ->whereColumn('id', DB::raw('(SELECT id FROM object_inspections WHERE object_inspections.elevator_id = elevators.id and deleted_at is null ORDER BY end_date DESC LIMIT 1)'))
            )->get();

        foreach ($elevators as $elevator) {

            Elevator::where('id', $elevator->id)->update([
                'current_inspection_end_date'  => $elevator->latestInspection->end_date ?? null,
                'current_inspection_status_id' => $elevator->latestInspection->status_id ?? null,
            ]);
        }

    }

}
