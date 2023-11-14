<div>
    <div class="container mx-auto ">
        <div class="max-w rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                <form wire:submit.prevent="comment">
                    <label for="email">Comment:</label>
                    <br>
                    <input type="text" wire:model="comment" required placeholder="Comment" class="formInput container">

                    <button
                        class="btn mt-3"
                        type="submit">Submit
                    </button>
                </form>
                <br>
                @if(session()->has('error'))
                    <p class="text-lg text-bold text-red-500 ">{{ session('error') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
