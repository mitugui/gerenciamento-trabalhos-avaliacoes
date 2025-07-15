@component('mail::message')
# Seu trabalho foi avaliado!

Olá,

O trabalho **"{{ $trabalho->titulo }}"** foi avaliado com os seguintes dados:

- **Nota:** {{ $avaliacao->nota }}
- **Status:** {{ $trabalho->status }}

@if ($avaliacao->descricao)
### Comentário:
{{ $avaliacao->descricao }}
@endif

@component('mail::button', ['url' => route('trabalhos.show', $trabalho->id)])
Ver trabalho
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
