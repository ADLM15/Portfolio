<?php

class Customer{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $address;

public function __construct(int $id, string $firstName, string $lastName, string $email, string $address){
    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->address = $address;
}

public function getFullName(): string {
    return "{$this->firstName} {$this->LastName}";
}
}