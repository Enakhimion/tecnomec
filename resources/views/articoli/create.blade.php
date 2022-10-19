<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuovo articolo
        </h2>
    </x-slot>

    @php

        if(isset($validation)){

            $messages = $validation->messages();

            foreach ($messages->all('<li>:message</li>') as $message)
            {
                echo $message;
            }
        }

    @endphp

    <div class="content-wrapper p-5">
        <div class="card">
            <div class="card-header">
                Articolo
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('articoli.store')]) !!}

                @include('articoli.modules.form')

                {!! Form::submit('Salva Articolo', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

                @include('clienti.create')

                @include('materiali.create')

                @include('categorie.create')

            </div>
        </div>
    </div>

</x-app-layout>
