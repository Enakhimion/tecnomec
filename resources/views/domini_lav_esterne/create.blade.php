{{-- Add materiale from articoli craete --}}

<div class="form-group row mb-3 mt-3">

    <div class="col-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDominioLavEsterna">
            Aggiungi nuova descrizione lavorazione esterna
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDominioLavEsterna" tabindex="-1" aria-labelledby="modalDominioLavEsterna" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aggiungi nuova descrizione lavorazione esterna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {!! Form::open(['url' => route('domini_lav_esterne.store')]) !!}

                    @include('domini_lav_esterne.modules.form')

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                    {!! Form::submit('Salva descrizione', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
