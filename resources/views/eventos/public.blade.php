<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Eventos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-5">
                @if ($eventos->isEmpty())
                    <p class="text-gray-600">Nenhum evento cadastrado.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($eventos as $evento)
                            <div class="bg-gray-100 p-4 rounded-lg hover:shadow-md transition flex justify-between">
                                <div class="max-w-md">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $evento->nome }}
                                    </h3>
                                    <p class="text-xs text-gray-600 mb-2">
                                        {{ $evento->descricao }}
                                    </p>

                                    <div class="text-sm text-gray-600">
                                        <p class="mt-3 mb-1"><strong>Início:</strong> {{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y H:i') }}</p>
                                        <p class="mb-1"><strong>Fim:</strong> {{ \Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y H:i') }}</p>
                                        <p class="mt-3"><strong>Local:</strong> {{ $evento->local }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col items-end justify-between">
                                    <div class="bg-green-100 text-green-800 font-semibold px-3 py-1 rounded-full shadow-sm">
                                        Inscrição até {{ \Carbon\Carbon::parse($evento->data_inscricao)->format('d/m/Y H:i') }}
                                    </div>
                                    @auth
                                        @if (Auth::user()->isAluno())
                                            <a class="bg-gray-600 text-white text-sm px-4 py-2 rounded-md shadow hover:bg-gray-600 transition"
                                            href="{{ route('trabalhos.create', $evento->id) }}">
                                                Inscrever Trabalho
                                            </a>
                                        @endif

                                        @if (Auth::user()->isProfessor())
                                            <a class="bg-gray-600 text-white text-sm px-4 py-2 rounded-md shadow hover:bg-gray-600 transition" 
                                            href="{{ route('eventos.show', $evento->id) }}">
                                                Detalhes
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
