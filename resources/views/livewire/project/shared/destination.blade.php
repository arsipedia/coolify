<div>
    <h2>Servers</h2>
    <div class="">Server related configurations.</div>
    <div class="grid grid-cols-1 gap-4 py-4">
        <div class="flex gap-2">
            <div class="relative flex flex-col text-white cursor-default box-without-bg bg-coolgray-100 w-96">
                <div class="font-bold">Main Server</div>
                @if (str($resource->realStatus())->startsWith('running'))
                    <div title="{{ $resource->realStatus() }}" class="absolute bg-success -top-1 -left-1 badge badge-xs">
                    </div>
                @elseif (str($resource->realStatus())->startsWith('exited'))
                    <div title="{{ $resource->realStatus() }}" class="absolute bg-error -top-1 -left-1 badge badge-xs">
                    </div>
                @endif
                <div>
                    Server: {{ data_get($resource, 'destination.server.name') }}
                </div>
                <div>
                    Network: {{ data_get($resource, 'destination.network') }}
                </div>
            </div>
            @if ($resource?->additional_networks?->count() > 0)
                <x-forms.button
                    wire:click="redeploy('{{ data_get($resource, 'destination.id') }}','{{ data_get($resource, 'destination.server.id') }}')">Redeploy</x-forms.button>
            @endif
        </div>
        @if ($resource?->additional_networks?->count() > 0)
            @foreach ($resource->additional_networks as $destination)
                <div class="flex gap-2">
                    <div class="relative flex flex-col box w-96">
                        @if (str(data_get($destination, 'pivot.status'))->startsWith('running'))
                            <div title="{{ data_get($destination, 'pivot.status') }}"
                                class="absolute bg-success -top-1 -left-1 badge badge-xs"></div>
                        @elseif (str(data_get($destination, 'pivot.status'))->startsWith('exited'))
                            <div title="{{ data_get($destination, 'pivot.status') }}"
                                class="absolute bg-error -top-1 -left-1 badge badge-xs"></div>
                        @endif
                        <div>
                            Server: {{ data_get($destination, 'server.name') }}
                        </div>
                        <div>
                            Network: {{ data_get($destination, 'network') }}
                        </div>

                    </div>
                    <x-forms.button
                        wire:click="redeploy('{{ data_get($destination, 'id') }}','{{ data_get($destination, 'server.id') }}')">Redeploy</x-forms.button>
                    <x-new-modal
                        action="removeServer({{ data_get($destination, 'id') }},{{ data_get($destination, 'server.id') }})"
                        isErrorButton buttonTitle="Remove Server">
                        This will stop the running application in this server and remove it as a deployment
                        destination.<br><br>Please think again.
                    </x-new-modal>
                </div>
            @endforeach
        @endif
    </div>
    {{-- @if ($resource->getMorphClass() === 'App\Models\Application')
        @if (count($networks) > 0)
            <h4>Choose another server</h4>
            <div class="pb-4 description">(experimental) </div>
            <div class="grid grid-cols-1 gap-4 ">
                @foreach ($networks as $network)
                    <div wire:click="addServer('{{ $network->id }}','{{ data_get($network, 'server.id') }}')"
                        class="box w-96">
                        {{ data_get($network, 'server.name') }}
                        {{ $network->name }}
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-neutral-500">No additional servers available to attach.</div>
        @endif
    @endif --}}
</div>
