{!! Form::model($articolo->preventivi[0], ['method' => 'PUT','route' => ['preventivi.update', $articolo, $articolo->preventivi[0]]]) !!}

<table class="table">
    <thead>
    <tr>
        <th scope="col">Qunatita</th>
        <th scope="col">N. Barre</th>
        <th scope="col">Kg Materiale</th>
        <th scope="col">Materiale</th>
        <th scope="col">Lavorazioni Interne</th>
        <th scope="col">Lavorazioni e trattamenti</th>
        <th scope="col">Altri costi</th>
        <th scope="col">Costo pezzo</th>
        <th scope="col">Prezzo vendita</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Ricarico</td>
        <td></td>
        <td></td>
        <td>{{ Form::number('ricarico_materiale',null,['step' => '0.01','class' => 'form-control form-control-sm '. ($errors->has('ricarico_materiale') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::number('ricarico_interne',null,['step' => '0.01','class' => 'form-control form-control-sm '. ($errors->has('ricarico_interne') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::number('ricarico_esterne',null,['step' => '0.01','class' => 'form-control form-control-sm '. ($errors->has('ricarico_esterne') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::number('ricarico_altro',null,['step' => '0.01','class' => 'form-control form-control-sm '. ($errors->has('ricarico_altro') ? ' is-invalid' : null)]) }}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>{{ Form::number('qta1',null,['class' => 'form-control form-control-sm '. ($errors->has('qta1') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('lunghezza1',round($costo[0]['lunghezza'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('peso1',round($costo[0]['peso'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('materiale1',round($costo_materiale, 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne1',round($costo[0]['lav_interne'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne1',number_format(round($costo[0]['lav_esterne'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro1',number_format(round($costo[0]['altri_costi'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo1',round($costo[0]['costo'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo1',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('prezzo1') ? ' is-invalid' : null)]) }}</td>
    </tr>
    <tr>
        <td>{{ Form::number('qta2',null,['class' => 'form-control form-control-sm '. ($errors->has('qta2') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('lunghezza2',round($costo[1]['lunghezza'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('peso2',round($costo[1]['peso'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('materiale2',round($costo_materiale, 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne2',round($costo[1]['lav_interne'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne2',number_format(round($costo[1]['lav_esterne'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro2',number_format(round($costo[1]['altri_costi'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo2',round($costo[1]['costo'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo2',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('prezzo2') ? ' is-invalid' : null)]) }}</td>
    </tr>
    <tr>
        <td>{{ Form::number('qta3',null,['class' => 'form-control form-control-sm '. ($errors->has('qta3') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('lunghezza3',round($costo[2]['lunghezza'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('peso3',round($costo[2]['peso'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('materiale3',round($costo_materiale, 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne3',round($costo[2]['lav_interne'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne3',number_format(round($costo[2]['lav_esterne'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro3',number_format(round($costo[2]['altri_costi'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo3',round($costo[2]['costo'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo3',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('prezzo3') ? ' is-invalid' : null)]) }}</td>
    </tr>
    <tr>
        <td>{{ Form::number('qta4',null,['class' => 'form-control form-control-sm '. ($errors->has('qta4') ? ' is-invalid' : null)]) }}</td>
        <td>{{ Form::text('lunghezza4',round($costo[3]['lunghezza'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('peso4',round($costo[3]['peso'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('materiale4',round($costo_materiale, 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('interne4',round($costo[3]['lav_interne'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('esterne4',number_format(round($costo[3]['lav_esterne'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('altro4',number_format(round($costo[3]['altri_costi'], 5),5),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::text('costo4',round($costo[3]['costo'], 4),['disabled','step' => '0.001','class' => 'form-control form-control-sm']) }}</td>
        <td>{{ Form::number('prezzo4',null,['step' => '0.001','class' => 'form-control form-control-sm '. ($errors->has('prezzo4') ? ' is-invalid' : null)]) }}</td>
    </tr>
    </tbody>
</table>

{!! Form::submit('Aggiorna preventivo', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

<form id="destroy-form" action="{{ route('preventivi.destroy',[$articolo, $articolo->preventivi[0]]) }}" method="POST" class="mt-5">
    @method('DELETE')
    {!! Form::submit('Elimina preventivo', ['class' => 'btn btn-danger']) !!}
    @csrf
</form>
