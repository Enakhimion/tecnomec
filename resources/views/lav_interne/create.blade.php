
<div class="col-3">
    <!-- Button trigger modal -->
    <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalLavInterna">
        Lavorazione interna
    </a>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLavInterna" tabindex="-1" aria-labelledby="modalLavInterna" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuova lavorazione interna per l'articolo {{ $articolo->codice_completo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => route('lav_interne.store', $articolo)]) !!}

                @include('lav_interne.modules.form')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                {!! Form::submit('Salva lavorazione', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

                @include('macchinari.create')

            </div>
        </div>
    </div>
</div>
