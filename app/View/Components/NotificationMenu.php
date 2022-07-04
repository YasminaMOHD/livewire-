<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationMenu extends Component
{
    public $notifications;
    public $unread;
    // protected $listeners = ['notify'=>'__construct'];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = Auth::user();
        $this->notifications = $user->notifications()->get();
        $this->unread = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-menu');
    }
}
