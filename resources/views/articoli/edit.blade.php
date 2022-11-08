<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Articolo {{ $articolo->codice_completo }}
        </h2>
    </x-slot>


    <div class="content-wrapper p-5">
        <div class="card">
            <div class="card-header">
                Articolo
            </div>
            <div class="card-body">
                {!! Form::model($articolo, ['method' => 'PUT','route' => ['articoli.update', $articolo]]) !!}

                @include('articoli.modules.form')

                {!! Form::submit('Aggiorna dati Articolo', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

                <form id="destroy-form" action="{{ route('articoli.destroy',[$articolo]) }}" method="POST" class="mt-5">
                    @method('DELETE')
                    {!! Form::submit('Elimina articolo', ['class' => 'btn btn-danger']) !!}
                    @csrf
                </form>

                @include('clienti.create')

                @include('materiali.create')

                @include('categorie.create')

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Preventivo
            </div>
            <div class="card-body">

                @include('preventivi.edit')

            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Costi
            </div>
            <div class="card-body">
                <div class="form-group row mb-3 mt-3">

                    @include('lav_esterne.create')

                    @include('lav_interne.create')

                    @include('altri_costi.create')

                    <table class="table mt-5">
                        <thead>
                        <tr>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Stato</th>
                            <th scope="col">Tempo pezzo</th>
                            <th scope="col">Tempo effettivo</th>
                            <th scope="col">Importo</th>
                            <th scope="col">QTA 1</th>
                            <th scope="col">QTA 2</th>
                            <th scope="col">QTA 3</th>
                            <th scope="col">QTA 4</th>
                            <th scope="col">Elimina</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($elenco_interne as $id => $interna)

                            <tr>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#lavInterna{{ $id }}">{{ $interna['descrizione'] }}</a></td>
                                <td>{{ $interna['tipo'] }}</td>
                                <td>
                                    <a href="{{ route('lav_interne_soft_delete',[$articolo,$id]) }}">
                                        @if($interna['stato'] === 'S')
                                            <i class="fa-solid fa-check" style="color: green"></i>
                                        @else
                                            <i class="fa-solid fa-circle-xmark" style="color: red"></i>
                                        @endif
                                    </a>
                                </td>
                                <td>{{ round($interna['tempo_pezzo'], 2) }}</td>
                                <td>{{ round($interna['tempo_effettivo'], 2) }}</td>
                                <td></td>
                                <td>{{ isset($interna['qta1']) ? round($interna['qta1'], 4) : "-" }}</td>
                                <td>{{ isset($interna['qta2']) ? round($interna['qta2'], 4) : "-" }}</td>
                                <td>{{ isset($interna['qta3']) ? round($interna['qta3'], 4) : "-" }}</td>
                                <td>{{ isset($interna['qta4']) ? round($interna['qta4'], 4) : "-" }}</td>
                                <form id="destroy-form" action="{{ $interna['delete'] }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    <td>{!! Form::submit('Elimina', ['class' => 'btn btn-danger']) !!}</td>
                                    @csrf
                                </form>
                            </tr>

                        @endforeach

                        @foreach($elenco_esterne as $id => $esterna)

                            <tr>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#lavEsterna{{ $id }}">{{ $esterna['descrizione'] }}</a></td>
                                <td>{{ $esterna['tipo'] }}</td>
                                <td>
                                    <a href="{{ route('lav_esterne_soft_delete',[$articolo,$id]) }}">
                                        @if($esterna['stato'] === 'S')
                                            <i class="fa-solid fa-check" style="color: green"></i>
                                        @else
                                            <i class="fa-solid fa-circle-xmark" style="color: red"></i>
                                        @endif
                                    </a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>{{ $esterna['importo']  ?? 0 }}</td>
                                <td>{{ isset($esterna['qta1']) ? number_format(round($esterna['qta1'], 5),5) : "-"  }}</td>
                                <td>{{ isset($esterna['qta2']) ? number_format(round($esterna['qta2'], 5),5) : "-"  }}</td>
                                <td>{{ isset($esterna['qta3']) ? number_format(round($esterna['qta3'], 5),5) : "-"  }}</td>
                                <td>{{ isset($esterna['qta4']) ? number_format(round($esterna['qta4'], 5),5) : "-"  }}</td>
                                <form id="destroy-form" action="{{ $esterna['delete'] }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    <td>{!! Form::submit('Elimina', ['class' => 'btn btn-danger']) !!}</td>
                                    @csrf
                                </form>
                            </tr>

                        @endforeach

                        @foreach($elenco_altri_costi as $id => $altri_costi)

                            <tr>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#lavAltroCosto{{ $id }}">{{ $altri_costi['descrizione'] }}</a></td>
                                <td>{{ $altri_costi['tipo'] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $altri_costi['importo'] ?? 0  }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <form id="destroy-form" action="{{ $altri_costi['delete'] }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    <td>{!! Form::submit('Elimina', ['class' => 'btn btn-danger']) !!}</td>
                                    @csrf
                                </form>

                            </tr>

                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @foreach($elenco_interne as $id => $interna)

        @php

        $lav_interna = \App\Models\LavInterna::find($id);

        @endphp

        @include('lav_interne.edit')


    @endforeach

    @foreach($elenco_interne as $id => $interna)

        @php

            $lav_interna = \App\Models\LavInterna::find($id);

        @endphp

        @include('lav_interne.edit')


    @endforeach

    @foreach($elenco_esterne as $id => $esterna)

        @php

            $lav_esterna = \App\Models\LavEsterna::find($id);

        @endphp

        @include('lav_esterne.edit')


    @endforeach

    @foreach($elenco_altri_costi as $id => $altri_costi)

        @php

            $altro_costo = \App\Models\AltroCosto::find($id);

        @endphp

        @include('altri_costi.edit')


    @endforeach



</x-app-layout>
