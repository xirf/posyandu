<div class="w-full flex flex-col gap-4" x-data="{
    deletedId: null,
    @if (Auth::user()->id == 1) deleteUser(){$dispatch('open-modal', 'confirm-user-deletion')},
    cancelDelete(){$dispatch('close-modal', 'confirm-user-deletion')}, @endif
}">
    <div class="w-full flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold">{{ __('Users') }}</h1>
            <p>{{ __('View who can access admin page.') }}</p>
        </div>
        <a href="{{ route('register') }}">
            <x-primary-button>
                {{ __('Add User') }}
            </x-primary-button>
        </a>
    </div>
    <div class="grid md:grid-cols-2 w-full  gap-4">
        @foreach ($users as $user)
            <div class="p-4 bg-white shadow rounded-lg flex flex-row gap-2 border">
                <img src="{{ $user->picture }}" alt="{{ $user->name }}"
                    class="w-12 h-12 rounded-full overflow-hidden border shrink-0">
                <div class="flex flex-col grow">
                    <h2 class="font-bold">{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                </div>
                @if (Auth::user()->id == 1 && Auth::user()->id != $user->id)
                    <button x-on:click="deletedId = {{ $user->id }}; deleteUser()"
                        class="text-red-500">{{ __('Delete') }}</button>
                @endif
            </div>
        @endforeach
    </div>

    @if (Auth::user()->id == 1)
        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <input type="text" x-model="deletedId" name="deletedId" hidden>
                <section class="space-y-6">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Delete Account') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                        </p>
                    </header>

                    <x-danger-button x-on:click="$dispatch('open-modal', 'confirm-user-deletion')">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </section>
            </form>
        </x-modal>
    @endif
</div>
