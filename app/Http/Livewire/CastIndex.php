<?php

namespace App\Http\Livewire;

use App\Models\Cast;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Component;

class CastIndex extends Component
{
    use WithPagination;

    protected $key = '372bd4e6b1011f0918d4409a850fc3e3';
    public $castTMDBid, $castName, $castPosterPath;
    public $showCastModal = false;
    public $castId;
    protected $rules = [
        'castName' => 'required',
        'castPosterPath' => 'required'
    ];

    public function generateCast()
    {
        $newCast = Http::get("https://api.themoviedb.org/3/person/" . $this->castTMDBid . "?api_key=" . $this->key)->json();
        $cast = Cast::where('tmdb_id', $this->castTMDBid)->first();
        if (!$cast) {
            Cast::create([
                'tmdb_id' => $newCast['id'],
                'name' => $newCast['name'],
                'slug' => Str::slug($newCast['name']),
                'poster_path' => $newCast['profile_path'],
            ]);
            $this->reset();
            session()->flash('flash.banner', 'cast created successfully!');
            session()->flash('flash.bannerStyle', 'success');
        } else {
            $this->reset();
            session()->flash('flash.banner', 'cast already exist!');
            session()->flash('flash.bannerStyle', 'danger');
        }
    }


    public function showEditModal($id)
    {
        $this->castId = $id;
        $this->loadCast();
        $this->showCastModal = true;
    }

    public function loadCast()
    {
        $cast = Cast::findOrFail($this->castId);
        $this->castName = $cast->name;
        $this->castPosterPath = $cast->poster_path;
    }

    public function closeCastModal()
    {
        $this->reset();
    }

    public function updateCast()
    {
        $this->validate();
        $cast = Cast::findOrFail($this->castId);
        $cast->update([
            'name' => $this->castName,
            'poster_path' => $this->castPosterPath,
        ]);
        session()->flash('flash.banner', 'cast updated successfully!');
        session()->flash('flash.bannerStyle', 'success');
        $this->reset();
    }

    public function deleteCast($castId)
    {
        Cast::findOrFail($castId)->delete();
        session()->flash('flash.banner', 'cast deleted successfully!');
        session()->flash('flash.bannerStyle', 'success');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.cast-index', [
            'casts' => Cast::paginate(5)
        ]);
    }
}
