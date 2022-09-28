{!! Form::model($articolo->preventivi[0], ['method' => 'PUT','route' => ['preventivi.update', $articolo, $articolo->preventivi[0]]]) !!}

<table class="table">
    <thead>
    <tr>
        <th scope="col">Qunatita</th>
        <th scope="col">Materiale</th>
        <th scope="col">Lavorazioni Interne</th>
        <th scope="col">Lavorazioni Esterne</th>
        <th scope="col">Altri costi</th>
        <th scope="col">Costo pezzo (con {{ $articolo->perc_aggiunta_prezzo }}% di ricarico)</th>
        <th scope="col">Prezzo vendita</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ Form::number('qta1',null,['class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('materiale1',$costo_materiale,['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne1',$costo[0]['lav_interne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne1',$costo[0]['lav_esterne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro1',$costo[0]['altri_costi'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo1',$costo[0]['costo'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo1',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
    </tr>
    <tr>
        <td>{{ Form::number('qta2',null,['class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('materiale2',$costo_materiale,['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne2',$costo[1]['lav_interne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne2',$costo[1]['lav_esterne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro2',$costo[1]['altri_costi'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo2',$costo[1]['costo'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo2',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
    </tr>
    <tr>
        <td>{{ Form::number('qta3',null,['class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('materiale3',$costo_materiale,['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne3',$costo[2]['lav_interne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne3',$costo[2]['lav_esterne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro3',$costo[2]['altri_costi'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo3',$costo[2]['costo'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo3',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
    </tr>
    <tr>
        <td>{{ Form::number('qta4',null,['class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('materiale4',$costo_materiale,['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne4',$costo[3]['lav_interne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne4',$costo[3]['lav_esterne'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro4',$costo[3]['altri_costi'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo4',$costo[3]['costo'],['disabled','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo4',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('lunghezza_spezzone') ? ' is-invalid' : null)]) }}</td>
    </tr>
    </tbody>
</table>

{!! Form::submit('Aggiorna preventivo', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
