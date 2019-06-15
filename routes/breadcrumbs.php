<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use \App\Entity\User;

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

Breadcrumbs::for('password.reset', function (BreadcrumbsGenerator $trail) {
    $trail->parent('password.request');
    $trail->push('Password reset', route('password.reset'));
});

Breadcrumbs::for('cabinet', function (BreadcrumbsGenerator $trail) {
    $trail->parent('home');
    $trail->push('Cabinet', route('cabinet'));
});

// Admin
Breadcrumbs::for('admin.home', function (BreadcrumbsGenerator $trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.home'));
});

Breadcrumbs::for('admin.users.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.home');
    $trail->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Users create', route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', function (BreadcrumbsGenerator $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::for('admin.users.edit', function (BreadcrumbsGenerator $trail, User $user) {
    $trail->parent('admin.users.show', $user);
    $trail->push('Edit', route('admin.users.edit', $user));
});

//End Admin
