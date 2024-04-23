@extends('layouts.main')
@section('content')


    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    external code
                </th>
                <th scope="col" class="px-6 py-3">
                    name
                </th>
                <th scope="col" class="px-6 py-3">
                    price
                </th>
                <th scope="col" class="px-6 py-3">
                    discount
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr onclick="toProduct(this)" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" data-href="{{route('product.show', $product->id)}}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$product->external_code}}
                    </th>
                    <td class="px-6 py-4">
                        {{$product->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$product->price}}
                    </td>
                    <td class="px-6 py-4">
                        {{$product->discount . '%'}}
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
        {{$products->links()}}
    </div>
<script>
    function toProduct(row)
    {
        location.href = row.dataset.href;
    }
</script>
@endsection
