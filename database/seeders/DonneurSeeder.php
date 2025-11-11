<?php
// database/seeders/DonneurSeeder.php

namespace Database\Seeders;

use App\Models\Donneur;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DonneurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donneurs = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@email.com',
                'telephone' => '0123456789',
                'groupe_sanguin' => 'A+',
                'ville' => 'Paris',
                'date_naissance' => '1985-03-15',
                'genre' => 'Homme',
                'dernier_don' => '2024-01-10',
                'disponible' => false,
                
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Marie',
                'email' => 'marie.martin@email.com',
                'telephone' => '0123456790',
                'groupe_sanguin' => 'O-',
                'ville' => 'Lyon',
                'date_naissance' => '1990-07-22',
                'genre' => 'Femme',
                'dernier_don' => null,
                'disponible' => true,
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Pierre',
                'email' => 'pierre.bernard@email.com',
                'telephone' => '0123456791',
                'groupe_sanguin' => 'B+',
                'ville' => 'Marseille',
                'date_naissance' => '1988-11-30',
                'genre' => 'Homme',
                'dernier_don' => '2024-02-15',
                'disponible' => false,
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Sophie',
                'email' => 'sophie.dubois@email.com',
                'telephone' => '0123456792',
                'groupe_sanguin' => 'AB+',
                'ville' => 'Toulouse',
                'date_naissance' => '1992-05-18',
                'genre' => 'Femme',
                'dernier_don' => '2023-12-05',
                'disponible' => true,
            ],
            [
                'nom' => 'Moreau',
                'prenom' => 'Luc',
                'email' => 'luc.moreau@email.com',
                'telephone' => '0123456793',
                'groupe_sanguin' => 'A-',
                'ville' => 'Nice',
                'date_naissance' => '1983-09-12',
                'genre' => 'Homme',
                'dernier_don' => '2024-03-01',
                'disponible' => false,
            ],
            [
                'nom' => 'Lefebvre',
                'prenom' => 'Isabelle',
                'email' => 'isabelle.lefebvre@email.com',
                'telephone' => '0123456794',
                'groupe_sanguin' => 'O+',
                'ville' => 'Bordeaux',
                'date_naissance' => '1995-12-03',
                'genre' => 'Femme',
                'dernier_don' => '2024-01-20',
                'disponible' => true,
            ],
            [
                'nom' => 'Garcia',
                'prenom' => 'Miguel',
                'email' => 'miguel.garcia@email.com',
                'telephone' => '0123456795',
                'groupe_sanguin' => 'B-',
                'ville' => 'Lille',
                'date_naissance' => '1987-04-25',
                'genre' => 'Homme',
                'dernier_don' => null,
                'disponible' => true,
            ],
            [
                'nom' => 'Rousseau',
                'prenom' => 'Céline',
                'email' => 'celine.rousseau@email.com',
                'telephone' => '0123456796',
                'groupe_sanguin' => 'AB-',
                'ville' => 'Strasbourg',
                'date_naissance' => '1991-08-14',
                'genre' => 'Femme',
                'dernier_don' => '2023-11-10',
                'disponible' => true,
            ],
            [
                'nom' => 'Fournier',
                'prenom' => 'Antoine',
                'email' => 'antoine.fournier@email.com',
                'telephone' => '0123456797',
                'groupe_sanguin' => 'A+',
                'ville' => 'Nantes',
                'date_naissance' => '1980-06-30',
                'genre' => 'Homme',
                'dernier_don' => '2024-02-28',
                'disponible' => false,
            ],
            [
                'nom' => 'Petit',
                'prenom' => 'Élodie',
                'email' => 'elodie.petit@email.com',
                'telephone' => '0123456798',
                'groupe_sanguin' => 'O-',
                'ville' => 'Montpellier',
                'date_naissance' => '1993-02-17',
                'genre' => 'Femme',
                'dernier_don' => '2024-01-05',
                'disponible' => true,
            ],
            [
                'nom' => 'Leroy',
                'prenom' => 'Thomas',
                'email' => 'thomas.leroy@email.com',
                'telephone' => '0123456799',
                'groupe_sanguin' => 'B+',
                'ville' => 'Rennes',
                'date_naissance' => '1986-10-08',
                'genre' => 'Homme',
                'dernier_don' => '2023-10-15',
                'disponible' => true,
            ],
            [
                'nom' => 'Morel',
                'prenom' => 'Sarah',
                'email' => 'sarah.morel@email.com',
                'telephone' => '0123456800',
                'groupe_sanguin' => 'A-',
                'ville' => 'Toulon',
                'date_naissance' => '1994-03-22',
                'genre' => 'Femme',
                'dernier_don' => null,
                'disponible' => true,
            ],
            [
                'nom' => 'Simon',
                'prenom' => 'David',
                'email' => 'david.simon@email.com',
                'telephone' => '0123456801',
                'groupe_sanguin' => 'O+',
                'ville' => 'Grenoble',
                'date_naissance' => '1989-07-11',
                'genre' => 'Homme',
                'dernier_don' => '2024-03-10',
                'disponible' => false,
            ],
            [
                'nom' => 'Laurent',
                'prenom' => 'Nathalie',
                'email' => 'nathalie.laurent@email.com',
                'telephone' => '0123456802',
                'groupe_sanguin' => 'AB+',
                'ville' => 'Dijon',
                'date_naissance' => '1984-01-29',
                'genre' => 'Femme',
                'dernier_don' => '2023-09-20',
                'disponible' => true,
            ],
            [
                'nom' => 'Michel',
                'prenom' => 'Philippe',
                'email' => 'philippe.michel@email.com',
                'telephone' => '0123456803',
                'groupe_sanguin' => 'B-',
                'ville' => 'Le Havre',
                'date_naissance' => '1979-12-05',
                'genre' => 'Homme',
                'dernier_don' => '2024-02-01',
                'disponible' => false,
            ]
        ];

        foreach ($donneurs as $donneur) {
            Donneur::create($donneur);
        }

        $this->command->info(count($donneurs) . ' donneurs ont été créés avec succès!');
    }
}