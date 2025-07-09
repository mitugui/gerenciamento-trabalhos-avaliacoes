<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Evento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-5 space-y-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $evento->nome }}</h3>
                    <p class="text-gray-600 mb-4">{{ $evento->descricao }}</p>

                    <div class="grid sm:grid-cols-2 gap-4 text-sm text-gray-700">
                        <p><strong>Início:</strong> {{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y H:i') }}</p>
                        <p><strong>Fim:</strong> {{ \Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y H:i') }}</p>
                        <p><strong>Local:</strong> {{ $evento->local }}</p>
                        <p><strong>Inscrição até:</strong> {{ \Carbon\Carbon::parse($evento->data_inscricao)->format('d/m/Y H:i') }}</p>
                        <p><strong>Criado em:</strong> {{ $evento->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Trabalhos Submetidos</h4>

                    @forelse ($evento->trabalhos as $trabalho)
                        <div class="bg-gray-100 rounded-md p-4 mb-4 shadow-sm">
                            <h5 class="text-lg font-semibold text-gray-700">{{ $trabalho->titulo }}</h5>
                            <p class="text-sm text-gray-600 mb-1">{{ $trabalho->descricao }}</p>
                            <p class="text-sm text-gray-500 mb-1"><strong>Resumo:</strong> {{ $trabalho->resumo }}</p>
                            <p class="text-sm text-gray-500 mb-1"><strong>Status:</strong> {{ $trabalho->status }}</p>
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
                    @empty
                        <p class="text-gray-500 italic">Nenhum trabalho submetido ainda.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <div class="fixed bottom-20 right-24 flex space-x-3 z-50">
    <a href="{{ route('eventos.public') }}"
       class="inline-flex items-center justify-center h-12 px-10 bg-gray-600 text-white text-sm font-medium rounded-md shadow hover:bg-gray-700 transition">
        Voltar
    </a>

    <a href="{{ route('eventos.pdf', $evento->id) }}"
       class="inline-flex items-center justify-center h-12 px-10 bg-green-600 text-white text-sm font-medium rounded-md shadow hover:bg-green-700 transition">
        Gerar Relatório
    </a>
</div>
</x-app-layout>
