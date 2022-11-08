{{-- Descrizione --}}
<div class="col-sm">
    @php
        echo Form::label('descrizione', 'Descrizione', ['class' => 'col-sm col-form-label col-form-label-sm']);
        echo Form::text('descrizione', null,['autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
