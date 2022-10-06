

<!-- Button trigger modal -->
<a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMacchinario">
    Nuovo macchinario
</a>


<!-- Modal -->
<div class="modal fade" id="modalMacchinario" tabindex="-1" aria-labelledby="modalMacchinario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuovo macchinario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => route('macchinari.store')]) !!}

                @include('macchinari.modules.form')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                {!! Form::submit('Salva macchinario', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
