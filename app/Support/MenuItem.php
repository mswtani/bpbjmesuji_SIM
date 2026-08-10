<?php

namespace App\Support;

class MenuItem
{
    public string $title;

    public string $icon;

    public string $route;

    public array $roles;

    public function __construct(
        string $title,
        string $icon,
        string $route,
        array $roles = []
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = $route;
        $this->roles = $roles;
    }
}