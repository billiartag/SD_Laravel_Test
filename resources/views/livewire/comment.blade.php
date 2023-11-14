<div>
    <div class="container mx-auto ">
        <div class="max-w rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">

                <span class="my-3 text-sm text-pink-500">{{$author}}</span>
                <p>{{$comment}}</p>
                <hr>
                <div class="my-3">

                <span wire:click="doLike">
                LIKE
                </span>
                    <span wire:click="doDislike">
                DISLIKE
            </span>
                </div>
            </div>
        </div>
    </div>

</div>
