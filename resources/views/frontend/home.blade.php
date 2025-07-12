@extends('frontend.layouts.master')
@section('title')
    News Portal | Home page
@endsection
@section('content')
        <!-- Tranding news  carousel-->
    @include('frontend.home-components.tending-news')
    <!-- End Tranding news carousel -->

    <!-- Popular news -->
    <section>
        <!-- hero section news  header-->
        @include('frontend.home-components.hero-section')
        <!-- End Popular news header-->

        <!-- hero section  news carousel -->
        @include('frontend.home-components.carousel-hero-section')
        <!-- End Popular news carousel -->
        
    </section>
    <!-- End Popular news -->

    <!-- large banner -->
    @include('frontend.home-components.large-banner')

    <!-- main Popular news category -->
    @include('frontend.home-components.main-news')
    <!-- End Popular news category -->
@endsection