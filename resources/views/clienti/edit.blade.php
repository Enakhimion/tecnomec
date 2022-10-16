<!-- Modal -->
<div class="modal fade" id="updateClienti{{ $cliente->id }}" tabindex="-1" aria-labelledby="updateClienti" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cliente {{ $cliente->nome }}</h5>
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

                {!! Form::model($cliente, ['method' => 'PUT','route' => ['clienti.update', $cliente]]) !!}

                @include('clienti.modules.form')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                {!! Form::submit('Salva cliente', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
