<!-- resources/views/donneurs/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Ajouter un Donneur</h1>
            <a href="{{ route('donneurs.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
                Retour à la liste
            </a>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('donneurs.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations personnelles -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Informations Personnelles</h3>
                            
                            <div>
                                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom *</label>
                                <input type="text" name="prenom" id="prenom" required
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                       value="{{ old('prenom') }}">
                                @error('prenom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700">Nom *</label>
                                <input type="text" name="nom" id="nom" required
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                       value="{{ old('nom') }}">
                                @error('nom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de Naissance *</label>
                                <input type="date" name="date_naissance" id="date_naissance" required
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                       value="{{ old('date_naissance') }}">
                                @error('date_naissance')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="genre" class="block text-sm font-medium text-gray-700">Genre *</label>
                                <select name="genre" id="genre" required
                                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="">Sélectionnez le genre</option>
                                    <option value="Homme" {{ old('genre') == 'Homme' ? 'selected' : '' }}>Homme</option>
                                    <option value="Femme" {{ old('genre') == 'Femme' ? 'selected' : '' }}>Femme</option>
                                </select>
                                @error('genre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Informations de contact et médicales -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Contact & Informations Médicales</h3>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                                <input type="email" name="email" id="email" required
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                       value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                                <input type="text" name="telephone" id="telephone" required
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                       value="{{ old('telephone') }}">
                                @error('telephone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="ville" class="block text-sm font-medium text-gray-700">Ville *</label>
                                <input type="text" name="ville" id="ville" required
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500"
                                       value="{{ old('ville') }}">
                                @error('ville')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="groupe_sanguin" class="block text-sm font-medium text-gray-700">Groupe Sanguin *</label>
                                <select name="groupe_sanguin" id="groupe_sanguin" required
                                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="">Sélectionnez le groupe</option>
                                    @foreach($groupesSanguins as $groupe)
                                        <option value="{{ $groupe }}" {{ old('groupe_sanguin') == $groupe ? 'selected' : '' }}>
                                            {{ $groupe }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('groupe_sanguin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section notes supprimée -->

                    <!-- Disponibilité -->
                    <div class="mt-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="disponible" id="disponible" value="1"
                                   class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded"
                                   {{ old('disponible', true) ? 'checked' : '' }}>
                            <label for="disponible" class="ml-2 block text-sm text-gray-900">
                                Donneur disponible pour des dons
                            </label>
                        </div>
                        @error('disponible')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('donneurs.index') }}" 
                           class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition">
                            Ajouter le Donneur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection