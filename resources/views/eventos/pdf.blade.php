<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório do Evento</title>
    <style>
        body { font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif, sans-serif; font-size: 12px; color: #333; }
        h1 { font-size: 20px; margin-bottom: 10px; }
        h2 { font-size: 16px; margin-top: 20px; }
        .section { margin-bottom: 20px; }
        .trabalho { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>{{ $evento->nome }}</h1>
    <p><strong>Descrição:</strong> {{ $evento->descricao }}</p>
    <p><strong>Início:</strong> {{ $evento->data_inicio }}</p>
    <p><strong>Fim:</strong> {{ $evento->data_fim }}</p>
    <p><strong>Local:</strong> {{ $evento->local }}</p>
    <p><strong>Inscrições até:</strong> {{ $evento->data_inscricao }}</p>

    <h2>Trabalhos Submetidos</h2>

    @forelse ($evento->trabalhos as $trabalho)
        <div class="trabalho">
            <p><strong>Título:</strong> {{ $trabalho->titulo }}</p>
            <p><strong>Descrição:</strong> {{ $trabalho->descricao }}</p>
            <p><strong>Resumo:</strong> {{ $trabalho->resumo }}</p>
            <p><strong>Status:</strong> {{ $trabalho->status }}</p>
            <p><strong>Submetido em:</strong> {{ $trabalho->created_at }}</p>

            <p><strong>Alunos:</strong></p>
            <ul>
                @foreach ($trabalho->alunos as $aluno)
                    <li>{{ $aluno->user->name }} - {{ $aluno->matricula }} - {{ $aluno->user->email }}</li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>Nenhum trabalho submetido.</p>
    @endforelse
</body>
</html>
