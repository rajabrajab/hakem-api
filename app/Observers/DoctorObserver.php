<?php

namespace App\Observers;

use App\Models\Doctor;
use App\Models\DoctorTimeReservation;
use Carbon\Carbon;

class DoctorObserver
{
    /**
     * Handle the Doctor "created" event.
     */
    public function created(Doctor $doctor): void
    {
        //
    }

    /**
     * Handle the Doctor "updated" event.
     */
    public function updated(Doctor $doctor): void
    {
        if ($doctor->wasChanged(['appointment_duration', 'clinic_start_time', 'clinic_end_time'])) {

            $doctor->timeReservations()->forceDelete();

            $this->createTimeReservations($doctor);
        }
    }

    /**
     * Handle the Doctor "deleted" event.
     */
    public function deleted(Doctor $doctor): void
    {
        //
    }

    /**
     * Handle the Doctor "restored" event.
     */
    public function restored(Doctor $doctor): void
    {
        //
    }

    /**
     * Handle the Doctor "force deleted" event.
     */
    public function forceDeleted(Doctor $doctor): void
    {
        //
    }

     protected function createTimeReservations(Doctor $doctor) : void
    {
        $appointmentDuration = $doctor->appointment_duration;
        $startTime = Carbon::parse($doctor->clinic_start_time);
        $endTime = Carbon::parse($doctor->clinic_end_time);

        while($startTime->lt($endTime)){
            $slotEndTime = $startTime->copy()->addMinutes($appointmentDuration);

            DoctorTimeReservation::create([
                'doctor_id' => $doctor->id,
                'start_time' => $startTime->format('H:i') ,
                'end_time' => $slotEndTime->format('H:i') ,
            ]);

            $startTime->addMinutes($appointmentDuration);
        }
    }
}
