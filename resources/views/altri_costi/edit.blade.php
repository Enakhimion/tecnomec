<!-- Modal -->
<div class="modal fade" id="lavAltroCosto{{ $altro_costo->id }}" tabindex="-1" aria-labelledby="modalLavInterna" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $altro_costo->descrizione }}</h5>
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

                {!! Form::model($altro_costo, ['method' => 'PUT','route' => ['altri_costi.update', $articolo,$altro_costo]]) !!}

                @include('altri_costi.modules.form')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                {!! Form::submit('Salva costo', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
