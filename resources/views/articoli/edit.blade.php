<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuovo articolo
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

        <div class="card mt-4">
            <div class="card-header">
                Costi
            </div>
            <div class="card-body">
                <div class="form-group row mb-3 mt-3">

                    @include('lav_esterne.create')

                    @include('lav_interne.create')

                    @include('altri_costi.create')

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
