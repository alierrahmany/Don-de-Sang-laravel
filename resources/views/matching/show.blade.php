@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Détails de l'Assignation</h1>
        <div class="flex space-x-3">
            <a href="{{ route('matching.historique') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Retour à l'historique</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informations Receveur -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-injured text-red-600 mr-2"></i>
                Informations du Receveur
            </h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nom complet:</span>
                    <span class="font-semibold">{{ $assignation->receveur->nom_complet }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Groupe sanguin:</span>
                    <span class="font-semibold px-2 py-1 bg-red-100 text-red-800 rounded">{{ $assignation->receveur->groupe_sanguin }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Ville:</span>
                    <span class="font-semibold">{{ $assignation->receveur->ville }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Téléphone:</span>
                    <span class="font-semibold">{{ $assignation->receveur->telephone }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-semibold">{{ $assignation->receveur->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Besoin médical:</span>
                    <span class="font-semibold">{{ $assignation->receveur->besoin_medical }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Urgence:</span>
                    <span class="font-semibold {{ $assignation->receveur->urgence ? 'text-red-600' : 'text-green-600' }}">
                        {{ $assignation->receveur->urgence ? 'OUI' : 'NON' }}
                    </span>
                </div>
                @if($assignation->receveur->date_urgence)
                <div class="flex justify-between">
                    <span class="text-gray-600">Date urgence:</span>
                    <span class="font-semibold">{{ $assignation->receveur->date_urgence->format('d/m/Y') }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Informations Donneur -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user text-blue-600 mr-2"></i>
                Informations du Donneur
            </h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nom complet:</span>
                    <span class="font-semibold">{{ $assignation->donneur->nom_complet }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Groupe sanguin:</span>
                    <span class="font-semibold px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ $assignation->donneur->groupe_sanguin }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Ville:</span>
                    <span class="font-semibold">{{ $assignation->donneur->ville }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Téléphone:</span>
                    <span class="font-semibold">{{ $assignation->donneur->telephone }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-semibold">{{ $assignation->donneur->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Genre:</span>
                    <span class="font-semibold">{{ $assignation->donneur->genre }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Disponible:</span>
                    <span class="font-semibold {{ $assignation->donneur->disponible ? 'text-green-600' : 'text-red-600' }}">
                        {{ $assignation->donneur->disponible ? 'OUI' : 'NON' }}
                    </span>
                </div>
                @if($assignation->donneur->dernier_don)
                <div class="flex justify-between">
                    <span class="text-gray-600">Dernier don:</span>
                    <span class="font-semibold">{{ $assignation->donneur->dernier_don->format('d/m/Y') }}</span>
                </div>
                @endif
            </div>
        </div>

        

        </div>
    </div>
</div>
@endsection