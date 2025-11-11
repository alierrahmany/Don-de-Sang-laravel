@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- En-tête avec bouton d'ajout -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestion des Receveurs</h1>
                <p class="text-gray-600 mt-2">Liste des receveurs enregistrés dans le système</p>
            </div>
            <a href="{{ route('receveurs.create') }}" 
               class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-sm transition duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Nouveau Receveur
            </a>
        </div>
        <!-- Tableau des receveurs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- En-tête du tableau -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-50 to-rose-50">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-red-600"></i>
                    Liste des Receveurs
                </h2>
            </div>

            @if($receveurs->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Receveur
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Groupe Sanguin
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($receveurs as $receveur)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-red-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $receveur->prenom }} {{ $receveur->nom }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $receveur->ville }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $receveur->email }}</div>
                                <div class="text-sm text-gray-500">{{ $receveur->telephone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $receveur->groupe_sanguin == 'O-' ? 'bg-red-100 text-red-800' : 
                                       ($receveur->groupe_sanguin == 'O+' ? 'bg-orange-100 text-orange-800' : 
                                       'bg-blue-100 text-blue-800') }}">
                                    {{ $receveur->groupe_sanguin }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col space-y-1">
                                    @if($receveur->urgence)
                                    <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full flex items-center w-fit">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Urgent
                                    </span>
                                    @endif
                                    <span class="px-2 py-1 text-xs {{ $receveur->statut ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }} rounded-full flex items-center w-fit">
                                        <i class="fas {{ $receveur->statut ? 'fa-clock' : 'fa-check' }} mr-1"></i>
                                        {{ $receveur->statut ? 'En attente' : 'Satisfait' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('receveurs.edit', $receveur) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition duration-150"
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    @if($receveur->statut)
                                    <form action="{{ route('receveurs.toggle-urgence', $receveur) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" 
                                                class="text-orange-600 hover:text-orange-900 transition duration-150"
                                                title="{{ $receveur->urgence ? 'Désactiver urgence' : 'Marquer urgent' }}">
                                            <i class="fas {{ $receveur->urgence ? 'fa-bell-slash' : 'fa-bell' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('receveurs.satisfait', $receveur) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-900 transition duration-150"
                                                title="Marquer comme satisfait">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('receveurs.destroy', $receveur) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition duration-150"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce receveur ?')"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-users text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun receveur trouvé</h3>
                <p class="text-gray-500 mb-6">Commencez par ajouter votre premier receveur.</p>
                <a href="{{ route('receveurs.create') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-sm transition duration-200 inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter un Receveur
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection