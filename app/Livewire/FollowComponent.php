<?php

namespace App\Livewire;

use App\Models\Follower;
use Livewire\Component;

class FollowComponent extends Component
{
    public $followed_id;
    public $IFollowed; // This will be a boolean
    public $number_followers;

    public function mount($followedId)
    {
        $this->followed_id = $followedId;

        // Check if the profile belongs to the current user
        if ($this->followed_id == auth()->user()->id) {
            $this->IFollowed = false; // You can't follow yourself
            $this->number_followers = Follower::where('followed_id', $this->followed_id)->count();
            return;
        }

        // Get the number of followers for the user
        $this->number_followers = Follower::where('followed_id', $this->followed_id)->count();

        // Check if the authenticated user is following the user
        $checker = Follower::where([
            ['follower_id', auth()->user()->id],
            ['followed_id', $this->followed_id]
        ])->first();

        $this->IFollowed = $checker == null ? false : true;
    }

    public function followUnfollow()
    {
        // Check if the user is trying to follow themselves
        if ($this->followed_id == auth()->user()->id) {
            return; // You can't follow or unfollow yourself
        }

        // Check if the logged-in user is already following the user
        $checker = Follower::where([
            ['follower_id', auth()->user()->id],
            ['followed_id', $this->followed_id]
        ])->first();

        if ($checker == null) {
            // Create a new follow record
            $createFollow = new Follower;
            $createFollow->follower_id = auth()->user()->id;
            $createFollow->followed_id = $this->followed_id;
            $createFollow->save();
        } else {
            // Unfollow by deleting the record
            Follower::where([
                ['follower_id', auth()->user()->id],
                ['followed_id', $this->followed_id]
            ])->delete();
        }

        // Update the number of followers
        $this->number_followers = Follower::where('followed_id', $this->followed_id)->count();

        // Re-check if the user is following or not
        $checker = Follower::where([
            ['follower_id', auth()->user()->id],
            ['followed_id', $this->followed_id]
        ])->first();

        $this->IFollowed = $checker == null ? false : true;
    }

    public function render()
    {
        return view('livewire.follow-component');
    }
}
