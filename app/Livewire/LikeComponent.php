<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\PostViewer;
use Livewire\Component;

class LikeComponent extends Component
{
    public $post_id;
    public $isLiked;
    public $likesCount;
    public $viewCount;

    public function mount($postId)
    {
        $this->post_id = $postId;
        $cek = Like::where([['user_id', auth()->user()->id], ['post_id', $this->post_id]])->count();
        $this->likesCount = Like::where('post_id', $this->post_id)->count();
        $this->viewCount = PostViewer::where('post_id', $this->post_id)->count();
        $this->isLiked = $cek > 0 ? true : false;
    }

    public function likeUnlike()
    {
        if ($this->isLiked == false) {
            $this->isLiked = true;
            $like = new Like;
            $like->post_id = $this->post_id;
            $like->user_id = auth()->user()->id;
            $like->save();
        } else {
            $this->isLiked = false;
            Like::where([['user_id', auth()->user()->id], ['post_id', $this->post_id]])
                ->delete();
        }
    }

    public function render()
    {
        return view('livewire.like-component');
    }
}
