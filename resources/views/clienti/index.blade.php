<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clienti') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('clienti.create')
                    <table id="clienti" class="display">
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($clienti as $cliente)

        @include('clienti.edit')

    @endforeach

    <script>

        const clienti = {!! $clienti !!};

        $(document).ready( function () {
            $('#clienti').DataTable( {

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
                data: clienti,
                columns: [
                    {
                        data: 'nome',
                        title: 'Cliente',
                        render: function ( data, type, row ) {
                            return `<a href="#"  data-bs-toggle="modal" data-bs-target="#updateClienti${row.id }">${data}</a>`;
                        }
                    },
                    {
                        data: 'desinenza',
                        title: 'Desinenza'
                    }
                ]
            } );
        } );

    </script>
</x-app-layout>
