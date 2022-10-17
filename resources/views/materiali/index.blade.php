<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materiali') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('materiali.create')
                    <table id="materiali" class="display">
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($materiali as $materiale)

        @include('materiali.edit')

    @endforeach

    <script>

        const materiali = {!! $materiali !!};

        $(document).ready( function () {
            $('#materiali').DataTable( {

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
                data: materiali,
                columns: [
                    {
                        data: 'nome',
                        title: 'Materiali',
                        render: function ( data, type, row ) {
                            return `<a href="#"  data-bs-toggle="modal" data-bs-target="#updateMateriali${row.id }">${data}</a>`;
                        }
                    },
                    {
                        data: 'peso',
                        title: 'Peso KG al Mt'
                    },
                    {
                        data: 'base',
                        title: 'Base'
                    },
                    {
                        data: 'extra',
                        title: 'Extra'
                    },
                    {
                        data: 'prezzo_kg',
                        title: 'Prezzo KG'
                    },

                ]
            } );
        } );

    </script>
</x-app-layout>
