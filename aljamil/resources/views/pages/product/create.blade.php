@extends('../layouts/dashboard')

@section('title', 'Create Product')
@section('content')
    <div class="w-96 mt-4">
        <form class="space-y-4 w-full" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="text" class="border-b-2  w-full px-2 py-1 outline-none focus:border-b-gray-800 " 
                placeholder="Name" name="name" />
            @if ($errors->has('name'))
                <div class="mb-4 text-sm text-rose-600 rounded-lg" role="alert">
                    <span class="font-medium">{{ $errors->first('name') }}!</span>
                </div>
            @endif
            <input type="number" class="border-b-2  w-full px-2 py-1 outline-none focus:border-b-gray-800 " 
                placeholder="Price" name="price" />
            @if ($errors->has('price'))
                <div class="mb-4 text-sm text-rose-600 rounded-lg" role="alert">
                    <span class="font-medium">{{ $errors->first('price') }}!</span>
                </div>
            @endif
            <select class="border-2 border-gray-200 rounded px-3 py-2 w-full" name="select_company">
                <option label="select company"></option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
            <select class="border-2 border-gray-200 rounded px-3 py-2 w-full" name="select_category">
                <option label="Select Category"></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <textarea class="border-b-2  w-full max-h-20 min-h-20 px-2 py-1 outline-none focus:border-b-gray-800 " type="text"
                placeholder="Description" name="description"></textarea>
            <input type="file" class="hidden" id="input-image" name="image" onchange="checkIsUploaded()">
            <label for="input-image" class="block text-xl text-gray-800 cursor-pointer" id="label-image">
                <span>Image:</span>
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </label>
            @if ($errors->has('image'))
                <div class="mb-4 text-sm text-rose-600 rounded-lg" role="alert">
                    <span class="font-medium">{{ $errors->first('image') }}!</span>
                </div>
            @endif
            <div class="text-center">
                <button type="submit"
                    class=" w-[80%] text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const checkIsUploaded = () => {
            const inputImage = document.querySelector("#input-image")
            const labelImage = document.querySelector("#label-image")
            if (inputImage.value !== null) {
                labelImage.innerHTML += '<i class="fa-solid fa-check text-green-400"></i>'
            }
        }
    </script>
@endsection
