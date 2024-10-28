<form action="{{route('comment.reply', 1)}}" class="flex flex-col" method="post">
    @csrf
    <div class="flex items-center">
        <x-user.avatar />
        <input type="text" class="p-4 rounded shadow flex-1 text-black pl-4" placeholder="speak your mind!">
    </div>
    <button class="btn btn-primary ml-auto">Reply</button>
</form>
