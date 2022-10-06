
<div class="col-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAltriCosti">
        Altri costi
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAltriCosti" tabindex="-1" aria-labelledby="modalAltriCosti" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Altri costi per l'articolo {{ $articolo->codice_completo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => route('altri_costi.store', $articolo)]) !!}


                @include('altri_costi.modules.form')


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                {!! Form::submit('Salva costo', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
