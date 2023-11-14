<div>
    <div wire:click="doGoPost" class="container mx-auto my-6">
        <div class="max-w rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">

                <p class="text-xl font-bold my-6">{{$title}}</p>
                <hr>
                <span class="my-3 text-sm text-pink-500">{{$author}}</span>
                <p class="py-3">{{$content}}</p>
                <hr>
                <div class="my-3 float-right">
                    <span wire:click="doLike" class="mx-3">LIKE</span>
                    <span wire:click="doDislike">DISLIKE</span>
                </div>
            </div>
        </div>
    </div>

</div>
