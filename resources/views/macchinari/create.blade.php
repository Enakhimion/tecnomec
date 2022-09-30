

<!-- Button trigger modal -->
<a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMacchinario">
    Nuovo macchinario
</a>


<!-- Modal -->
<div class="modal fade" id="modalMacchinario" tabindex="-1" aria-labelledby="modalMacchinario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuovo macchinario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => route('macchinari.store')]) !!}

                {{-- Descrizione --}}
                <div class="col-sm">
                    @php
                        echo Form::label('nome', 'Nome', ['class' => 'col-sm col-form-label col-form-label-sm']);
                        echo Form::text('nome', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                    @endphp
                </div>
                {{-- Descrizione --}}
                <div class="col-sm">
                    @php
                        echo Form::label('descrizione', 'Descrizione', ['class' => 'col-sm col-form-label col-form-label-sm']);
                        echo Form::text('descrizione', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                    @endphp
                </div>
                {{-- Costo orario macchina --}}
                <div class="col-sm">
                    @php
                        echo Form::label('costo_orario_macchina', 'Costo orario', ['class' => 'col-sm col-form-label col-form-label-sm']);
                        echo Form::number('costo_orario_macchina', null,['step' => '0.01','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                    @endphp
                </div>
                {{-- Minuti setup --}}
                <div class="col-sm">
                    @php
                        echo Form::label('costo_orario_setup', 'Costo orario setup', ['class' => 'col-sm col-form-label col-form-label-sm']);
                        echo Form::number('costo_orario_setup', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                    @endphp
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                {!! Form::submit('Salva macchinario', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
