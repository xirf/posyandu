@php
    $menus = [['published', __('Published')], ['scheduled', __('Scheduled')], ['draft', __('Draft')]];
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ __('News') }}
                </h2>
                <p>
                    {{ __('Create, edit, and manage the news.') }}
                </p>
            </div>
            <a href="{{ route('dashboard.news.new') }}">
                <x-primary-button>{{ __('Add New') }}</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div x-data="{
        posts: {},
        isLoading: false,
        isSpinning: false,
        showModal: false,
        willDeletedItem: null,
        getPosts(link = '{{ route('api.news.index') }}') {
            this.isLoading = true;
            axios.get(link)
                .then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the posts:', error);
                }).finally(() => {
                    this.showModal = false;
                    this.isLoading = false;
                });
        },
        deletePost(id) {
            this.isSpinning = true;
            axios.delete(`{{ route('api.news.delete', '') }}/${id}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
                    }
                })
                .then(response => {
                    notyf.success('{{ __('Post deleted successfully') }}');
                    this.getPosts();
                })
                .catch(error => {
                    notyf.error('{{ __('Failed to delete, try again') }}');
                    console.error('There was an error deleting the post:', error);
                }).finally(() => {
                    this.isSpinning = false;
                });
        }
    }" x-init="getPosts()" class="w-full" x-cloak>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="w-full p-4 bg-white rounded-lg flex items-center justify-between">
                <div class="overflow-x-auto w-full">
                    <table class="table w-full bg-white text-center">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th class="w-10">{{ __('No') }}</th>
                                <th class="text-left">{{ __('Title') }}</th>
                                <th>{{ __('Author') }}</th>
                                <th>{{ __('Updated') }}</th>
                                <th class="w-24">{{ __('Status') }}</th>
                                <th class="w-24">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr x-show="isLoading">
                                <td colspan="6" class="text-center h-32">
                                    <div class="loading loading-spinner loading-lg"></div>
                                </td>
                            </tr>

                            <tr x-show="!isLoading && posts.data.length == 0">
                                <td colspan="6" class="text-center">
                                    <x-empty :text="__('No news available')" :description="__('There is no news available.')">
                                        <x-slot name="button">
                                            <x-primary-button @click="getPosts()">
                                                {{ __('Refresh') }}
                                            </x-primary-button>
                                        </x-slot>
                                    </x-empty>
                                </td>
                            </tr>

                            <template x-for="(post, index) in posts.data" :key="post.id">
                                <tr>
                                    <td x-text="index + 1"></td>
                                    <td class="grow text-left">
                                        <a x-bind:href="`{{ route('news.show', '') }}/${post.slug}`">
                                            <h2 x-text="post.title"></h2>
                                        </a>
                                    </td>
                                    <td x-text="post.user.name"></td>
                                    <td
                                        x-text="new Date(Math.max(new Date(post.updated_at), new Date(post.published_at))).toLocaleDateString()">
                                    </td>
                                    <td>
                                        <div :class="{
                                            'post-draft': post.status === 'draft',
                                            'post-scheduled': (new Date(post.published_at) > new Date()) && post
                                                .status === 'published',
                                            'post-published': post.status === 'published',
                                        }"
                                            x-text="(new Date(post.published_at) > new Date()) && post.status === 'published' ? '{{ __('Scheduled') }}' : post.status == 'published' ? '{{ __('Published') }}' : '{{ __('Draft') }}'">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex justify-center space-x-2">
                                            <a x-bind:href="`{{ route('dashboard.news.edit', '') }}/${post.id}`"
                                                class="text-blue-500">
                                                <x-heroicon-o-pencil-square class="w-6 h-6" />
                                            </a>
                                            <a href="#" class="text-red-500"
                                                @click="willDeletedItem = post; showModal = true">
                                                <x-heroicon-o-trash class="w-6 h-6" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <nav aria-label="pagination" class="flex justify-between items-center text-sm font-medium pt-4">
                        <div>
                            <p>{{ __('Showing') }} <span x-text="`${posts.from || 0}-${posts.to || 0}`"></span>
                                {{ __('Of') }} <span x-text="posts.total"></span></p>
                        </div>

                        <div class="flex items-center gap-8">
                            <x-secondary-button @click="getPosts(posts.prev_page_url)" x-show="posts.prev_page_url">
                                <x-heroicon-o-chevron-left class="w-4 h-4" />
                            </x-secondary-button>

                            <p class="text-slate-600">
                                {{ __('Page') }} <strong x-text="posts.current_page"></strong> {{ __('Of') }}
                                <strong x-text="posts.last_page"></strong>
                            </p>

                            <x-secondary-button @click="getPosts(posts.next_page_url)" x-show="posts.next_page_url">
                                <x-heroicon-o-chevron-right class="w-4 h-4" />
                            </x-secondary-button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div x-show="showModal" class="fixed inset-0 transition-opacity z-30" aria-hidden="true"
            @click="showModal = false">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- Modal -->
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="fixed z-50 inset-0 overflow-y-auto" x-cloak>
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Modal panel -->
                <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Modal content -->
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Heroicon name: outline/exclamation -->
                                <x-heroicon-o-exclamation-triangle width="64px" height="64px"
                                    class="h-6 w-6 text-red-600" stroke="currentColor" />
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    {{ __('Delete Post') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500"> {{ __('Are you sure you want to delete') }} <span
                                            class="font-bold" x-text="willDeletedItem?.title || ''"></span>?
                                        {{ __('This action cannot be undone.') }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="deletePost(willDeletedItem.id)" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <div x-show="!isSpinning"> {{ __('Delete') }} </div>
                            <div x-show="isSpinning" class="loading loading-spinner loading-sm"></div>
                        </button>
                        <button @click="showModal = false" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Cancel') }} </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
