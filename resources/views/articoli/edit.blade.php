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

                @include('clienti.create')

                @include('materiali.create')

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
                            <th scope="col">QTA 1</th>
                            <th scope="col">QTA 2</th>
                            <th scope="col">QTA 3</th>
                            <th scope="col">QTA 4</th>
                            <th scope="col">Elimina</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($elenco_interne as $interna)

                            <tr>
                                <td>{{ $interna['descrizione'] }}</td>
                                <td>{{ $interna['tipo'] }}</td>
                                <td>{{ $interna['qta1'] }}</td>
                                <td>{{ $interna['qta2'] }}</td>
                                <td>{{ $interna['qta3'] }}</td>
                                <td>{{ $interna['qta4'] }}</td>
                                <form id="destroy-form" action="{{ $interna['delete'] }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    <td>{!! Form::submit('Elimina', ['class' => 'btn btn-danger']) !!}</td>
                                    @csrf
                                </form>
                            </tr>

                        @endforeach

                        @foreach($elenco_esterne as $esterna)

                            <tr>
                                <td>{{ $esterna['descrizione'] }}</td>
                                <td>{{ $esterna['tipo'] }}</td>
                                <td>{{ $esterna['qta1'] }}</td>
                                <td>{{ $esterna['qta2'] }}</td>
                                <td>{{ $esterna['qta3'] }}</td>
                                <td>{{ $esterna['qta4'] }}</td>
                                <form id="destroy-form" action="{{ $esterna['delete'] }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    <td>{!! Form::submit('Elimina', ['class' => 'btn btn-danger']) !!}</td>
                                    @csrf
                                </form>
                            </tr>

                        @endforeach

                        @foreach($elenco_altri_costi as $altri_costi)

                            <tr>
                                <td>{{ $altri_costi['descrizione'] }}</td>
                                <td>{{ $altri_costi['tipo'] }}</td>
                                <td>{{ $altri_costi['qta1'] }}</td>
                                <td>{{ $altri_costi['qta2'] }}</td>
                                <td>{{ $altri_costi['qta3'] }}</td>
                                <td>{{ $altri_costi['qta4'] }}</td>
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

</x-app-layout>
