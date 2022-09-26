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
    </div>

</x-app-layout>
