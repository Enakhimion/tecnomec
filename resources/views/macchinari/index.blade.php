<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Macchinari') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('macchinari.create')
                    <table id="macchinari" class="display">
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($macchinari as $macchinario)

        @include('macchinari.edit')

    @endforeach

    <script>

        const articoli = {!! $macchinari !!};

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
                data: articoli,
                columns: [
                    {
                        data: 'nome',
                        title: 'Macchinario',
                        render: function ( data, type, row ) {
                            return `<a href="#"  data-bs-toggle="modal" data-bs-target="#updateMacchinari${row.id }">${data}</a>`;
                        }
                    },
                    {
                        data: 'descrizione',
                        title: 'Descrizione'
                    },
                    {
                        data: 'costo_orario_macchina',
                        title: 'Costo orario macchina'
                    },
                    {
                        data: 'costo_orario_setup',
                        title: 'Costo orario setup'
                    }
                ]
            } );
        } );

    </script>
</x-app-layout>
