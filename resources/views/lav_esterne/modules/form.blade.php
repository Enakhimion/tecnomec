{{-- Descrizione --}}
<div class="col-sm">
    @php
        echo Form::label('id_dominio_lav_esterna', 'Descrizione', ['class' => 'col-sm col-form-label col-form-label-sm']);
        echo Form::select('id_dominio_lav_esterna', $domini_lav_esterne,null,['placeholder' => 'seleziona','autocomplete' => 'off','class' => 'form-control form-control-sm']);
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
