<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="articoli" class="display">
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>

        const articoli = {!! $articoli !!};

        $(document).ready( function () {
            $('#articoli').DataTable( {

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
                data: articoli,
                columns: [
                    {
                        data: 'codice_completo',
                        title: 'Codice Articolo',
                        render: function ( data, type, row ) {
                            return `<a href="/articoli/${row.id}/edit/">${data}</a>`;
                        }
                    },
                    {
                        data: 'descrizione',
                        title: 'Descrizione'
                    },
                    {
                        data: 'cliente.nome',
                        title: 'Cliente'
                    }
                ]
            } );
        } );

    </script>
</x-app-layout>
