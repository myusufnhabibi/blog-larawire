<div>
    <div class="card-body">
        <h5 class="card-title"> My Posts</h5>
        <div class="row" wire:poll>
            <div class="col">
                <div class="card" style="background-color: #98a0e3; font-size:20px;">
                    <div class="card-body text-center text-white">
                        Followers
                    </div>
                    <div class="card-footer text-center text-white" style="background-color: #98a0e3">
                        {{-- {{ $follower_count }} --}}
                    </div>
                </div>
            </div>
            {{-- <livewire:post-data-counter /> --}}
            <div class="col">
                <div class="card" style="background-color: #3ade9f; font-size:20px;">
                    <div class="card-body text-center text-white">
                        Comments
                    </div>
                    <div class="card-footer text-center text-white" style="background-color: #3ade9f">
                        {{-- {{ $comment_count }} --}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="background-color: #e3a598; font-size:20px;">
                    <div class="card-body text-center text-white">
                        Posts
                    </div>
                    <div class="card-footer text-center text-white" style="background-color: #e3a598">
                        {{ $post_count }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-2">
                <div class="card">
                    <div class="card-body p-2">
                        <a href="/post/create" wire:navigate class="m-2">
                            <i class="bi bi-plus-circle"></i>
                            Buat Cerita
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

        <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Content</th>
                    <th scope="col">Posted At</th>
                    <th scope="col">Last Updated</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    {{-- for livewire to keep track and work efficient with loops use keys to uniquely identify each row in a loop --}}
                    <tr wire:key="{{ $item->id }}">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->post_title }}</td>
                        <td><img height="60px" width="60px" class="rounded"
                                src="{{ asset('storage/images/' . $item->photo) }}" alt="post image"></td>
                        <td>{{ str($item->content)->words(10) }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td><a href="/post/edit/{{ $item->id }}" wire:navigate
                                class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td><button wire:click="deletePost({{ $item->id }})"
                                wire:confirm="Are you sure you want to delete this?"
                                class="btn btn-danger btn-sm">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
