<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="{{ asset('images/logo_footer_black.png') }}" alt="" width="40" height="40" class="d-block mx-auto">
            <small class="d-block m-0">BRAINSTER</small>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://brainster.co/full-stack/">Академија за Програмирање</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://brainster.co/marketing/">Академија за Маркетинг</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://brainster.co/graphic-design/">Академија за Дизајн</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://blog.brainster.co/">Блог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Вработи наши студенти</a>
                    <div class="modal fade" id="exampleModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Вработи наши студенти</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                              <p class="text-muted">Внесете ваши информации за да стапиме во контакт:</p>
                              <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="comp_email" class="form-label">Е-мејл</label>
                                    <input type="email" class="form-control" id="comp_email">
                                  </div>
                                  <div class="mb-3">
                                    <label for="phone" class="form-label">Телефон</label>
                                    <input type="tel" class="form-control" id="phone">
                                  </div>
                                  <div class="mb-3">
                                    <label for="company" class="form-label">Компанија</label>
                                    <input type="text" class="form-control" id="company">
                                  </div>
                                  <div class="d-grid">
                                    <button type="submit" class="btn btn-warning">Испрати</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                </li>
            </ul>
            @if (Session::has('user'))
            <a class="btn btn-primary" href="{{ route('logout') }}">Одјави се</a>
            @else
            <a class="btn btn-primary" href="{{ route('login') }}">Најави се</a>
            @endif
        </div>
    </div>
</nav>
