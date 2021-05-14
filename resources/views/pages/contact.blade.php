@extends('layouts.master')
@section('content')
    <div class="flex items-center">
        <div class="container mx-auto">
            <div class="md:w-8/12 mx-auto my-10 p-5 rounded-md">
                <div class="text-center">
                    <h1 class="my-3 text-2xl font-bold tracking-tight text-gray-700 dark:text-gray-200 uppercase">
                        Contact Us</h1>
                    <p class="text-gray-500 font-normal text-sm capitalize">Fill up the form below to send us a
                        message.</p>
                </div>

                <form action="{{ url('/contact') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-container pt-10">
                        @if($errors->count() > 0)
                            <div class="alert">
                                <strong>{{ $errors->count().' '. \Illuminate\Support\Str::plural('error', $errors->count()) }} </strong>
                                prevented the form submission
                                <hr>
                                <div class="errors mt-2">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="grid grid-col-2 grid-flow-col gap-4">
                            <div class="form-group">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                        <small class="text-xs text-gray-500">Fullname</small>
                                    </label>
                                    <input
                                        class="appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline placeholder-gray-300"
                                        id="name" name="name" type="text" value="{{old('name')}}"
                                        placeholder="ex: Rilwan Balogun" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                        <small class="text-xs text-gray-500">Email Address</small>
                                    </label>
                                    <input
                                        class="appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline placeholder-gray-300"
                                        id="email" name="email" type="text" value="{{old('email')}}" required
                                        placeholder="ex: riliwan.rabo@geneo.com">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols divide-y divide-gray-200 py-5">
                            <div></div>
                            <div></div>
                        </div>
                        <div>
                            <div class="form-group">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                        <small class="text-xs text-gray-500">Message</small>
                                    </label>
                                    <textarea
                                        class="resize-none h-20 border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline placeholder-gray-300"
                                        id="message" name="message" required
                                        placeholder="Enter your complaint here. Markdown is supported.">{{old('message')}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="file"
                                   class="filepond"
                                   name="file"
                                   accept="text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/pdf"/>
                        </div>

                        <footer class="actions">
                            <button id="submit"
                                    class="w-full py-3 tracking-normal opacity-90 text-sm font-bold text-white rounded-sm uppercase bg-primary"
                                    type="submit">Submit
                            </button>
                        </footer>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);
        let serverResponse = '';
        pond.setOptions({
            server: {
                process: {
                    url: '/upload',
                    onerror: (response) => {
                        // I am returning JSON from the backend e.g '{"message": "upload the right documents"}'
                        serverResponse = JSON.parse(response);
                        document.getElementById("submit").classList.add("disabled");
                    }
                },
                revert: '/upload/revert',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ @csrf_token() }}' // laravel csrf token (substitute with your token)
                }
            },
            labelFileProcessingError: () => {
                // replaces the error on the label

                return serverResponse.message;
            }
        });
    </script>
@endpush
