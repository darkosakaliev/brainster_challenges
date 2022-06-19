<div class="container position-absolute start-0 end-0">
<nav class="navbar navbar-expand-lg bg-transparent">
    <div class="container-fluid">
      <a class="navbar-brand text-white fw-bold" href="#">Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="text-white nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">HOME</a>
          </li>
          <li class="nav-item">
            <a class="text-white nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">ABOUT</a>
          </li>
          <li class="nav-item">
            <a class="text-white nav-link {{ request()->is('blog') ? 'active' : '' }}" href="{{ route('blog') }}">SAMPLE POST</a>
          </li>
          <li class="nav-item">
            <a class="text-white nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">CONTACT</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
