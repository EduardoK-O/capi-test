<?php

namespace App\Repositories\Interfaces;

interface ContactoRepositoryInterface {
    public function getAllContactos();
    public function getContactoById($id);
    public function createContacto(array $data);
    public function updateContacto($id, array $data);
    public function deleteContacto($id);
}