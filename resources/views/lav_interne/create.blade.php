
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


                    {{-- Descrizione --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('descrizione', 'Descrizione', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::text('descrizione', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                    {{-- Macchinario --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('id_macchinario', 'Macchinario', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::select('id_macchinario', $macchinari,null,['placeholder' => 'seleziona','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                    {{-- Costo utensileria --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('costo_utensileria', 'Costo utensileria', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::number('costo_utensileria', null,['step' => '0.01','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                    {{-- Minuti setup --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('minuti_setup', 'Minuti setup', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::number('minuti_setup', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                    {{-- Percentuale resa --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('perc_resa', 'Percentuale resa', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::number('perc_resa', null,['placeholder' => '85','autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>
                    {{-- Tempo pezzo --}}
                    <div class="col-sm">
                        @php
                            echo Form::label('tempo_pezzo', 'Tempo pezzo', ['class' => 'col-sm col-form-label col-form-label-sm']);
                            echo Form::number('tempo_pezzo', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
                        @endphp
                    </div>

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
