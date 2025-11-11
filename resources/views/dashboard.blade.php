<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tableau de Bord</h1>
        <p class="text-gray-600 mt-2">Bienvenue dans le système de gestion BloodBank</p>
    </div>

    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Donneurs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-lg">
                    <i class="fas fa-users text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Donneurs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalDonneurs }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('donneurs.index') }}" class="text-red-600 hover:text-red-700 text-sm font-medium flex items-center">
                    Voir tous les donneurs
                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Donneurs Disponibles -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Donneurs Disponibles</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $donneursDisponibles }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium flex items-center">
                    {{ number_format(($donneursDisponibles / max($totalDonneurs, 1)) * 100, 1) }}% de disponibilité
                </span>
            </div>
        </div>

       

        <!-- Total Receveurs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <i class="fas fa-hand-holding-heart text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Receveurs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalReceveurs }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('receveurs.index') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium flex items-center">
                    Voir tous les receveurs
                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Deuxième ligne de statistiques pour les receveurs -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Receveurs en attente -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">En attente</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $receveursEnAttente }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-yellow-600 text-sm font-medium">
                    {{ number_format(($receveursEnAttente / max($totalReceveurs, 1)) * 100, 1) }}% des receveurs
                </span>
            </div>
        </div>

        <!-- Receveurs urgents -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-orange-100 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Cas urgents</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $receveursUrgents }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-orange-600 text-sm font-medium">
                    Nécessitent une attention immédiate
                </span>
            </div>
        </div>

        <!-- Receveurs satisfaits -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fas fa-check-double text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Satisfaits</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $receveursSatisfaits }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    {{ number_format(($receveursSatisfaits / max($totalReceveurs, 1)) * 100, 1) }}% des demandes
                </span>
            </div>
        </div>
    </div>

 

    
</div>
@endsection