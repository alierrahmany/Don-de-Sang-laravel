@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- En-tête avec messages -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Matching Donneurs - Receveurs</h1>
        <p class="text-gray-600">Système d'appariement intelligent basé sur la compatibilité sanguine</p>
        
        <div id="alert-message" class="mt-4 hidden"></div>
    </div>

    <!-- Navigation simplifiée -->
    <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0 mb-6">
        <a href="{{ route('matching.historique') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2 transition-colors">
            <i class="fas fa-history"></i>
            <span>Voir l'Historique</span>
        </a>
    </div>

    <!-- Liste des receveurs avec matching -->
    <div class="space-y-6">
        @forelse($matches as $match)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
            <!-- En-tête du receveur -->
            <div class="bg-gradient-to-r from-red-50 to-orange-50 px-6 py-4 border-b border-red-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center shadow-inner">
                                <i class="fas fa-user-injured text-red-600 text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $match['receveur']->nom_complet }}
                                @if($match['receveur']->urgence)
                                <span class="ml-2 px-3 py-1 bg-red-500 text-white text-xs font-bold rounded-full animate-pulse">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>URGENT
                                </span>
                                @endif
                            </h3>
                            <div class="flex flex-wrap items-center gap-4 mt-1 text-sm text-gray-600">
                                <span class="flex items-center bg-white px-2 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-tint text-red-500 mr-1"></i>
                                    Groupe: <strong class="ml-1">{{ $match['receveur']->groupe_sanguin }}</strong>
                                </span>
                                <span class="flex items-center bg-white px-2 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i>
                                    {{ $match['receveur']->ville }}
                                </span>
                                <span class="flex items-center bg-white px-2 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-stethoscope text-green-500 mr-1"></i>
                                    {{ $match['receveur']->besoin_medical }}
                                </span>
                                @if($match['receveur']->date_urgence)
                                <span class="flex items-center bg-white px-2 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-clock text-orange-500 mr-1"></i>
                                    {{ $match['receveur']->date_urgence->format('d/m/Y') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 md:mt-0">
                        <span class="px-4 py-2 rounded-full text-sm font-medium shadow-sm
                            {{ $match['nombre_compatibles'] > 0 ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                            <i class="fas fa-{{ $match['nombre_compatibles'] > 0 ? 'check' : 'times' }} mr-1"></i>
                            {{ $match['nombre_compatibles'] }} donneur(s) compatible(s)
                        </span>
                    </div>
                </div>
            </div>

            <!-- Donneurs compatibles -->
            <div class="p-6">
                @if($match['nombre_compatibles'] > 0)
                <h4 class="text-md font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-heart text-red-500 mr-2"></i>
                    Donneurs compatibles trouvés :
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($match['donneurs_compatibles'] as $donneur)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow bg-white donneur-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center shadow-inner">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 donneur-name">{{ $donneur->nom_complet }}</h4>
                                    <p class="text-sm text-gray-600">{{ $donneur->ville }}</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded border border-blue-200">
                                {{ $donneur->groupe_sanguin }}
                            </span>
                        </div>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-venus-mars text-purple-500 w-4 mr-2"></i>
                                <span>{{ $donneur->genre }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-green-500 w-4 mr-2"></i>
                                <span>{{ $donneur->telephone }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-blue-500 w-4 mr-2"></i>
                                <span class="truncate">{{ $donneur->email }}</span>
                            </div>
                            @if($donneur->dernier_don)
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-orange-500 w-4 mr-2"></i>
                                <span>Dernier don: {{ $donneur->dernier_don->format('d/m/Y') }}</span>
                            </div>
                            @else
                            <div class="flex items-center text-green-600">
                                <i class="fas fa-star w-4 mr-2"></i>
                                <span>Premier don</span>
                            </div>
                            @endif
                        </div>

                        <button type="button" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2 shadow-sm hover:shadow-md assign-btn"
                                data-receveur-id="{{ $match['receveur']->id }}"
                                data-donneur-id="{{ $donneur->id }}"
                                data-receveur-name="{{ $match['receveur']->nom_complet }}"
                                data-donneur-name="{{ $donneur->nom_complet }}">
                            <i class="fas fa-link"></i>
                            <span>Assigner ce donneur</span>
                        </button>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 bg-yellow-50 rounded-lg border border-yellow-200">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                    <p class="text-gray-700 text-lg font-medium">Aucun donneur compatible trouvé</p>
                    <p class="text-gray-500 text-sm mt-2">Vérifiez les donneurs disponibles ou les critères de compatibilité</p>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow p-12 text-center border border-gray-200">
            <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun receveur en attente</h3>
            <p class="text-gray-600">Tous les receveurs ont été satisfaits ou aucun n'est actuellement en attente.</p>
            <a href="{{ route('receveurs.create') }}" class="inline-block mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>Ajouter un receveur
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($receveurs->hasPages())
    <div class="mt-8 bg-white rounded-lg shadow border border-gray-200 px-6 py-4">
        {{ $receveurs->links() }}
    </div>
    @endif
</div>

<!-- Modal de confirmation -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                <i class="fas fa-question text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Confirmer l'assignation</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="modalMessage">
                    Êtes-vous sûr de vouloir assigner ce donneur ?
                </p>
            </div>
            <div class="flex items-center justify-center gap-4 px-4 py-3 mt-4">
                <button id="cancelButton" 
                        class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-400 focus:outline-none">
                    Annuler
                </button>
                <button id="confirmButton" 
                        class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 shadow-sm hover:bg-red-700 focus:outline-none">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentAssignationData = null;
    
    // Gérer le clic sur le bouton d'assignation
    document.querySelectorAll('.assign-btn').forEach(button => {
        button.addEventListener('click', function() {
            currentAssignationData = {
                receveur_id: this.dataset.receveurId,
                donneur_id: this.dataset.donneurId,
                receveur_name: this.dataset.receveurName,
                donneur_name: this.dataset.donneurName
            };
            
            // Mettre à jour le message du modal
            document.getElementById('modalMessage').innerHTML = 
                `Êtes-vous sûr de vouloir assigner <strong>${currentAssignationData.donneur_name}</strong> à <strong>${currentAssignationData.receveur_name}</strong> ?`;
            
            // Afficher le modal
            document.getElementById('confirmationModal').classList.remove('hidden');
        });
    });
    
    // Gérer la confirmation
    document.getElementById('confirmButton').addEventListener('click', function() {
        if (currentAssignationData) {
            assignerDonneur(currentAssignationData);
        }
    });
    
    // Gérer l'annulation
    document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.add('hidden');
        currentAssignationData = null;
    });
    
    // Fermer le modal en cliquant à l'extérieur
    document.getElementById('confirmationModal').addEventListener('click', function(e) {
        if (e.target.id === 'confirmationModal') {
            document.getElementById('confirmationModal').classList.add('hidden');
            currentAssignationData = null;
        }
    });
    
    function assignerDonneur(data) {
        // Afficher un indicateur de chargement
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');
        const originalText = confirmButton.innerHTML;
        
        confirmButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        confirmButton.disabled = true;
        cancelButton.disabled = true;
        
        // Préparer les données pour l'envoi
        const formData = new FormData();
        formData.append('receveur_id', data.receveur_id);
        formData.append('donneur_id', data.donneur_id);
        formData.append('_token', '{{ csrf_token() }}');
        
        fetch('{{ route("matching.assigner") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(result => {
            // Cacher le modal
            document.getElementById('confirmationModal').classList.add('hidden');
            
            // Afficher le message
            showAlert(result.success, result.message);
            
            if (result.success && result.redirect_url) {
                // Rediriger vers l'historique après 2 secondes
                setTimeout(() => {
                    window.location.href = result.redirect_url;
                }, 2000);
            } else if (result.success) {
                // Recharger la page après 2 secondes
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert(false, 'Une erreur réseau est survenue. Veuillez réessayer.');
        })
        .finally(() => {
            // Restaurer le bouton
            confirmButton.innerHTML = originalText;
            confirmButton.disabled = false;
            cancelButton.disabled = false;
            currentAssignationData = null;
        });
    }
    
    function showAlert(success, message) {
        const alertDiv = document.getElementById('alert-message');
        alertDiv.className = `mt-4 px-4 py-3 rounded relative ${success ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'}`;
        alertDiv.innerHTML = `
            <strong class="font-bold">${success ? 'Succès !' : 'Erreur !'}</strong>
            <span class="block sm:inline">${message}</span>
            <button onclick="this.parentElement.classList.add('hidden')" class="absolute top-0 right-0 px-3 py-2">
                <i class="fas fa-times"></i>
            </button>
        `;
        alertDiv.classList.remove('hidden');
        
        // Masquer l'alerte après 5 secondes
        setTimeout(() => {
            alertDiv.classList.add('hidden');
        }, 5000);
    }
});
</script>
@endsection