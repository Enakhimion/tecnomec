{{-- Campi vuoti --}}

<div class="form-group row mb-3 mt-3">
    {{-- Cliente --}}
    <div class="col-sm">
        @php
            echo Form::label('id_cliente', 'Cliente', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::select('id_cliente', $clienti, null,['placeholder' => 'Seleziona','autocomplete' => 'off','class' => 'form-control form-control-sm '. ($errors->has('id_cliente') ? ' is-invalid' : null)]);
        @endphp

        @error('id_cliente')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Materiale --}}
    <div class="col-sm">
        @php
            echo Form::label('id_materiale', 'Materiale', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::select('id_materiale', $materiali, null,['placeholder' => 'Seleziona','autocomplete' => 'off','class' => 'form-control form-control-sm '. ($errors->has('id_materiale') ? ' is-invalid' : null)]);
        @endphp

        @error('id_materiale')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Tipo --}}
    <div class="col-sm">
        @php
            echo Form::label('descrizione', 'Categoria', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('descrizione',null,['autocomplete' => 'off','class' => 'form-control form-control-sm '. ($errors->has('descrizione') ? ' is-invalid' : null)]);
        @endphp

        @error('descrizione')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Codice --}}
    <div class="col-sm">
        @php
            echo Form::label('codice', 'Codice', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('codice',null,['autocomplete' => 'off','class' => 'form-control form-control-sm '. ($errors->has('codice') ? ' is-invalid' : null)]);
        @endphp

        @error('codice')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Peso --}}
    <div class="col-sm">
        @php
            echo Form::label('peso_articolo', 'Peso', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('peso_articolo',null,['class' => 'form-control form-control-sm '. ($errors->has('peso_articolo') ? ' is-invalid' : null)]);
        @endphp

        @error('peso_articolo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    {{-- Lunghezza articolo tornito --}}
    <div class="col-sm">
        @php
            echo Form::label('lunghezza_tornito', 'Lunghezza Tornito', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('lunghezza_tornito',null,['class' => 'form-control form-control-sm '. ($errors->has('lunghezza_tornito') ? ' is-invalid' : null)]);
        @endphp

        @error('lunghezza_tornito')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

{{-- Campi con default --}}

<div class="form-group row mb-3 mt-3">
    {{-- Spessore Taglio --}}
    <div class="col-sm">
        @php
            echo Form::label('spessore_taglio', 'Spessore taglio', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
            echo Form::number('spessore_taglio', null,['step' => '0.001','placeholder' => '3','autocomplete' => 'off','class' => 'form-control form-control-sm '. ($errors->has('spessore_taglio') ? ' is-invalid' : null)]);
        @endphp

        @error('spessore_taglio')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Sovrametallo --}}
    <div class="col-sm">
        @php
            echo Form::label('sovrametallo', 'Sovrametallo', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
            echo Form::number('sovrametallo', null,['step' => '0.001','placeholder' => '0,5','autocomplete' => 'off','class' => 'form-control form-control-sm '. ($errors->has('sovrametallo') ? ' is-invalid' : null)]);
        @endphp

        @error('sovrametallo')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Lunghezza Barra --}}
    <div class="col-sm">
        @php
            echo Form::label('lunghezza_barra', 'Lunghezza barra', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
            echo Form::number('lunghezza_barra',null,['placeholder' => '3000','class' => 'form-control form-control-sm '. ($errors->has('lunghezza_barra') ? ' is-invalid' : null)]);
        @endphp

        @error('lunghezza_barra')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Lunghezza spezzone --}}
    <div class="col-sm">
        @php
            echo Form::label('lunghezza_spezzone', 'Lunghezza spezzone', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
            echo Form::number('lunghezza_spezzone',null,['step' => '0.001','placeholder' => '150','class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]);
        @endphp

        @error('lunghezza_spezzone')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    {{-- Recupero --}}
    <div class="col-sm">
        @php
            echo Form::label('recupero', 'Recupero', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
            echo Form::text('recupero',null,['step' => '0.001','placeholder' => '0,1','class' => 'form-control form-control-sm '. ($errors->has('recupero') ? ' is-invalid' : null)]);
        @endphp

        @error('recupero')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    {{-- Is conto lavoro --}}
    <div class="col-sm">
        @php
            echo Form::label('is_contolavoro', 'Contolavoro', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
            echo Form::select('is_contolavoro',[0 => 'No', 1 => 'Si'],null,['class' => 'form-control form-control-sm '. ($errors->has('is_contolavoro') ? ' is-invalid' : null)]);
        @endphp

        @error('is_contolavoro')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

{{-- Campi calcolati --}}

<div class="form-group row mb-3 mt-3">
    {{-- Lunghezza tronchetto --}}
    <div class="col-sm">
        @php
            echo Form::label('lunghezza_tronchetto', 'Lunghezza tronchetto', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('lunghezza_tronchetto', null,['disabled','autocomplete' => 'off','class' => 'form-control form-control-sm']);
        @endphp
    </div>
    {{-- Numeri pezzi barra --}}
    <div class="col-sm">
        @php
            echo Form::label('num_pezzi_barra', 'Numeri pezzi barra', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('num_pezzi_barra', null,['disabled','autocomplete' => 'off','class' => 'form-control form-control-sm']);
        @endphp
    </div>
    {{-- Lunghezza scarto pezzo mozzicone --}}
    <div class="col-sm">
        @php
            echo Form::label('lunghezza_scarto_pezzo_mozzicone', 'Lunghezza scarto pezzo mozzicone', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('lunghezza_scarto_pezzo_mozzicone', null,['disabled','autocomplete' => 'off','class' => 'form-control form-control-sm']);
        @endphp
    </div>
    {{-- Lunghezza tronchetto totale --}}
    <div class="col-sm">
        @php
            echo Form::label('lunghezza_tronchetto_totale', 'Lunghezza tronchetto totale', ['class' => 'col-sm col-form-label col-form-label-sm']);
            echo Form::text('lunghezza_tronchetto_totale', null,['disabled','autocomplete' => 'off','class' => 'form-control form-control-sm']);
        @endphp
    </div>

    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
</div>

{{-- Campi calcolati --}}

<div class="form-group row mb-3 mt-3">
    {{-- Percentuale Ricarico--}}
    <div class="col-sm">
        @php
            echo Form::label('perc_aggiunta_prezzo', '% Ricarico', ['class' => 'default-text col-sm col-form-label col-form-label-sm']);
            echo Form::number('perc_aggiunta_prezzo',null,['placeholder' => '5','class' => 'form-control form-control-sm '. ($errors->has('perc_aggiunta_prezzo') ? ' is-invalid' : null)]);
        @endphp

        @error('perc_aggiunta_prezzo')<div class="invalid-feedback">{{ $message  }}</div>@enderror
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
</div>


