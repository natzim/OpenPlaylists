@extends('fluid')

@section('styles')
    <link rel="stylesheet" href="/css/welcome.css">
@stop

@section('stuff')
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>OpenPlaylists</h1>
                        <h3>A better way to listen to music</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="{{ route('playlists.index') }}" class="btn btn-default btn-lg btn-call-to-action">View Playlists</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Easy to use</h2>
                    <p class="lead">Just paste a link to the music. No complicated formatting.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="http://lorempixel.com/g/600/400/technics/1">
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Works everywhere</h2>
                    <p class="lead">Mobile, tablet and desktop!</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="http://lorempixel.com/g/600/400/technics/2">
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Everything is open</h2>
                    <p class="lead">Don't like a playlist, or want to change something? Just fork it and create your own unique version of it!</p>
                    <p>Talking about openness, our full source code is <a target="_blank" href="https://github.com/natzim/OpenPlaylists">available on GitHub</a>.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="http://lorempixel.com/g/600/400/technics/3">
                </div>
            </div>
        </div>
    </div>
@stop