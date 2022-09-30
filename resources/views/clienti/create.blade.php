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

                    <div class="form-group row mb-3 mt-3">
                        {{-- Nome --}}
                        <div class="col-sm">
                            @php
                                echo Form::label('nome', 'Nome', ['class' => 'col-sm col-form-label col-form-label-sm']);
                                echo Form::text('nome', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                            @endphp
                        </div>
                        {{-- Desinenza --}}
                        <div class="col-sm">
                            @php
                                echo Form::label('desinenza', 'Desinenza', ['class' => 'col-sm col-form-label col-form-label-sm']);
                                echo Form::text('desinenza', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                            @endphp
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                    {!! Form::submit('Salva Articolo', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
