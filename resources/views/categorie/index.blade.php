<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('categorie.create')
                    <table id="categorie" class="display">
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($categorie as $categoria)

        @include('categorie.edit')

    @endforeach

    <script>

        const categorie = {!! $categorie !!};

        $(document).ready( function () {
            $('#macchinari').DataTable( {

                paging:         false,
                info:           false,

                oLanguage: {
                    sSearch: "cerca"
                },

                columnDefs: [
                    {
                        targets: '_all',
                        className: 'dt-body-center'
                    }
                ],
                data: categorie,
                columns: [
                    {
                        data: 'descrizione',
                        title: 'Categoria',
                        render: function ( data, type, row ) {
                            return `<a href="#"  data-bs-toggle="modal" data-bs-target="#updateCategorie${row.id }">${data}</a>`;
                        }
                    }
                ]
            } );
        } );

    </script>
</x-app-layout>
