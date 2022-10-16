{{-- Add cliente from articoli craete --}}

<div class="form-group row mb-3 mt-3">

    <div class="col-3">
        <!-- Button trigger modal -->
        <a class="btn btn-success" type="button"  data-bs-toggle="modal" data-bs-target="#modalClienti">
            Aggiungi un nuovo cliente
        </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalClienti" tabindex="-1" aria-labelledby="modalClienti" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserisci un nuovo cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {!! Form::open(['url' => route('clienti.store')]) !!}

                    @include('clienti.modules.form')

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                    {!! Form::submit('Salva cliente', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
