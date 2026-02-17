<?php
class Hotel {
    private string $name;
    private string $adress;
    private array $rooms = [];
    private array $reservations = [];

    public function __construct(string $name, string $adress){
        $this->name = $name;
        $this->adress = $adress;
    }
    public function getName():string {
        return $this->name;
    }

    public function addRoom(Room $room):void{
        $this->rooms[] = $room;
    }
    public function getShowRooms(){
        foreach($this->rooms as $room){
            echo "
 - {$room->getNumber()}";
        }
    }
    public function getAvailableRooms():array{
        $available = [];
        foreach($this->rooms as $room){
            $available[]=$room;
        }
        return $available;
    }
    public function makeReservation( Customer $client, Room $room, DateTime $debut,DateTime $fin): ?Reservation{
        // verifier si chambre reserver sur periode isRoomAvailable()
        $res = new Reservation($client, $room, $debut, $fin);
            $this->reservations[] = $res;
            return $res;
        }
    }
class Room {
    private int $nb;
    private int $capacity;
    private float $pricePerNight;
    
    public function __construct (int $nb, int $capacity, float $pricePerNight){
        $this->nb = $nb;
        $this->capacity = $capacity;
        $this->pricePerNight = $pricePerNight;
    }
    // les getters
    public function getNumber(){
        return $this->nb;
    }
}

class Customer {
    private string $name;
    private string $email;

    public function __construct(string $name, string $email){
        $this->name = $name;
        $this->email = $email;
    }
}
class Reservation {
    private Customer $customer;
    private Room $room;
    private DateTime $checkIn;
    private DateTime $checkOut;
    private string $status;

    public function __construct(Customer $customer, Room $room, DateTime $checkIn, DateTime $checkOut){
         $this->customer = $customer;
        $this->room = $room;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->status = 'confirmed';
    }
    public function getRoom():Room {
        return $this->room;
    }
    public function getCheckIn():DateTime {
        return $this->checkIn;
    }
    public function getCheckOut():DateTime {
        return $this->checkOut;
    }
    public function cancel():void{
        $this->status = 'cancelled';
    }
    public function isActive():bool{
        return $this->status === "confirmed";
    }
}


$test = new Hotel('testHotel', 'ceci est mon adress');
echo "{$test->getName()}";
$test->addRoom(new Room(100, 2, 90.0));
$test->addRoom(new Room(101, 5, 345.0));

$debut = new DateTime("2026-07-10");
$fin = new DateTime("2026-07-10");
$client = new Customer("Jean Bon", 'jeanBon@exemple.com');
$disponible = $test->getAvailableRooms();

$reservation = $test->makeReservation($client, $disponible[0], $debut,$fin);

echo "
{$reservation->getRoom()->getNumber()}";

 