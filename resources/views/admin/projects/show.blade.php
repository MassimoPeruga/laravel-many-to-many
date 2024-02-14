@extends('layouts.admin')

@section('content')
    <div class="container pt-5">
        @include('shared.toast')
        <div class="card text-bg-dark">
            <div class="row g-0">
                @if ($project->img)
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $project->img) }}" class="img-fluid rounded-start"
                            alt="{{ $project['name'] }} image">
                    </div>
                @endif
                <div class=" {{ $project->img ? 'col-md-8' : 'col' }}">
                    <div class="card-header border-0 pb-0 d-flex">
                        <h2 class="me-auto pt-3">{{ $project['name'] }}</h2>
                        <div class="text-end row">
                            <div class="col-12">
                                <h5 class="card-title d-inline-block">
                                    <a href="{{ $project['repo_url'] }}" class="text-light">
                                        {{ $project['repository'] }}
                                    </a>
                                </h5>
                                @if ($project['is_public'])
                                    <span class="badge text-bg-success">Pubblica</span>
                                @else
                                    <span class="badge text-bg-secondary">Privata</span>
                                @endif
                            </div>
                            @if ($project->type)
                                <div class="col">
                                    Tipologia: {{ $project->type->title }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        @if (!$project->technologies->isEmpty())
                            <hr>
                            <div>
                                <h5>Tecnologie Usate:</h5>
                                <ul class="list-group list-group-horizontal-sm">
                                    @foreach ($project->technologies as $technology)
                                        <li class="list-group-item">{{ $technology->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (isset($project['assignment']))
                            <hr>
                            <p class="card-text pt-3 fs-5 border-0 text-start">
                                {{ $project['assignment'] }}
                            </p>
                        @endif

                        <hr>
                    </div>
                    <div class="card-footer text-light text-opacity-75 text-end  border-0">
                        Ultimo aggiornamento: {{ $project['updated_at'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex mt-3">
            <div class="me-auto">
                <a href="{{ route('admin.projects.index') }}" type="button" class="btn btn-info align-self-center">
                    Torna alla tabella principale
                </a>
            </div>
            <div>
                <a href="{{ route('admin.projects.edit', $project) }}" type="button" class="btn btn-warning me-2">
                    Modifica
                </a>
            </div>
            <div>
                <div class="col-12">
                    @include('shared.modal', [
                        'modalRoute' => 'admin.projects.destroy',
                        'itemToDelete' => "$project[slug]",
                        'itemName' => "$project[name]",
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
