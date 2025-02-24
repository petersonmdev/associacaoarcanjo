<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LogoutOtherBrowser extends Component
{

  public $sessions = [];
  public $password;
  public $confirmingLogout = false;

  public function mount()
  {
    $this->getSessions();
  }

  public function getSessions()
  {
    if (!auth()->check()) {
      return;
    }

    $userId = auth()->id();
    $sessions = DB::table('sessions')
      ->where('user_id', $userId)
      ->orderBy('last_activity', 'desc')
      ->get()
      ->map(function ($session) {
        return (object) [
          'ip_address'        => $session->ip_address ?? 'Desconhecido',
          'user_agent'        => $this->parseUserAgent($session->user_agent),
          'is_current_device' => session()->getId() === $session->id,
          'last_active'       => now()->subSeconds(now()->timestamp - $session->last_activity)->diffForHumans(),
        ];
      });

    $this->sessions = $sessions;
  }

  private function parseUserAgent($userAgent)
  {
    if (!$userAgent) {
      return 'Desconhecido';
    }

    if (str_contains($userAgent, 'Windows')) {
      return 'Windows';
    } elseif (str_contains($userAgent, 'Macintosh')) {
      return 'MacOS';
    } elseif (str_contains($userAgent, 'Linux')) {
      return 'Linux';
    } elseif (str_contains($userAgent, 'Android')) {
      return 'Android';
    } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
      return 'iOS';
    }

    return 'Outro dispositivo';
  }

  public function confirmLogout()
  {
    $this->confirmingLogout = true;
  }

  public function logoutOtherBrowserSessions()
  {
    if (!auth()->validate(['email' => auth()->user()->email, 'password' => $this->password])) {
      $this->addError('password', __('The provided password is incorrect.'));
      return;
    }

    DB::table('sessions')
      ->where('user_id', auth()->id())
      ->where('id', '!=', session()->getId())
      ->delete();

    $this->dispatch('loggedOut');
    $this->confirmingLogout = false;
    $this->password = null;
    $this->getSessions();
  }

    public function render()
    {
        return view('livewire.profile.logout-other-browser');
    }
}
