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
