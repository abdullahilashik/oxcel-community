<x-layout>
    <section class="py-12 max-w-7xl mx-auto">
        <div class="container">
            <div class="rounded-md shadow bg-white p-12 flex flex-col items-start">
                <h1 class="font-bold text-4xl text-black">Please enter your details</h1>
                <form action="{{route('register')}}" method="post" class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    @csrf
                    <div class="flex flex-col items-start gap-3 w-full">
                        <label for="fname" class="text-black font-bold text-xl">First name*</label>
                        <input type="text"
                        name="fname"
                        value="{{old('fname')}}"
                         class="text-black p-5 border shadow w-full rounded border-gray-50"
                            placeholder="John" />
                        @error('fname')
                            <span class="text-red-600 font-bold">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col items-start gap-3 w-full">
                        <label for="lname" class="text-black font-bold text-xl">Last name*</label>
                        <input type="text"
                        name="lname"
                        value="{{old('lname')}}"
                            class="text-black p-5 border shadow w-full rounded border-gray-50"
                            placeholder="Doe" />
                        @error('lname')
                            <span class="text-red-600 font-bold">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col items-start gap-3 w-full">
                        <label for="email" class="text-black font-bold text-xl">Email*</label>
                        <input type="text"
                        name="email"
                        value="{{old('email')}}"
                            class="text-black p-5 border shadow w-full rounded border-gray-50"
                            placeholder="johndoe@example.com" />
                        @error('email')
                            <span class="text-red-600 font-bold">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col items-start gap-3 w-full">
                        <label for="mobile" class="text-black font-bold text-xl">Phone*</label>
                        <input type="text"
                        name="phone"
                        value="{{old('phone')}}"
                            class="text-black p-5 border shadow w-full rounded border-gray-50"
                            placeholder="04x-xxx-xxxx-xxxx" />
                        @error('phone')
                            <span class="text-red-600 font-bold">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col items-start gap-3 w-full">
                        <label for="password" class="text-black font-bold text-xl">Password*</label>
                        <input type="password"
                        name="password"
                        value="{{old('password')}}"
                            class="text-black p-5 border shadow w-full rounded border-gray-50"
                            placeholder="********" />
                        @error('password')
                            <span class="text-red-600 font-bold">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col items-start gap-3 w-full">
                        <label for="password" class="text-black font-bold text-xl">Confirm Password*</label>
                        <input type="password"
                        name="password_confirmation"
                        value="{{old('password')}}"
                            class="text-black p-5 border shadow w-full rounded border-gray-50"
                            placeholder="********" />
                    </div>
                    <span></span>
                    <button class="btn btn-primary mt-5 ml-auto w-full h-16 text-xl">Register</button>
                </form>
                <p class="mx-auto mt-5 text-lg text-black">
                    <span>Having trouble logging in?</span>
                    <a href="#" class="underline">Let us help</a>
                </p>
                <p class="mx-auto text-lg text-black">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}" class="underline">Login</a>
                </p>
            </div>
        </div>
    </section>
</x-layout>
