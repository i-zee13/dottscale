@extends('layouts.cms')
@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .section {
            padding: 100px;
            text-align: center;
            background-color: #f5f5f5;
            margin-bottom: 20px;
        }
    </style>
    <h1 style="text-align:center; padding-top:50px;">AOS Animations Demo</h1>

    <div class="section" data-aos="fade-up">
        <h2>Fade Up</h2>
    </div>

    <div class="section" data-aos="fade-down">
        <h2>Fade Down</h2>
    </div>

    <div class="section" data-aos="fade-right">
        <h2>Fade Right</h2>
    </div>

    <div class="section" data-aos="fade-left">
        <h2>Fade Left</h2>
    </div>

    <div class="section" data-aos="flip-left">
        <h2>Flip Left</h2>
    </div>

    <div class="section" data-aos="flip-right">
        <h2>Flip Right</h2>
    </div>

    <div class="section" data-aos="zoom-in">
        <h2>Zoom In</h2>
    </div>

    <div class="section" data-aos="zoom-out">
        <h2>Zoom Out</h2>
    </div>

    <div class="section" data-aos="slide-up">
        <h2>Slide Up</h2>
    </div>

    <div class="section" data-aos="slide-down">
        <h2>Slide Down</h2>
    </div>

    <div class="section" data-aos="slide-right">
        <h2>Slide Right</h2>
    </div>

    <div class="section" data-aos="slide-left">
        <h2>Slide Left</h2>
    </div>

    <div class="section" data-aos="flip-up">
        <h2>Flip Up</h2>
    </div>

    <div class="section" data-aos="flip-down">
        <h2>Flip Down</h2>
    </div>

    @endsection 