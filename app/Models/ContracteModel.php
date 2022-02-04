<?php 

namespace App\Models;

class ContracteModel extends \CodeIgniter\Model 
{
    protected $table = 'cdi_contract';

    protected $primaryKey = 'id'; 

    protected $useTimestamps = true;

    protected $allowedFields = ['nume', 'sex', 'cnp', 'email', 'tel', 'data', 'deleted'];

    protected $validationRules = [
        'nume'  => 'required',
        'sex'   => 'required',
        'cnp'   => 'required|valid_cnp',
        'email' => 'required|valid_email'
    ];

    protected $validationMessages = [
        'nume' => [
            'required' => 'Acest camp este obligatoriu'
        ],
        'sex' => [
            'required' => 'Acest camp este obligatoriu'
        ],
        'cnp' => [
            'required' => 'Acest camp este obligatoriu',
            'valid_cnp' => 'Valoarea CNP nu este valida'
        ],
        'email' => [
            'required' => 'Acest camp este obligatoriu',
            'valid_email' => 'Adresa de e-mail nu este valida'
        ]
    ];

    protected $returnType = 'App\Entities\Contracte';
}