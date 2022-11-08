<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Descrizione lavorazioni esterne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('domini_lav_esterne.create')
                    <table id="domini_lav_esterne" class="display">
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($domini_lav_esterne as $domino_lav_esterna)

        @include('domini_lav_esterne.edit')

    @endforeach

    <script>

        const domini_lav_esterne = {!! $domini_lav_esterne !!};

        $(document).ready( function () {
            $('#domini_lav_esterne').DataTable( {

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
                data: domini_lav_esterne,
                columns: [
                    {
                        data: 'descrizione',
                        title: 'Descrizione',
                        render: function ( data, type, row ) {
                            return `<a href="#"  data-bs-toggle="modal" data-bs-target="#updateLavEsterne${row.id }">${data}</a>`;
                        }
                    }
                ]
            } );
        } );

    </script>
</x-app-layout>
