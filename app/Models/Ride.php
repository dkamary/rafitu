<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $table = 'ride';
    protected $primaryKey = 'id';
    protected $fillable = [
        'owner_id', 'vehicle_id', 'driver_id',
        'departure_label', 'departure_date', 'departure_position_long', 'departure_position_lat',
        'arrival_label', 'arrival_date', 'arrival_position_long', 'arrival_position_lat',
        'seats_available', 'woman_only', 'price', 'smokers', 'animals',
        'ride_status_id', 'distance', 'duration',
        'created_at', 'updated_at',
        'has_recurrence',
    ];
    public $timestamps = false;
    protected $status = null;
    protected $owner = null;
    protected $vehicule = null;
    protected $driver = null;
    protected $itineraries = null;
    protected $reservations = null;

    public function __toString(): string
    {
        return sprintf(
            'Départ de %s à %s vers %s',
            $this->departure_label,
            $this->getDepartureDate(),
            $this->arrival_label
        );
    }

    public function getDepartureLabel(bool $short = false, string $separator = ',') : string {
        $departureLabel = $this->departure_label ?: '';
        if(!$short) return $departureLabel;

        return $this->getShortLabel($departureLabel, $separator);
    }

    public function getArrivalLabel(bool $short = false, string $separator = ',') : string {
        $arrivalLabel = $this->arrival_label ?: '';
        if(!$short) return $arrivalLabel;

        return $this->getShortLabel($arrivalLabel, $separator);
    }

    public function getShortLabel(string $label, string $separator = ',') : string {
        $elements = explode($separator, $label);

        return $elements[0] ?? $label;
    }

    public function getLabel(): string
    {
        return sprintf('%s à %s', $this->departure_label, $this->arrival_label);
    }

    public function getReservations(): ?Collection
    {
        return ($this->reservations) ?: $this->reservations = Reservation::where('ride_id', '=', (int)$this->id)->orderBy('reservation_date')->orderBy('payment_date')->get();
    }

    public function getReservationsCount(): int
    {
        $reservations = $this->getReservations();

        return is_countable($reservations) ? count($reservations) : 0;
    }

    public function getSeatsAvailable(): int
    {
        $reservations = $this->getReservations();
        $count = 0;
        foreach ($reservations as $res) {
            $count += $res->passenger;
        }

        return $this->seats_available - $count;
    }

    public function getItineraries()
    {
        return ($this->itineraries) ?: $this->itineraries = RideItinerary::where('ride_id', '=', (int)$this->id)->get();
    }

    public function getDriver(): ?User
    {
        return ($this->driver) ?: $this->driver = User::where('id', '=', (int)$this->driver_id)->first();
    }

    public function getVehicule(): ?Vehicule
    {
        return ($this->vehicule) ?: $this->vehicule = Vehicule::where('id', '=', (int)$this->vehicle_id)->first();
    }

    public function getOwner(): ?User
    {
        if ($this->owner) return $this->owner;

        $this->owner = User::where('id', '=', (int)$this->owner_id)->first();

        return $this->owner;
    }

    public function getStatus(): ?RideStatus
    {
        if ($this->status) return $this->status;

        $this->status = RideStatus::where('id', '=', (int)$this->ride_status_id)->first();

        return $this->status;
    }

    public function getDistance(string $unit = 'km', int $precision = 2): string
    {
        $units = [
            'km' => 1000,
            'm' => 1,
        ];

        return number_format((int)$this->distance / ($units[$unit] ?? 1), $precision, ',', ' ') . ' ' . $unit;
    }

    public function hasDepartureDate(): bool
    {
        return $this->hasDate($this->departure_date);
    }

    public function hasArrivalDate(): bool
    {
        return $this->hasDate($this->arrival_date);
    }

    public function getDepartureDate(string $format = 'd/m/Y H:i'): string
    {
        if (is_null($this->departure_date) || $this->departure_date == '') return '';

        return $this->getDate($this->departure_date, $format);
    }

    public function getArrivalDate(string $format = 'd/m/Y H:i'): string
    {
        if (is_null($this->arrival_date) || $this->arrival_date == '') return '';

        return $this->getDate($this->arrival_date, $format);
    }

    public function getDateDeparture(): DateTime
    {
        return new DateTime($this->departure_date);
    }

    public function getDateArrival(): DateTime
    {
        return new DateTime($this->arrival_date);
    }

    private function hasDate($date): bool
    {
        if (is_null($date) || trim(strlen($date)) < 10) return false;

        return true;
    }

    private function getDate(string $date, string $format): string
    {
        $datetime = new DateTime($date);

        return $datetime->format($format);
    }

    public function hasRecurrence() : bool {
        return $this->has_recurrence == 1;
    }

    public function getDuration(bool $formated = false) {
        if(!$formated) return $this->duration;

        $time = (int)$this->duration;
        $hours = 0;
        $minutes = (int)($time / 60);
        $seconds = $time - ($minutes * 60);
        if ($minutes > 60) {
            $hours = (int)($minutes / 60);
            $minutes = $minutes - ($hours * 60);
        }
        $display = sprintf(
            '%s:%s',
            str_pad($hours, 2, '0', STR_PAD_LEFT),
            str_pad($minutes, 2, '0', STR_PAD_LEFT)
        );

        return $display;
    }
}
