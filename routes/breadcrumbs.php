<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::for('home', function (BreadcrumbsGenerator $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('login', function (BreadcrumbsGenerator $trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});


Breadcrumbs::for('register', function (BreadcrumbsGenerator $trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});


Breadcrumbs::for('password.request', function (BreadcrumbsGenerator $trail) {
    $trail->parent('login');
    $trail->push('Password request', route('password.request'));
});

Breadcrumbs::for('password_reset', function (BreadcrumbsGenerator $trail) {
    $trail->parent('password.request');
    $trail->push('Password reset', route('password.reset'));
});
