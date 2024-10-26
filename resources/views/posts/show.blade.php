<x-layout>
    <x-hero />
    <x-breadcrumb />
    <section>
        <div class="container">
            {{-- main Post --}}
            <div class="bg-white rounded-md shadow-md p-4">
                {{-- header --}}
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-4">
                    {{-- identification --}}
                    <div class="flex items-center gap-2">
                        <img src="{!! asset('uploads/oxcel.png') !!}" alt="" class="rounded-full w-20 aspect-square">
                        <div class="flex flex-col items-start">
                            <h4 class="text-2xl font-bold text-black">Oxcel Compliance</h4>
                            <span class="text-sm">16 Oct 2024, 05:27 pm AEST</span>
                        </div>
                    </div>
                    {{-- actions --}}
                    <x-post.post-action />
                </div>
                {{-- content --}}
                <div class="flex flex-col items-start py-4">
                    <h4 class="post-title">Understanding the Process if a Client Does Not Proceed with a Loan</h4>
                    <article class="py-4">
                        Hello everyone,
                            <br/>
                            At Oxcel Pty Ltd, we strive to provide seamless service and support during the loan approval process. However, it's important to understand the procedure when a client decides not to proceed with an approved loan.
                            <br/>
                            If a client chooses not to go ahead with a loan that has already been negotiated and approved, we understand the need to compensate brokers for their time and effort. In such cases, brokers may charge the client the amount specified in the quote, which was initially approved by Oxcel Finance.
                            <br/>
                            We hope this helps clarify our protocol and ensures transparency in our operations. If you have any questions or need further information, feel free to reach out.
                            <br/>
                            Warm regards,<br/>
                            Oxcel Pty Ltd Team
                    </article>
                </div>
                {{-- footer --}}
                <div class="flex items-center justify-between">
                    {{-- badges --}}
                    <x-post.badges />
                    {{-- share --}}
                    <x-social-share />
                </div>
            </div>
            {{-- comment form --}}
            <div class="flex flex-col mt-12">
                <h4 class="post-title">Comments (0)</h4>
                <form action="#" class="py-8">
                    <div class="flex items-center gap-4">
                        <img src="{!! asset('uploads/oxcel.png') !!}" alt="" class="h-16 aspect-square rounded-full">
                        <input type="text" class="rounded-md p-6 flex-1 text-black" placeholder="Anything you want to add?">
                    </div>
                    <button class="btn btn-primary ml-auto mt-6 float-right">Post Comment</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
