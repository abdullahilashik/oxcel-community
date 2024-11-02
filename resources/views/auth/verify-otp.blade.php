<x-layout>
    <div class="container">
        <div class="p-24">
            <!-- resources/views/auth/verify-otp.blade.php -->
            <form method="POST" action="{{ route('verify.otp') }}" class="bg-white p-12 flex flex-col gap-4">
                @csrf
                <label for="otp">Enter OTP:</label>
                <input type="text" name="otp" id="otp" required class="border p-4 rounded shadow" placeholder="Enter OTP sent in mail">
                <button type="submit" class="mt-5 btn btn-primary">Verify OTP</button>
            </form>
        </div>
    </div>
</x-layout>
