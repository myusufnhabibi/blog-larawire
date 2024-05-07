<div class="col-xl-6">
    {{-- <livewire:post-viewers-count :postId="$post_id" /> --}}
    <span class="text-muted float-end mx-2">{{ $viewCount }}</span>
    <i class="bi bi-bar-chart-line-fill float-end"></i>
    @if ($isLiked == false)
        <span class="text-muted float-end mx-2">{{ $likesCount }}</span>
        <i class="bi bi-heart float-end" style="cursor: pointer;" wire:click.prevent="likeUnlike"></i>
    @else
        <span class="text-muted float-end mx-2">{{ $likesCount }}</span>
        <i class="bi bi-heart-fill float-end" style="cursor: pointer;" wire:click.prevent="likeUnlike"></i>
    @endif
</div>
