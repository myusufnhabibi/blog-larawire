<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    public Post $post;
    public $post_title;
    public $content;
    public $photo;

    public function mount($postdata)
    {
        $this->post = $postdata;
        $this->post_title = $postdata->post_title;
        $this->content = $postdata->content;
    }

    public function update()
    {
        // update data to database
        $this->validate([
            'post_title' => 'required',
            'content' => 'required',
        ]);
        if ($this->photo == null) {
            Post::where('id', $this->post->id)->update([
                'post_title' => $this->post_title,
                'content' => $this->content,
            ]);
        } else {
            $photo_name = md5($this->photo . microtime()) . '.' . $this->photo->extension();
            $this->photo->storeAs('public/images', $photo_name);
            Post::where('id', $this->post->id)->update([
                'post_title' => $this->post_title,
                'content' => $this->content,
                'photo' => $photo_name,
            ]);
        }

        session()->flash('message', 'The post was successfully updated!');
        return $this->redirect('/posts', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
