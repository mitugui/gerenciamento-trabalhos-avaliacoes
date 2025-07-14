<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Trabalhos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    id="alert-pop-up"
                    class="rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 mb-5 text-sm shadow-sm"
                >
                    {{ session('success') }}
                </div>
            </div>
        @endif
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-5">
                @if ($trabalhos->isEmpty())
                    <p class="text-gray-600">Nenhum trabalho cadastrado.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($trabalhos as $trabalho)
                            <div class="bg-gray-100 p-4 rounded-lg hover:shadow-md transition flex justify-between">
                                <div class="max-w-md">
                                    <h5 class="text-lg font-semibold text-gray-700">{{ $trabalho->titulo }}</h5>
                                    <p class="text-sm text-gray-600 mb-1">{{ $trabalho->descricao }}</p>
                                    <a href="{{ route('eventos.public') }}" class="hover:underline">
                                        <p class="text-sm text-gray-600 mb-1"><strong>Evento:</strong> {{ $trabalho->evento->nome }} </p>
                                    </a>
                                    <p class="text-sm text-gray-500 mb-1"><strong>Resumo:</strong> {{ $trabalho->resumo }}</p>
                                    <p class="text-xs text-gray-400 mb-2">Submetido em: {{ $trabalho->created_at->format('d/m/Y H:i') }}</p>

                                    <div class="pl-4 border-l-2 border-gray-300 mt-2">
                                        <p class="text-sm font-medium text-gray-700 mb-1">Alunos:</p>
                                        @foreach ($trabalho->alunos as $aluno)
                                            <div class="text-sm text-gray-600 mb-1">
                                                • {{ $aluno->user->name }} ({{ $aluno->user->email }}) — Matrícula: {{ $aluno->matricula }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="flex flex-col items-end justify-between">
                                    @if ($trabalho->status === 'pendente')
                                        <div class="bg-green-100 text-yellow-800 font-semibold px-3 py-1 rounded-full shadow-sm">
                                            {{ $trabalho->status }}
                                        </div>
                                    @elseif ($trabalho->status === 'aprovado')
                                        <div class="bg-blue-100 text-blue-800 font-semibold px-3 py-1 rounded-full shadow-sm">
                                            {{ $trabalho->status }}
                                        </div>
                                    @elseif ($trabalho->status === 'rejeitado')
                                        <div class="bg-red-100 text-red-800 font-semibold px-3 py-1 rounded-full shadow-sm">
                                            {{ $trabalho->status }}
                                        </div>
                                    @endif

                                    <a class="bg-gray-600 text-white text-sm px-4 py-2 rounded-md shadow hover:bg-gray-600 transition" 
                                        href="{{ route('trabalhos.show', $trabalho->id) }}">
                                        Detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
