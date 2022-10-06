{{-- Descrizione --}}
<div class="col-sm">
    @php
        echo Form::label('descrizione', 'Descrizione', ['class' => 'col-sm col-form-label col-form-label-sm']);
        echo Form::text('descrizione', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
{{-- Importo --}}
<div class="col-sm">
    @php
        echo Form::label('importo', 'Importo', ['class' => 'col-sm col-form-label col-form-label-sm']);
        echo Form::number('importo', null,['step' => '0.01','autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
