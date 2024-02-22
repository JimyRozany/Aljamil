@extends('../layouts/dashboard')

@section('title', 'Companies')

@section('content')
    <div class="border border-green-500 flex flex-col relative">
        {{-- add new company  --}}
        <form action="{{ route('company.store') }}" method="POST" class="p-5 flex items-center gap-2">
            @csrf
            <div class="w-72">
                <div class="relative w-full min-w-[200px] h-10">
                    <input
                        class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                        placeholder=" " name="company_name" />
                    <label
                        class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">Company
                        name
                    </label>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-red-600 text-[14px]" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <button
                class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                type="submit">
                Add
            </button>
        </form>

        {{-- display all companies if is exists --}}
        @if ($companies)
            <div class="border border-red-500 overflow-scroll h-auto mt-5 flex justify-center items-center flex-col">
                <div class="grid gap-5 grid-cols-2  md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($companies as $company)
                        {{-- company card --}}
                        <div
                            class="border-2 border-gray-800 w-24 h-24 md:w-32 md:h-32 lg:w-40 lg:h-40 flex flex-col items-center justify-center p-1 group relative rounded-lg shadow-xl">
                            {{-- image --}}
                            <div class=" w-16 md:w-24">
                                <img class="w-full object-cover" src="{{ asset('/img/company-img.png') }}" alt="">
                            </div>
                            {{-- company name --}}
                            <div class="text-[16px] md:text-lg font-semibold text-center">{{ $company->name }}</div>
                            {{-- action buttons --}}
                            <div
                                class="hidden group-hover:block group-hover:cursor-pointer  absolute bg-black/45 w-full h-full ">
                                <div class="w-full h-full flex justify-center items-center gap-3">
                                    <a href="{{ route('company.edit', $company->id) }}" id="editBtn" {{-- onclick="showHideEditForm('{{ $company->name }} ' ,{{ $company->id }})" --}}
                                        class="bg-orange-400 hover:bg-orange-600 duration-300 py-1 px-1.5 md:px-2 block text-sm md:text-xl text-white rounded-full outline-none border-none">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('company.destroy', $company->id) }}" method="POST"
                                        class="bg-red-400 hover:bg-red-600 duration-300 py-1  px-2 md:px-2.5 block text-sm  md:text-xl text-white rounded-full outline-none border-none">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure to delete this comapny ({{ $company->name }}) ')"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Pagination --}}
                <div class="mt-2">
                    {!! $companies->links() !!}
                </div>
            </div>
        @else
            <h1 class="text-center text-2xl text-gray-400 font-semibold my-10">no companies</h1>
        @endif
    </div>
@endsection

@section('script')
    {{-- <script>
        let companyID;

        const showHideEditForm = (companyName = null, companyId = null) => {
            const editForm = document.querySelector("#editForm")
            editForm.classList.toggle("hidden")
            editForm.classList.toggle("flex")
            const input = document.querySelector("#company_name")
            input.value = companyName;
            companyID = companyId;
        }

        // const editCompany = async (event) => {
        //     event.preventDefault();
        //     const companyNameInput = document.querySelector("#company_name")
        //     const companyName = companyNameInput.value;

        //     // let csrf = document.querySelector('#csrf_meta').content;

        //     // console.log("token", csrf);


        //     // const response = await fetch(`http://127.0.0.1:8000/company/1`, {
        //     //     method: "POST",
        //     //     body: JSON.stringify({
        //     //         name: companyName
        //     //     }),
        //     //     headers: {
        //     //         "Content-type": "application/json; charset=UTF-8"
        //     //     }
        //     // });

        //     // .then((response) => response.json())
        //     // .then((json) => console.log(json));

        //     // console.log(response.json());


        // }


        // $("#editBtn").on("click", () => {
        //     alert("clicked")
        // })
        // handle the request by Ajax Jquery

        // $(function() {
        //     $('#formEdit').on("submit", function(e) {
        //         e.preventDefault()
        //         // $.post(`http://127.0.0.1:8000/company/${companyID}`, {
        //         //     name: "new new company name"
        //         // }, (response, status, XHRobj) => {
        //         //     console.log(response);
        //         //     console.log(status);
        //         //     console.log(XHRobj);
        //         // })
        //         // $.ajax({
        //         //     url: `http://127.0.0.1:8000/company/${companyID}`,
        //         //     // url: `{{ route('company.update', 1) }}`,
        //         //     type: 'PUT',
        //         //     // data: {
        //         //     //     name: "new new name for company",
        //         //     //     _token: '{{ csrf_token() }}',
        //         //     // },
        //         //     data: new FormData(this),
        //         //     dataType: 'JSON',
        //         //     contentType: false,
        //         //     cache: false,
        //         //     processData: false,
        //         //     success: function(result) {
        //         //         // Do something with the result
        //         //         console.log(result)
        //         //     }
        //         // });
        //         // $.ajax({
        //         //     url: `http://127.0.0.1:8000/company/update`,
        //         //     type: 'POST',
        //         //     data: {
        //         //         name: "new new name for company",
        //         //         _token: '{{ csrf_token() }}'
        //         //     },
        //         //     success: function(result) {
        //         //         // Do something with the result
        //         //         console.log(result)
        //         //     }
        //         // });
        //     })

        // })
        /* --------------- new code ---------------*/
        var form = '#add-project-form';
        $(form).on('submit', function(event) {
            event.preventDefault();

            var url = $(this).attr('data-action');
            console.log(`my url is : : ${url}`);
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    name: "new name company",
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                }
            });
        })
    </script> --}}
@endsection
