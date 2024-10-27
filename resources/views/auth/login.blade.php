<x-layout>
 <section class="py-12 max-w-3xl mx-auto">
    <div class="container">
        <div class="rounded-md shadow bg-white p-12 flex flex-col items-start">
            <h1 class="font-bold text-4xl text-black">Login to your account</h1>
            <form action="{{route('login')}}" method="post" class="flex flex-col items-start w-full mt-8">
                @csrf
                <div class="flex flex-col items-start gap-3 w-full">
                    <label for="mobile" class="text-black font-bold text-xl">Email</label>
                    <input type="email" name="email" class="text-black p-5 border shadow w-full rounded border-gray-50" placeholder="johndoe@gmail.com" />
                </div>
                <div class="flex flex-col items-start gap-3 w-full mt-3">
                    <label for="mobile" class="text-black font-bold text-xl">Password</label>
                    <input type="password" name="password" class="text-black p-5 border shadow w-full rounded border-gray-50" placeholder="johndoe@gmail.com" />
                </div>
                <button class="btn btn-primary mt-5 w-full h-16 text-xl">Login</button>
            </form>
            <p class="mx-auto mt-5 text-lg text-black">
                <span>Having trouble logging in?</span>
                <a href="#" class="underline">Let us help</a>
            </p>
            <p class="mx-auto text-lg text-black">
                <span>Haven't joined us yet?</span>
                <a href="{{route('register')}}" class="underline">Join OXCEL</a>
            </p>
        </div>
    </div>
 </section>
</x-layout>
