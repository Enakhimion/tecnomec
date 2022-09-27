
<div class="col-3">
    <!-- Button trigger modal -->
    <a type="button"  data-bs-toggle="modal" data-bs-target="#modalLavEsterna">
        Lavorazione esterna
    </a>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLavEsterna" tabindex="-1" aria-labelledby="modalLavEsterna" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuova lavorazione esterna per l'articolo {{ $articolo->codice_completo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => route('lav_esterne.store', $articolo)]) !!}

                <div class="form-group row mb-3 mt-3">
                    {{-- Descrizione --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('descrizione', 'Descrizione', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::text('descrizione', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                    {{-- Tipologia --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('id_tipologia', 'Tipologia', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::select('id_tipologia', $tipologie,null,['placeholder' => 'seleziona','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                    {{-- Importo --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('importo', 'Importo', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::number('importo', null,['step' => '0.01','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                {!! Form::submit('Salva lavorazione', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
