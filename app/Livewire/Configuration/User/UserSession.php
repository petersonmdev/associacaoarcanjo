<?php

namespace App\Livewire\Configuration\User;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class UserSession extends Component
{

  public $showModal = false;
  protected $listeners = ['openLogoutModal' => 'showModal'];
  public $sessions = [];
  public $password = '';
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
        $location = $this->getLocationFromIP($session->ip_address);

        return (object) [
          'ip_address'        => $session->ip_address ?? 'Desconhecido',
          'location'          => $location,
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

    $this->validate([
      'password' => 'required',
    ]);

    if (!auth()->validate(['email' => auth()->user()->email, 'password' => $this->password])) {
      $this->addError('password', __('A senha fornecida está incorreta.'));
      return;
    }

    DB::table('sessions')
      ->where('user_id', auth()->id())
      ->where('id', '!=', session()->getId())
      ->delete();

    $this->getSessions();

    $this->dispatch('close-modal', modalId: 'logoutModal');
    $this->dispatch(
      'alert',
      type: 'success',
      title: 'Sessões encerradas com sucesso',
      position: 'center',
      timer: 1500
    );
    $this->showModal = false;
  }

  private function getLocationFromIP($ip)
  {
    if (!$ip || $ip === '127.0.0.1' || $ip === '::1') {
      return 'Localhost';
    }

    return Cache::remember("ip_location_{$ip}", now()->addHours(6), function () use ($ip) {
      $response = Http::get("http://ip-api.com/json/{$ip}?fields=status,country,regionName,city");

      if ($response->successful() && $response->json('status') === 'success') {
        return "{$response->json('city')}, {$response->json('regionName')} - {$response->json('country')}";
      }

      return 'Desconhecido';
    });
  }

  public function showModal()
  {
    $this->showModal = true;
  }

    public function render()
    {
        return view('livewire.configuration.user.user-session');
    }
}
