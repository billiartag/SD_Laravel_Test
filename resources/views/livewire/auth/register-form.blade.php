<div>
    <form wire:submit.prevent="register">
        <div class="relative mb-6">
            <label for="name">Name:</label>
            <br>
            <input type="name" wire:model="name" placeholder="Name" required class="formInput">
        </div>
        <div class="relative mb-6">
            <label for="email">Email:</label>
            <br>
            <input type="email" wire:model="email" placeholder="Email" required class="formInput">
        </div>
        <div class="relative mb">
            <label for="password">Password:</label>
            <br>
            <input type="password" wire:model="password" placeholder="Password" required class="formInput">
        </div>
        <div class="relative mt-6 mb-6">
            <label>Roles:</label>
            <div>
                <label>
                    <input type="radio" wire:model="roles" value="admin" name="role" checked> Admin
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" wire:model="roles" value="user" name="role"> User
                </label>
            </div>
        </div>
        <button type="submit"
                class="btn">
            Register
        </button>
    </form>

    @if(session()->has('error'))
        <p class="text-lg text-bold text-red-500 ">{{ session('error') }}</p>
    @endif
</div>
