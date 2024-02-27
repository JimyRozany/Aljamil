@extends('../layouts/dashboard')

@section('title', 'Home')

@section('content')
    <div class="w-full h-screen">

        <div class="w-96 border  p-2 shadow-md">
            <h1 class="text-2xl text-gray-700 font-bold py-2 ">Category Section</h1>
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <input type="text" value="" placeholder="Category name" name="category_name"
                    class="border-b-2 border-transparent outline-0 bg-gray-100 px-4 py-1 rounded-t-md shadow-md text-gray-800 focus:border-gray-800 transition-all duration-300 ">

                <button
                    class="ml-2 bg-gray-800 px-4 py-1 text-white rounded-md hover:bg-gray-700 hover:shadow-md ">Add</button>
                {{-- handle errors --}}
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-red-600 text-[14px]" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </form>
            <div class="w-full brder border-red-500 mt-2">
                @if (!$categories->isEmpty())
                    <ul class="border">
                        @foreach ($categories as $category)
                            <li class="border-b p-2 flex justify-between items-center">
                                <span class="w-[50%]">{{ $category->name }}</span>
                                <span class="w-[50%] flex justify-around items-center gap-4">
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="text-gray-800 hover:text-yellow-500 text-xl duration-150"><i
                                            class="fa-regular fa-pen-to-square"></i></a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure to delete this Category ({{ $category->name }})')"
                                            class="text-xl text-gray-800 hover:text-red-600 duration-150"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-gray-300 text-center ">not categories</div>
                @endif


            </div>
        </div>
    </div>
@endsection
