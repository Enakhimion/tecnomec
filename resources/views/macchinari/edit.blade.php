<!-- Modal -->
<div class="modal fade" id="updateMacchinari{{ $macchinario->id }}" tabindex="-1" aria-labelledby="updateMacchinari" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Macchinario {{ $macchinario->nome }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif

                {!! Form::model($macchinario, ['method' => 'PUT','route' => ['macchinari.update', $macchinario]]) !!}

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
