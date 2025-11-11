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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
                    Prêts à donner
                </span>
            </div>
        </div>

        <!-- Dons ce mois -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="fas fa-heart text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Dons ce mois</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $donsCeMois }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-blue-600 text-sm font-medium">
                    {{ now()->format('F Y') }}
                </span>
            </div>
        </div>

        <!-- Groupes sanguins -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <i class="fas fa-tint text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Groupes Sanguins</p>
                    <p class="text-2xl font-bold text-gray-900">8</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-purple-600 text-sm font-medium">
                    Tous types représentés
                </span>
            </div>
        </div>
    </div>

    <!-- Statistiques par groupe sanguin -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Répartition par Groupe Sanguin</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @php
                    $groupes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                @endphp
                
                @foreach($groupes as $groupe)
                @php
                    $count = $statsGroupes[$groupe]['count'] ?? 0;
                    $percentage = $statsGroupes[$groupe]['percentage'] ?? 0;
                @endphp
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-red-600 mb-1">{{ $count }}</div>
                    <div class="text-sm font-medium text-gray-900 mb-1">{{ $groupe }}</div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">{{ number_format($percentage, 1) }}%</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection