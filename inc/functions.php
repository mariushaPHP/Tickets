<?php

$validationErrors = [];

function saveFlight($data){

    $file = 'data/flights.txt'; // kelias iki failo
    $content = file_get_contents($file); // nusiskaito faila
    $formData = implode(',', $data); // Konvertuojam masyva i stringa
    $content .= $formData . "/n";
    file_put_contents($file, $content);
}

function getData(){
    $messages = file_get_contents('data/flights.txt');
    $messages = explode("/n", $messages); // Konvertuojam i masyva

    return $messages;
}

function validate($data){
    global $validationErrors;

    if(empty($data['nr'])){
        $validationErrors[] = 'Nepasirinktas skrydžio numeris';
    }

    if(empty($data['from'])){
        $validationErrors[] = 'Nepasirinktas išvykimas';
    }

    if(empty($data['to'])){
        $validationErrors[] = 'Nepasirinktas atvykimas';
    }

    if((!empty($data['from']) && !empty($data['to'])) && $data['from'] == $data['to']){
        $validationErrors[] = 'Blogai pasirinktas atvykimas';
    }

    if(empty($data['name']) || !preg_match('/^[A-Z]/', $data['name'])){
        $validationErrors[] = 'Neįvestas arba blogai įvestas vardas';
    }

    if(empty($data['lname']) || !preg_match('/^[A-Z]/', $data['lname'])){
        $validationErrors[] = 'Neįvesta arba blogai įvesta pavardė';
    }

    if(empty($data['code']) || !preg_match('/^[0-9]/', $data['code'])){
        $validationErrors[] = 'Neįvestas arba blogai įvestas asmens kodas';
    }

    if(empty($data['bag'])){
        $validationErrors[] = 'Nepasirinktas bagažas';
    }

    if(empty($data['price']) || !preg_match('/^[0-9]/', $data['price'])){
        $validationErrors[] = 'Neįvesta kaina';
    }

    if(empty($data['message']) || !preg_match('/^[A-Za-z0-9\s*]{1,200}$/', $data['message'])){
        $validationErrors[] = 'Neįvestas arba blogai įvestas tekstas';
    }

    return $validationErrors;
}

function saveTicket($nr){
    $data = file_get_contents('data/flights.txt');
    $data = explode("/n", $data);
    $ticket = $data[$nr];

    $file = 'data/ticket.txt'; // kelias iki failo
    file_put_contents($file, $ticket);
}

function getTicket(){
    $ticket = file_get_contents('data/ticket.txt');
    $ticket = explode(",", $ticket); // Konvertuojam i masyva

    return $ticket;
}

?>