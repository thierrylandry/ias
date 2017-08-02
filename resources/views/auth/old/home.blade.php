@extends('layouts.old.ias')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>

        <div class="collection">
            <a href="#!" class="collection-item"><span class="badge">1</span>Alan</a>
            <a href="#!" class="collection-item"><span class="new badge">4</span>Alan</a>
            <a href="#!" class="collection-item">Alan</a>
            <a href="#!" class="collection-item"><span class="badge">14</span>Alan</a>
        </div>

        Badges in Dropdown
        Dropdown



        <ul id="dropdown2" class="dropdown-content">
            <li><a href="#!">one<span class="badge">1</span></a></li>
            <li><a href="#!">two<span class="new badge">1</span></a></li>
            <li><a href="#!">three</a></li>
        </ul>
        <a class="btn dropdown-button" href="#!" data-activates="dropdown2">Dropdown<i class="mdi-navigation-arrow-drop-down right"></i></a>

        Badges in Navbar
        Logo
        sass
        sass 4
        sass


        <nav>
            <div class="nav-wrapper">
                <a href="" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="">sass</a></li>
                    <li><a href="">sass <span class="new badge">4</span></a></li>
                    <li><a href="">sass</a></li>
                </ul>
            </div>
        </nav>
        Badges in Collapsibles
        4
        filter_drama
        First
        1
        place
        Second


        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header"><span class="new badge">4</span><i class="material-icons">filter_drama</i>First</div>
                <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
            </li>
            <li>
                <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">place</i>Second</div>
                <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
            </li>
        </ul>
        Options
        You can customize captions in many ways.
        Custom Caption
        Custom Badge Captions
        4
        Custom Badge Captions
        4
        You can explicitly set the caption in a badge using the data-badge-caption attribute.

        <span class="new badge" data-badge-caption="custom caption">4</span>
        <span class="badge" data-badge-caption="custom caption">4</span>

        Couleurs
        Red
        4
        Blue
        4
        You can use our color classes to set the background-color of the badge.

        <span class="new badge red">4</span>
        <span class="new badge blue">4</span>


        Push code. Find bugs. Release fixes. Repeat. CI/CD teams love to use.
        ads via Carbon
        Collections
        Dropdown
        Navbar
        Collapsible
        Options
        Aider Materialize à grandir
        We hope you have enjoyed using Materialize! If you feel Materialize has helped you out and want to support the team, send us over a donation! Any amount would help support and continue development on this project and is greatly appreciated.
        Faire un don
        Rejoindre la discussion
        We have a Gitter chat room set up where you can talk directly with us. Come in and discuss new features, future goals, general problems or questions, or anything else you can think of.
        Chat
        Connectez



        © 2014-2017 Materialize, All rights reserved.
        MIT License
        Français



    </div>
</div>
@endsection
