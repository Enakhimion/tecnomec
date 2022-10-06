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
