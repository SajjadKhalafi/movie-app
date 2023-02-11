<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class TagIndex extends Component
{
    public $tagName;
    public $showTagModal = false;
    public $tags = [];
    public $tagId;

    public function mount()
    {
        $this->tags = Tag::all()->sortByDesc('updated_at');
    }

    public function showCreateModal()
    {
        $this->reset(['tagId' , 'tagName']);
        $this->showTagModal = true;
    }

    public function closeTagModal()
    {
        $this->showTagModal = false;
    }

    public function createTag()
    {
        Tag::create([
            'tag_name' => $this->tagName,
            'slug' => Str::slug($this->tagName)
        ]);
        $this->reset();
        session()->flash('flash.banner', 'tag created successfully!');
        session()->flash('flash.bannerStyle', 'success');
        $this->tags = Tag::all();
    }

    public function showEditModal($tagId)
    {
        $this->reset(['tagName']);
        $this->tagId = $tagId;
        $tag = Tag::find($tagId);
        $this->tagName = $tag->tag_name;
        $this->showTagModal = true;
    }

    public function updateTag()
    {
        $tag = Tag::findOrFail($this->tagId);
        $tag->update([
            'tag_name' => $this->tagName,
            'slug' => Str::slug($this->tagName),
        ]);
        $this->reset();
        session()->flash('flash.banner', 'tag updated successfully!');
        session()->flash('flash.bannerStyle', 'success');
        $this->tags = Tag::all();
        $this->showTagModal = false;
    }

    public function deleteTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->delete();
        $this->reset();
        session()->flash('flash.banner', 'tag deleted successfully!');
        session()->flash('flash.bannerStyle', 'success');
        $this->tags = Tag::all();
    }

    public function render()
    {
        return view('livewire.tag-index');
    }
}
