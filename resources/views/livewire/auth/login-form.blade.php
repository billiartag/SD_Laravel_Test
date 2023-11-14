<div>
    <form wire:submit.prevent="login">
        <div class="relative mb-6">
            <label for="email">Email:</label>
            <br>
            <input type="email" wire:model="email" required placeholder="Email" class="formInput">
        </div>

        <div class="relative mb-6">
            <label for="password">Password:</label>
            <br>
            <input type="password" wire:model="password" required placeholder="Password" class="formInput">
        </div>
        <button
            class="btn"
            type="submit">Login
        </button>
    </form>
    <br>
    @if(session()->has('error'))
        <p class="text-lg text-bold text-red-500 ">{{ session('error') }}</p>
    @endif
</div>
