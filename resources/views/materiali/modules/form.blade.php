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
        echo Form::label('peso', 'Peso KG al Mt', ['class' => 'col-sm col-form-label col-form-label-sm']);
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
        echo Form::label('extra', 'Extra', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
        echo Form::number('extra', 0,['placeholder' => '0','step' => '0.001','autocomplete' => 'off','class' => 'form-control form-control-sm']);
    @endphp
</div>
