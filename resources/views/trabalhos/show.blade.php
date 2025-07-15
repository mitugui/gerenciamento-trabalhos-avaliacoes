<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Trabalho') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-5 space-y-6">
                <div>
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-800 leading-tight">{{ $trabalho->titulo }}</h3>
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                            @if($trabalho->status === 'pendente') bg-green-100 text-yellow-800
                            @elseif($trabalho->status === 'aprovado') bg-blue-100 text-blue-800
                            @elseif($trabalho->status === 'rejeitado') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $trabalho->status }}
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">{{ $trabalho->descricao }}</p>

                    <div class="grid sm:grid-cols-2 gap-4 text-sm text-gray-700">
                        <a href="{{ route('eventos.show', $trabalho->evento->id) }}" class="hover:underline">
                            <p class="text-gray-600"><strong>Evento: </strong>{{ $trabalho->evento->nome }}</p>
                        </a>
                        <p><strong>Resumo:</strong> {{ $trabalho->resumo }}</p>

                        <p><strong>Submetido em:</strong> {{ $trabalho->created_at->format('d/m/Y H:i') }}</p>
                        <p class="sm:col-span-2"><strong>Descrição: </strong> {{ $trabalho->descricao }} </p>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed bottom-20 right-24 flex space-x-3 z-50">
        <a href="{{ route('trabalhos.index') }}"
           class="inline-flex items-center justify-center h-12 px-10 bg-gray-600 text-white text-sm font-medium rounded-md shadow hover:bg-gray-700 transition">
            Voltar
        </a>
    </div>
</x-app-layout>