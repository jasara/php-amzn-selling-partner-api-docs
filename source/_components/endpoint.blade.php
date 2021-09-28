<h2>{{ $endpoint }}</h2>
<div class="px-4">

    @if($usage)
    <p class="mb-0 font-semibold">Usage</p>
    <pre style="margin-top: 0;"><code class="language-php">{{ $usage }}</code></pre>
    @endif
    @if(count($parametersArray()))
    <p class="mb-0 font-semibold">Parameters</p>
    <x-table.base class="my-2">
        <x-slot name="headings">
            <x-table.th>Parameter</x-table.th>
            <x-table.th>Type</x-table.th>
            <x-table.th>Examples</x-table.th>
            <x-table.th>Description</x-table.th>
        </x-slot>

        @foreach($parametersArray() as $parameter)
        <tr class="bg-white">
            <x-table.td>
                <div class="flex flex-col">
                    <div>
                        <code>{{$parameter['key']}}</code>
                    </div>
                    <div class="mt-1">
                        @if(array_key_exists('optional', $parameter))
                        <x-badge colour="gray">Optional</x-badge>
                        @else
                        <x-badge colour="yellow">Required</x-badge>
                        @endif
                    </div>
                </div>
            </x-table.td>
            <x-table.td>
                <x-badge colour="blue">{{$parameter['type']}}</x-badge>
            </x-table.td>
            <x-table.td>{{$parameter['example']}}</x-table.td>
            <x-table.td>{!!$parameter['description']!!}</x-table.td>
        </tr>
        @endforeach
    </x-table.base>
    @else
    <x-badge colour="blue">No parameters</x-badge>
    @endif
    @if(count($schemaArray()))
    <p class="mb-0 font-semibold">
        Payload: <code class="font-normal">{{ $payload }}</code>
        @if(str_contains($payload, 'List'))
        <x-badge colour="blue">Collection</x-badge>
        @endif
    </p>
    <x-table.base class="mt-2">
        <x-slot name="headings">
            <x-table.th>Key</x-table.th>
            <x-table.th>Type</x-table.th>
            <x-table.th>Examples</x-table.th>
            <x-table.th>Description</x-table.th>
        </x-slot>

        @foreach($schemaArray() as $key)
        <tr class="bg-white">
            <x-table.td><code>{{$key['key']}}</code></x-table.td>
            <x-table.td>
                <x-badge colour="blue">{{$key['type']}}</x-badge>
            </x-table.td>
            <x-table.td>{{$key['example']}}</x-table.td>
            <x-table.td>{!!$key['description']!!}</x-table.td>
        </tr>
        @endforeach
    </x-table.base>
    @else
    <x-badge colour="blue">No payload</x-badge>
    @endif
</div>