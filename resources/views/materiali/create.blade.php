{{-- Add materiale from articoli craete --}}

<div class="form-group row mb-3 mt-3">

    <div class="col-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMateriali">
            Aggiungi un nuovo materiale
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalMateriali" tabindex="-1" aria-labelledby="modalMateriali" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserisci un nuovo materiale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {!! Form::open(['url' => route('materiali.store')]) !!}

                    <div class="form-group row mb-3 mt-3">
                        {{-- Nome --}}
                        <div class="col-sm">
                            @php
                                echo Form::label('nome', 'Nome', ['class' => 'col-sm col-form-label col-form-label-sm']);
                                echo Form::text('nome', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                            @endphp
                        </div>
                        {{-- Peso --}}
                        <div class="col-sm">
                            @php
                                echo Form::label('peso', 'Peso', ['class' => 'col-sm col-form-label col-form-label-sm']);
                                echo Form::text('peso', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                            @endphp
                        </div>
                        {{-- Base --}}
                        <div class="col-sm">
                            @php
                                echo Form::label('base', 'Base', ['class' => 'col-sm col-form-label col-form-label-sm']);
                                echo Form::number('base', null,['step' => '0.001','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                            @endphp
                        </div>
                        {{-- Extra --}}
                        <div class="col-sm">
                            @php
                                echo Form::label('extra', 'Extra (se non presente inserire 0)', ['class' => 'col-sm col-form-label col-form-label-sm']);
                                echo Form::number('extra', null,['step' => '0.001','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                            @endphp
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                    {!! Form::submit('Salva materiale', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
