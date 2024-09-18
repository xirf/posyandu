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
        posts: [],
        isLoading: false,
        getPosts() {
            fetch('/api/news')
                .then(response => response.json())
                .then(data => {
                    this.posts = data;
                });
        },
        deletePost(id) {
            fetch(`/api/news/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=`csrf-token`]').getAttribute('content')
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.getPosts();
                    }
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr x-show="isLoading">
                                <td colspan="5" class="text-center h-32">
                                    <div class="loading loading-spinner loading-lg"></div>
                                </td>
                            </tr>

                            <tr x-show="!isLoading && posts.length == 0">
                                <td colspan="5" class="text-center">
                                    <x-empty :text="__('No news available')" :description="__('There is no news available.')">
                                        <x-slot name="button">
                                            <x-primary-button @click="getPosts()">
                                                {{ __('Refresh') }}
                                            </x-primary-button>
                                        </x-slot>
                                    </x-empty>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>1</td>
                                <td class="grow text-left">News Title that is very long and will be truncated</td>
                                <td>Author</td>
                                <td>2021-09-01</td>
                                <td>
                                    <div class="post-draft">Draft</div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="grow text-left">News Title that is very long and will be truncated</td>
                                <td>Author</td>
                                <td>2021-09-01</td>
                                <td>
                                    <div class="post-published">Published</div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="grow text-left">News Title that is very long and will be truncated</td>
                                <td>Author</td>
                                <td>2021-09-01</td>
                                <td>
                                    <div class="post-scheduled">Scheduled</div>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
