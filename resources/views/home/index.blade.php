@extends('layout')
@section('title', trans('home.title'))
@section('content')
<!-- Primary Page Layout –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <div class="container">
        <div class="row">
            <div class="four columns offset-by-four main-page" style="text-align: center">
                <h1>{{ trans('general.quraan') }}</h1>
            </div>


            <form>
                <div class="row">
                    <div class="twelve columns">
                        <input class="u-full-width search-item-margin" data-list="محمد, Java, JavaScript,سيد" id="search-input" data-url="{{ route('home.search') }}" type="text" placeholder="{{ trans('general.search') }}">
                        {!!  csrf_field() !!}
                    </div>

                </div>
            </form>



        </div>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/awesomplete.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('js/home_index.js') }}"></script>
@endsection