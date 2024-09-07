<?php

namespace App\Services;

use App\Repositories\Interfaces\ContactoRepositoryInterface;

class ContactoService {
    protected $contactoRepository;

    public function __construct(ContactoRepositoryInterface $contactoRepository) {
        $this->contactoRepository = $contactoRepository;
    }
    
    /**
     * Retrieve all contact records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllContactos() {
        return $this->contactoRepository->getAllContactos();
    }

    /**
     * Retrieve a contact record by its ID.
     *
     * @param int $id
     * @return \App\Models\Contacto|null
     */
    public function getContactoById($id) {
        return $this->contactoRepository->getContactoById($id);
    }

    /**
     * Create a new contact record.
     *
     * @param array $data
     * @return \App\Models\Contacto
     */
    public function createContacto(array $data){
        return $this->contactoRepository->createContacto($data);
    }

    /**
     * Update an existing contact record.
     *
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateContacto($id, array $data){
        return $this->contactoRepository->updateContacto($id, $data);
    }

    /**
     * Delete a contact record by its ID.
     *
     * @param int $id
     * @return int
     */
    public function deleteContacto($id) {
        return $this->contactoRepository->deleteContacto($id);
    }
}
