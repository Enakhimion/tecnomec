<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Descrizione Lav Interne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('domini_lav_interne.create')
                    <table id="domini_lav_interne" class="display">
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($domini_lav_interne as $dominio_lav_interna)

        @include('domini_lav_interne.edit')

    @endforeach

    <script>

        const domini_lav_interne = {!! $domini_lav_interne !!};

        $(document).ready( function () {
            $('#domini_lav_interne').DataTable( {

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
                data: domini_lav_interne,
                columns: [
                    {
                        data: 'descrizione',
                        title: 'Descrizione Lav interna',
                        render: function ( data, type, row ) {
                            return `<a href="#"  data-bs-toggle="modal" data-bs-target="#updateLavInterna${row.id }">${data}</a>`;
                        }
                    },

                ]
            } );
        } );

    </script>
</x-app-layout>
