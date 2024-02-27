@extends('../layouts/dashboard')

@section('title', 'Product')
@section('content')
    <div class="">
        <a href="{{ route('product.create') }}"
            class="px-4 py-2 block my-2 max-w-min bg-gray-800 hover:bg-gray-700 text-white text-xl duration-200 rounded-md hover:shadow-md">Create</a>
        @if (!$products->isEmpty())
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">name</th>
                                        <th scope="col" class="px-6 py-4">price</th>
                                        <th scope="col" class="px-6 py-4">image</th>
                                        <th scope="col" class="px-6 py-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr class="border-b dark:border-neutral-500">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ ++$loop->index }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $product->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">$ {{ $product->price }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 w-[10rem] h-[6rem]"><img
                                                    class="w-full h-full object-cover" src="{{ asset($product->image) }}"
                                                    alt="{{ $product->name }}"></td>
                                            <td class="whitespace-nowrap px-6 py-4 flex justify-around items-center">
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="text-xl px-2 py-1 bg-orange-400 text-white  rounded-md"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-xl text-white px-2 py-1 bg-red-500 rounded-md"
                                                        onclick="return confirm('are you sure to delete this product ?')"><i
                                                            class="fa-regular fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Pagination --}}
            <div class="my-2">
                {!! $products->links() !!}
            </div>
        @else
            <p class="text-center p-5 text-gray-400 text-4xl">no products here .
                <a href="{{ route('product.create') }}"
                    class="text-gray-800 text-2xl hover:text-rose-700 duration-200">create</a>
            </p>
        @endif
    </div>
@endsection
