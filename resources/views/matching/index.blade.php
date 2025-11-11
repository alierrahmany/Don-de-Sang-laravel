<!-- resources/views/matching/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Match Donneurs / Receveurs</h1>
                <p class="text-gray-600 mt-1">Correspondance entre les receveurs et les donneurs compatibles</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('matching.pdf', request()->query()) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Exporter PDF
                </a>
            </div>
        </div>

        <!-- Filtres -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('matching.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
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
                    <select name="ville" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                        <option value="">Toutes les villes</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville }}" {{ request('ville') == $ville ? 'selected' : '' }}>
                                {{ $ville }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Urgence -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urgence</label>
                    <select name="urgence" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                        <option value="">Tous</option>
                        <option value="1" {{ request('urgence') == '1' ? 'selected' : '' }}>Urgents uniquement</option>
                        <option value="0" {{ request('urgence') == '0' ? 'selected' : '' }}>Non urgents</option>
                    </select>
                </div>
                
                <!-- Boutons -->
                <div class="flex space-x-2 items-end">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center h-[42px]">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Appliquer
                    </button>
                    <a href="{{ route('matching.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition flex items-center h-[42px]">
                        <i class="fas fa-refresh mr-1"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Statistiques -->
        @php
            $stats = app(App\Http\Controllers\MatchingController::class)->getStats();
        @endphp
        

        <!-- Tableau de matching -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Receveur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Groupe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urgence</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poches restantes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donneurs Compatibles</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($receveurs as $receveur)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="text-red-600 font-semibold">
                                            {{ substr($receveur->prenom, 0, 1) }}{{ substr($receveur->nom, 0, 1) }}
                                        </span>
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
                                <span class="px-3 py-1 text-sm font-bold rounded-full bg-red-100 text-red-800">
                                    {{ $receveur->groupe_sanguin }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($receveur->urgence)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 flex items-center w-fit">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        URGENT
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        {{ $receveur->date_urgence ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800' }} flex items-center w-fit">
                                        <i class="fas fa-{{ $receveur->date_urgence ? 'clock' : 'check' }} mr-1"></i>
                                        {{ $receveur->date_urgence ? 'NORMAL' : 'STABLE' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 flex items-center w-fit">
                                    <i class="fas fa-clock mr-1"></i>
                                    EN ATTENTE
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-lg font-bold {{ $receveur->poches_restantes > 0 ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $receveur->poches_restantes }}
                                    </span>
                                    @if($receveur->poches_restantes > 0)
                                        <i class="fas fa-exclamation-circle text-red-500 ml-2"></i>
                                    @else
                                        <i class="fas fa-check-circle text-green-500 ml-2"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    @forelse($receveur->donneurs_compatibles as $donneur)
                                    <div class="flex items-center justify-between bg-green-50 px-3 py-2 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-green-600 text-xs font-bold">
                                                    {{ substr($donneur->prenom, 0, 1) }}{{ substr($donneur->nom, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $donneur->prenom }} {{ $donneur->nom }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $donneur->groupe_sanguin }} • {{ $donneur->ville }}
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-green-200 text-green-800 px-2 py-1 rounded-full">
                                            Compatible
                                        </span>
                                    </div>
                                    @empty
                                    <div class="text-center py-3 text-gray-500">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Aucun donneur compatible trouvé
                                    </div>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex flex-col space-y-2">
                                    @if($receveur->donneurs_compatibles->count() > 0)
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-xs flex items-center justify-center">
                                            <i class="fas fa-check mr-1"></i>
                                            ✔ Match
                                        </button>
                                    @endif
                                    <a href="{{ route('receveurs.edit', $receveur) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-xs flex items-center justify-center">
                                        <i class="fas fa-edit mr-1"></i>
                                        Détails
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                @if(request()->anyFilled(['groupe_sanguin', 'ville', 'urgence']))
                                    Aucun receveur ne correspond à vos critères de recherche.
                                @else
                                    Aucun receveur en attente trouvé.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $receveurs->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection