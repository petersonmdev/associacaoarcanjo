@extends('layouts/contentNavbarLayout')

@section('title', 'Minha conta - dispositivos conectados')

@section('content')
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Minha conta') }} / </span>{{ __('Dispositivos conectados') }}</h4>

  <div class="row">
    <div class="col-md-12">
      <livewire:account.menu/>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <h4 class="card-header text-primary fw-bold py-3 my-4">{{ __('Dispositivos conectados') }}</h4>
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            <div class="table-responsive">
              <table class="table">
                <thead>
                <tr>
                  <th class="text-truncate">Browser</th>
                  <th class="text-truncate">Device</th>
                  <th class="text-truncate">Location</th>
                  <th class="text-truncate">Recent Activitiy</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="text-truncate text-heading fw-medium"><i class="bx bxl-windows bx-md align-top text-info me-4"></i>Chrome on Windows</td>
                  <td class="text-truncate">HP Spectre 360</td>
                  <td class="text-truncate">Switzerland</td>
                  <td class="text-truncate">10, July 2021 20:07</td>
                </tr>
                <tr>
                  <td class="text-truncate text-heading fw-medium"><i class="bx bxl-android  bx-md align-top text-success me-4"></i>Chrome on iPhone</td>
                  <td class="text-truncate">iPhone 12x</td>
                  <td class="text-truncate">Australia</td>
                  <td class="text-truncate">13, July 2021 10:10</td>
                </tr>
                <tr>
                  <td class="text-truncate text-heading fw-medium"><i class="bx bxl-apple bx-md align-top text-secondary me-4"></i>Chrome on Android</td>
                  <td class="text-truncate">Oneplus 9 Pro</td>
                  <td class="text-truncate">Dubai</td>
                  <td class="text-truncate">14, July 2021 15:15</td>
                </tr>
                <tr>
                  <td class="text-truncate text-heading fw-medium"><i class="bx bx-mobile-alt bx-md align-top text-danger me-4"></i>Chrome on MacOS</td>
                  <td class="text-truncate">Apple iMac</td>
                  <td class="text-truncate">India</td>
                  <td class="text-truncate">16, July 2021 16:17</td>
                </tr>
                <tr>
                  <td class="text-truncate text-heading fw-medium"><i class="bx bxl-apple bx-md align-top text-warning me-4"></i>Chrome on Windows</td>
                  <td class="text-truncate">HP Spectre 360</td>
                  <td class="text-truncate">Switzerland</td>
                  <td class="text-truncate">20, July 2021 21:01</td>
                </tr>
                <tr class="border-transparent">
                  <td class="text-truncate text-heading fw-medium"><i class="bx bxl-android bx-md align-top text-success me-4"></i>Chrome on Android</td>
                  <td class="text-truncate">Oneplus 9 Pro</td>
                  <td class="text-truncate">Dubai</td>
                  <td class="text-truncate">21, July 2021 12:22</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @livewireScripts()
@endsection
