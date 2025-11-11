@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Ajouter un Receveur</h1>
            <p class="text-gray-600 mt-2">Enregistrez un nouveau receveur dans le système</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- En-tête de la carte -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-50 to-rose-50">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-user-plus text-red-600 mr-2"></i>
                    Informations du Receveur
                </h2>
            </div>

            <!-- Formulaire -->
            <form action="{{ route('receveurs.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Prénom -->
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="prenom" id="prenom" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                            value="{{ old('prenom') }}"
                            placeholder="Entrez le prénom">
                        @error('prenom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nom" id="nom" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                            value="{{ old('nom') }}"
                            placeholder="Entrez le nom">
                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                            value="{{ old('email') }}"
                            placeholder="exemple@email.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                            Téléphone <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="telephone" id="telephone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                            value="{{ old('telephone') }}"
                            placeholder="+212 6XX-XXXXXX">
                        @error('telephone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Ville -->
                    <div>
                        <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">
                            Ville <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="ville" id="ville" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                            value="{{ old('ville') }}"
                            placeholder="Entrez la ville">
                        @error('ville')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Groupe Sanguin -->
                    <div>
                        <label for="groupe_sanguin" class="block text-sm font-medium text-gray-700 mb-2">
                            Groupe Sanguin <span class="text-red-500">*</span>
                        </label>
                        <select name="groupe_sanguin" id="groupe_sanguin" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                            <option value="">Sélectionnez un groupe</option>
                            <option value="A+" {{ old('groupe_sanguin') == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('groupe_sanguin') == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('groupe_sanguin') == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('groupe_sanguin') == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ old('groupe_sanguin') == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('groupe_sanguin') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ old('groupe_sanguin') == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('groupe_sanguin') == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                        @error('groupe_sanguin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

               

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date d'urgence -->
                    <div>
                        <label for="date_urgence" class="block text-sm font-medium text-gray-700 mb-2">
                            Date d'urgence
                        </label>
                        <input type="date" name="date_urgence" id="date_urgence"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                            value="{{ old('date_urgence') }}">
                        @error('date_urgence')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Urgence -->
                    <div class="flex items-center space-x-3 pt-6">
                        <input type="checkbox" name="urgence" id="urgence" value="1"
                            {{ old('urgence') ? 'checked' : '' }}
                            class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="urgence" class="text-sm font-medium text-gray-700">
                            Cas urgent
                        </label>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('receveurs.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                        Annuler
                    </a>
                    <button type="submit"
                        class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter le Receveur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection