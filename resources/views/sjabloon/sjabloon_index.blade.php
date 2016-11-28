<h1>Sjablonen</h1>

<ul>
    @foreach ($sjablonen as $sjabloon)
    <li><a href="{{ URL::to('sjabloon/' . $sjabloon->id . '/edit') }}">{{  $sjabloon->naam }}</a></li>
        @endforeach 
</ul>

<a href="{{ URL::to('sjabloon/create') }}">Nieuw sjabloon</a>