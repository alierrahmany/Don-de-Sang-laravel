<!-- resources/views/donneurs/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestion des Donneurs</h1>
                <p class="text-gray-600 mt-1">Liste des donneurs de sang enregistrés</p>
            </div>
            <a href="{{ route('donneurs.create') }}" 
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouveau Donneur
            </a>
        </div>

        <!-- Filtres COMPLETS -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('donneurs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Recherche nom, prénom, email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                    <input type="text" name="recherche" value="{{ request('recherche') }}" 
                           placeholder="Nom, prénom ou email..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                </div>
                
                <!-- Groupe sanguin -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Groupe Sanguin</label>
                    <select name="groupe_sanguin" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                        <option value="">Tous les groupes</option>
                        @foreach($groupesSanguins as $groupe)
                            <option value="{{ $groupe }}" {{ request('groupe_sanguin') == $groupe ? 'selected' : '' }}>
                                {{ $groupe }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Ville -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                    <input type="text" name="ville" value="{{ request('ville') }}" 
                           placeholder="Filtrer par ville..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                </div>
                
                <!-- Disponibilité -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Disponibilité</label>
                    <select name="disponible" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                        <option value="">Tous les donneurs</option>
                        <option value="1" {{ request('disponible') == '1' ? 'selected' : '' }}>Disponibles uniquement</option>
                        <option value="0" {{ request('disponible') == '0' ? 'selected' : '' }}>Indisponibles uniquement</option>
                    </select>
                </div>
                
                <!-- Boutons -->
                <div class="flex space-x-2 items-end">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center h-[42px]">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Filtrer
                    </button>
                    <a href="{{ route('donneurs.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition flex items-center h-[42px]">
                       <i class="fas fa-refresh mr-1"></i>  Réinitialiser
                    </a>
                </div>
            </form>
            
            <!-- Affichage des filtres actifs -->
            @if(request()->anyFilled(['recherche', 'groupe_sanguin', 'ville', 'disponible']))
            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                <p class="text-sm text-blue-800 font-medium">Filtres actifs :</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    @if(request()->filled('recherche'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                            Recherche: "{{ request('recherche') }}"
                        </span>
                    @endif
                    @if(request()->filled('groupe_sanguin'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                            Groupe sanguin: {{ request('groupe_sanguin') }}
                        </span>
                    @endif
                    @if(request()->filled('ville'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                            Ville: "{{ request('ville') }}"
                        </span>
                    @endif
                    @if(request()->filled('disponible'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                            Disponibilité: {{ request('disponible') == '1' ? 'Disponibles uniquement' : 'Indisponibles uniquement' }}
                        </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
        @endif

        <!-- Tableau des donneurs -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donneur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Groupe Sanguin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ville</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($donneurs as $donneur)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="text-red-600 font-semibold">
                                            {{ substr($donneur->prenom, 0, 1) }}{{ substr($donneur->nom, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $donneur->prenom }} {{ $donneur->nom }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $donneur->age }} ans • {{ $donneur->genre }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $donneur->email }}</div>
                                <div class="text-sm text-gray-500">{{ $donneur->telephone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">
                                    {{ $donneur->groupe_sanguin }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $donneur->ville }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $donneur->disponible ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $donneur->disponible ? 'Disponible' : 'Indisponible' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('donneurs.edit', $donneur) }}" class="text-green-600 hover:text-green-900" title="Modifier">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('donneurs.toggle-disponibilite', $donneur) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-orange-600 hover:text-orange-900" title="{{ $donneur->disponible ? 'Marquer indisponible' : 'Marquer disponible' }}">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('donneurs.destroy', $donneur) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce donneur?')" title="Supprimer">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                Aucun donneur trouvé.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $donneurs->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection