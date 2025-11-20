@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Historique des Assignations</h1>
        <div class="flex space-x-3">
            <a href="{{ route('matching.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Retour au matching</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Receveur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Donneur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Compatibilité
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date Assignation
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($assignations as $assignation)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-injured text-red-600 text-sm"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $assignation->receveur->nom_complet }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $assignation->receveur->ville }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $assignation->donneur->nom_complet }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $assignation->donneur->ville }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded">
                                    {{ $assignation->receveur->groupe_sanguin }}
                                </span>
                                <i class="fas fa-arrow-right text-gray-400"></i>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded">
                                    {{ $assignation->donneur->groupe_sanguin }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $assignation->date_assignation->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('matching.show', $assignation->id) }}" 
                               class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded text-xs flex items-center space-x-1">
                                <i class="fas fa-eye"></i>
                                <span>Voir</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-history text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg">Aucune assignation dans l'historique</p>
                            <a href="{{ route('matching.index') }}" class="inline-block mt-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                Retour au matching
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($assignations->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $assignations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection