@include('layouts.header')
@include('layouts.nav')

@if (Session::has('message'))
    <div class="alert alert-{{ Session::get('status') }} text-center m-0" role="alert">
        {{ Session::get('message') }}
    </div>
@endif

<div class="banner d-flex justify-content-center align-items-center flex-column text-white">
    <h1 class="display-3">Brainster.xyz Labs</h1>
    <p>Проекти од академиите на Brainster</p>
</div>

<div class="container">
    @if (Session::has('user'))
        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="addProject-tab" data-bs-toggle="tab" data-bs-target="#addProject"
                    type="button" role="tab">Додај</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link  active" id="editProject-tab" data-bs-toggle="tab" data-bs-target="#editProject"
                    type="button" role="tab">Измени</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="addProject" role="tabpanel">
                <h3 class="my-2">Додај нов производ:</h3>
                <form action="{{ route('project.store') }}" method="POST" class="container">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Име</label>
                        <input type="text" class="form-control" id="title" name="title">
                        @error('title')
                            <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Поднаслов</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle">
                        @error('subtitle')
                            <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Слика</label>
                        <input type="url" class="form-control" id="image_url" name="image_url"
                            placeholder="http://">
                        @error('image_url')
                            <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="url" class="form-control" id="url" name="url" placeholder="http://">
                        @error('url')
                            <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Поднаслов</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        @error('description')
                            <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning">Додај</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade show active" id="editProject" role="tabpanel">
                <div class="row text-center">
                    @foreach ($projects as $project)
                        <div class="col-12 col-md-6 col-lg-4 p-4">
                            <div class="card">
                                <img src="{{ $project['image_url'] }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project['title'] }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $project['subtitle'] }}</h6>
                                    <p class="card-text">{{ $project['description'] }}</p>
                                    <a href="{{ $project['url'] }}" class="btn btn-primary">Visit Project</a>
                                    <a class="btn btn-warning" role="button" data-bs-toggle="modal"
                                        data-bs-target="#project{{ $project['id'] }}">Edit</a>
                                    <div class="modal fade" id="project{{ $project['id'] }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Измени проект:</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('project.update', $project) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Име</label>
                                                            <input type="text" class="form-control" id="title"
                                                                name="title" value="{{ $project['title'] }}">
                                                            @error('title')
                                                                <div class="alert alert-danger p-1">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="subtitle" class="form-label">Поднаслов</label>
                                                            <input type="text" class="form-control" id="subtitle"
                                                                name="subtitle" value="{{ $project['subtitle'] }}">
                                                            @error('subtitle')
                                                                <div class="alert alert-danger p-1">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image_url" class="form-label">Слика</label>
                                                            <input type="url" class="form-control" id="image_url"
                                                                name="image_url" placeholder="http://" value="{{ $project['image_url'] }}">
                                                            @error('image_url')
                                                                <div class="alert alert-danger p-1">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="url" class="form-label">URL</label>
                                                            <input type="url" class="form-control" id="url"
                                                                name="url" placeholder="http://" value="{{ $project['url'] }}">
                                                            @error('url')
                                                                <div class="alert alert-danger p-1">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description"
                                                                class="form-label">Поднаслов</label>
                                                            <textarea class="form-control" id="description" name="description">{{ $project['description'] }}</textarea>
                                                            @error('description')
                                                                <div class="alert alert-danger p-1">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="d-grid">
                                                            <button type="submit"
                                                                class="btn btn-warning">Измени</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="d-inline" action="{{ route('project.destroy', $project) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="row text-center">
            @foreach ($projects as $project)
                <div class="col-12 col-md-6 col-lg-4 p-4">
                    <div class="card">
                        <img src="{{ $project['image_url'] }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project['title'] }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $project['subtitle'] }}</h6>
                            <p class="card-text">{{ $project['description'] }}</p>
                            <a href="{{ $project['url'] }}" class="btn btn-warning">Visit Project</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@include('layouts.footer')
