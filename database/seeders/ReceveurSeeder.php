<?php

namespace Database\Seeders;

use App\Models\Receveur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceveurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $receveurs = [
            [
                'nom' => 'Alaoui',
                'prenom' => 'Fatima',
                'email' => 'fatima.alaoui@email.com',
                'telephone' => '+212 612-345678',
                'ville' => 'Casablanca',
                'groupe_sanguin' => 'A+',
                'besoin_medical' => 'Chirurgie cardiaque programmée',
                'date_urgence' => '2024-02-15',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'Benjelloun',
                'prenom' => 'Mehdi',
                'email' => 'mehdi.benjelloun@email.com',
                'telephone' => '+212 623-456789',
                'ville' => 'Rabat',
                'groupe_sanguin' => 'O-',
                'besoin_medical' => 'Accident de la route - besoin urgent',
                'date_urgence' => '2024-01-20',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'Chraibi',
                'prenom' => 'Amina',
                'email' => 'amina.chraibi@email.com',
                'telephone' => '+212 634-567890',
                'ville' => 'Marrakech',
                'groupe_sanguin' => 'B+',
                'besoin_medical' => 'Accouchement à risque',
                'date_urgence' => '2024-01-25',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'El Fassi',
                'prenom' => 'Youssef',
                'email' => 'youssef.elfassi@email.com',
                'telephone' => '+212 645-678901',
                'ville' => 'Fès',
                'groupe_sanguin' => 'AB+',
                'besoin_medical' => 'Leucémie - traitement chimiothérapie',
                'date_urgence' => null,
                'urgence' => false,
                'statut' => true,
            ],
            [
                'nom' => 'Zahiri',
                'prenom' => 'Karim',
                'email' => 'karim.zahiri@email.com',
                'telephone' => '+212 656-789012',
                'ville' => 'Tanger',
                'groupe_sanguin' => 'A-',
                'besoin_medical' => 'Opération orthopédique',
                'date_urgence' => '2024-02-10',
                'urgence' => false,
                'statut' => true,
            ],
            [
                'nom' => 'Bennis',
                'prenom' => 'Leila',
                'email' => 'leila.bennis@email.com',
                'telephone' => '+212 667-890123',
                'ville' => 'Meknès',
                'groupe_sanguin' => 'O+',
                'besoin_medical' => 'Dialyse rénale régulière',
                'date_urgence' => null,
                'urgence' => false,
                'statut' => true,
            ],
            [
                'nom' => 'Toumi',
                'prenom' => 'Hassan',
                'email' => 'hassan.toumi@email.com',
                'telephone' => '+212 678-901234',
                'ville' => 'Agadir',
                'groupe_sanguin' => 'B-',
                'besoin_medical' => 'Brûlures étendues',
                'date_urgence' => '2024-01-18',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'Rhouma',
                'prenom' => 'Nadia',
                'email' => 'nadia.rhouma@email.com',
                'telephone' => '+212 689-012345',
                'ville' => 'Oujda',
                'groupe_sanguin' => 'AB-',
                'besoin_medical' => 'Transplantation hépatique',
                'date_urgence' => '2024-02-05',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'Sefrioui',
                'prenom' => 'Omar',
                'email' => 'omar.sefrioui@email.com',
                'telephone' => '+212 690-123456',
                'ville' => 'Tétouan',
                'groupe_sanguin' => 'A+',
                'besoin_medical' => 'Chirurgie digestive',
                'date_urgence' => null,
                'urgence' => false,
                'statut' => false,
            ],
            [
                'nom' => 'Mansouri',
                'prenom' => 'Sofia',
                'email' => 'sofia.mansouri@email.com',
                'telephone' => '+212 601-234567',
                'ville' => 'Salé',
                'groupe_sanguin' => 'O+',
                'besoin_medical' => 'Anémie sévère',
                'date_urgence' => '2024-01-30',
                'urgence' => false,
                'statut' => false,
            ],
            [
                'nom' => 'Khalil',
                'prenom' => 'Rachid',
                'email' => 'rachid.khalil@email.com',
                'telephone' => '+212 602-345678',
                'ville' => 'Kénitra',
                'groupe_sanguin' => 'B+',
                'besoin_medical' => 'Traumatisme crânien',
                'date_urgence' => '2024-01-22',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'Idrissi',
                'prenom' => 'Samira',
                'email' => 'samira.idrissi@email.com',
                'telephone' => '+212 603-456789',
                'ville' => 'Safi',
                'groupe_sanguin' => 'A-',
                'besoin_medical' => 'Cancer du sein - mastectomie',
                'date_urgence' => null,
                'urgence' => false,
                'statut' => true,
            ],
            [
                'nom' => 'Berrada',
                'prenom' => 'Anas',
                'email' => 'anas.berrada@email.com',
                'telephone' => '+212 604-567890',
                'ville' => 'El Jadida',
                'groupe_sanguin' => 'O-',
                'besoin_medical' => 'Urgence pédiatrique',
                'date_urgence' => '2024-01-28',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'Lahlou',
                'prenom' => 'Imane',
                'email' => 'imane.lahlou@email.com',
                'telephone' => '+212 605-678901',
                'ville' => 'Nador',
                'groupe_sanguin' => 'AB+',
                'besoin_medical' => 'Complications post-opératoires',
                'date_urgence' => '2024-02-08',
                'urgence' => true,
                'statut' => true,
            ],
            [
                'nom' => 'Cherkaoui',
                'prenom' => 'Adil',
                'email' => 'adil.cherkaoui@email.com',
                'telephone' => '+212 606-789012',
                'ville' => 'Khouribga',
                'groupe_sanguin' => 'B-',
                'besoin_medical' => 'Maladie hématologique',
                'date_urgence' => null,
                'urgence' => false,
                'statut' => false,
            ]
        ];

        foreach ($receveurs as $receveur) {
            Receveur::create($receveur);
        }

        $this->command->info(count($receveurs) . ' receveurs ont été créés avec succès!');
    }
}