{{-- Descrizione --}}
<div class="col-sm">
    @php
        echo Form::label('id_dominio_lav_interna', 'Descrizione', ['class' => 'col-sm col-form-label col-form-label-sm']);
        echo Form::select('id_dominio_lav_interna', $domini_lav_interne,null,['placeholder' => 'seleziona','autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
{{-- Macchinario --}}
<div class="col-sm">
    @php
        echo Form::label('id_macchinario', 'Macchinario', ['class' => 'danger-text col-sm col-form-label col-form-label-sm']);
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
{{-- Costo setup --}}
<div class="col-sm">
    @php
        echo Form::label('costo_setup', 'Costo setup', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
        echo Form::number('costo_setup', null,['step' => '0.01','placeholder' => 'Se non valorizzato prende il valore del macchinario','autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
{{-- Costo orario macchina --}}
<div class="col-sm">
    @php
        echo Form::label('costo_orario_macchina', 'Costo orario macchina', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
        echo Form::number('costo_orario_macchina', null,['step' => '0.01','placeholder' => 'Se non valorizzato prende il valore del macchinario','autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
{{-- Minuti setup --}}
<div class="col-sm">
    @php
        echo Form::label('minuti_setup', 'Minuti setup', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
        echo Form::number('minuti_setup', 120,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
{{-- Percentuale resa --}}
<div class="col-sm">
    @php
        echo Form::label('perc_resa', 'Percentuale resa', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
        echo Form::number('perc_resa', null,['step' => '0.01','placeholder' => '85','autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
{{-- Tempo pezzo --}}
<div class="col-sm">
    @php
        echo Form::label('tempo_pezzo', 'Tempo pezzo', ['class' => 'col-sm col-form-label col-form-label-sm']);
        echo Form::number('tempo_pezzo', null,['step' => '0.01','autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
