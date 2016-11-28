<h1>Sjabloon bewerken</h1>

@if (count($errors) > 0)
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

{{ Form::model($sjabloon, ['method'=>'put', 'route' => ['sjabloon.update', $sjabloon]]) }}
{{ Form::label('naam', 'Naam') }}
{{ Form::text('naam') }}
{{ Form::submit('Opslaan') }}
{{ Form::close() }}