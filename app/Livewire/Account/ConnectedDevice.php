<?php

namespace App\Livewire\Account;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Laravel\Jetstream\Agent;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ConnectedDevice extends Component
{
  public $sessions = [];
  public $password;

  #[Validate([
    'password' => 'required'
  ], message: [
    '*.required' => 'Campo obrigatório.'
  ])]


  public function mount()
  {
    $this->getSessions();
  }

  /*public function getSessions()
  {
    return DB::table('sessions')
      ->where('user_id', auth()->id())
      ->orderBy('last_activity', 'desc')
      ->get();
  }*/

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

    if (str_contains($userAgent, 'Firefox')) {
      $browser = 'Firefox';
    } elseif (str_contains($userAgent, 'Chrome')) {
      $browser = 'Chrome';
    } elseif (str_contains($userAgent, 'Safari')) {
      $browser = 'Safari';
    } elseif (str_contains($userAgent, 'Edge')) {
      $browser = 'Edge';
    } elseif (str_contains($userAgent, 'Opera')) {
      $browser = 'Opera';
    } elseif (str_contains($userAgent, 'MSIE') || str_contains($userAgent, 'Trident')) {
      $browser = 'Internet Explorer';
    } else {
      $browser = 'Outro navegador';
    }

    if (str_contains($userAgent, 'Windows')) {
      $platform = 'Windows';
    } elseif (str_contains($userAgent, 'Macintosh')) {
      $platform = 'MacOS';
    } elseif (str_contains($userAgent, 'Linux')) {
      $platform = 'Linux';
    } elseif (str_contains($userAgent, 'Android')) {
      $platform = 'Android';
    } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
      $platform = 'iOS';
    } else {
      $platform = 'Outro sistema';
    }

    return [
      'browser' => $browser,
      'platform' => $platform,
    ];
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

  public function logoutOtherBrowserSessions()
  {
    $this->validate();

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
      title: 'Outras sessões desconectadas',
      position: 'center',
      timer: 1500
    );
  }

  public function render()
  {
      return view('livewire.account.connected-device');
  }

  public function placeholder()
  {
    return <<<'HTML'
      <div class="m-auto text-center">
        <p class="mt-4 mb-2 text-center text-primary">Carregando</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1); transform: scaleX(-1);">
          <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z">
            <animateTransform attributeName="transform" type="rotate" dur=".4s" values="0 12 12;360 12 12;" repeatCount="indefinite"></animateTransform>
          </path>
        </svg>
      </div>
      HTML;
  }
}
