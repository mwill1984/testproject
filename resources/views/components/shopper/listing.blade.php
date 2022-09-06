<x-table-column>
    <x-shopper.status :shopper="$shopper"/>
</x-table-column>

<x-table-column>
    {{ $shopper['first_name'] }} {{ $shopper['last_name'] }}
</x-table-column>

<x-table-column>
    {{ $shopper['email'] }}
</x-table-column>

<x-table-column>
    {{ $shopper['check_in'] }}
</x-table-column>

<x-table-column>
    {{ $shopper['activated'] }}
</x-table-column>

<x-table-column>
@if( isset($shopper['status']['name']) )
    @switch( $shopper['status']['name'] )
        @case('Active')
        <form method="POST" action="{{ route('store.location.checkout', ['storeUuid' => $storeUuid, 'shopperUuid' => $shopper['uuid']]) }}">
            @csrf
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">
                Checkout Now
            </button>
        </form>
        @break
        @default
            {{ $shopper['check_out'] }}
        @break
    @endswitch
@endif

</x-table-column>

{{--<x-table-column>--}}

{{--</x-table-column>--}}
