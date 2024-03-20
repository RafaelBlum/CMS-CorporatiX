@if ($address)

    <ul>
        @foreach ($address->take(10) as $address)
            <p>Rua {{ $address->street. ", ". $address->number." - ". $address->bairro. " | " . $address->city . "/" . $address->state}}</p>
            <span>CEP: {{$address->cep}}</span>
        @endforeach
    </ul>
@else
    <p>Nenhuma compra realizada até o momento...</p>
@endif
