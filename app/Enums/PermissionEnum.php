<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case VIEW_USER = 'view user';
    case ADD_USER = 'add user';
    case UPDATE_USER = 'update user';

    case VIEW_ADS_FB = 'view ads fb';
    case ADD_ADS_FB = 'add ads fb';
    case UPDATE_ADS_FB = 'update ads fb';

    case VIEW_ADS_GG = 'view ads gg';
    case ADD_ADS_GG = 'add ads gg';
    case UPDATE_ADS_GG = 'update ads gg';

    static function manageUser(): array
    {
        return [self::VIEW_USER->value, self::ADD_USER->value, self::UPDATE_USER->value];
    }

    static function manageAdsFB(): array
    {
        return [self::VIEW_ADS_FB->value, self::ADD_ADS_FB->value, self::UPDATE_ADS_FB->value];
    }

    static function manageAdsGG(): array
    {
        return [self::VIEW_ADS_GG->value, self::ADD_ADS_GG->value, self::UPDATE_ADS_GG->value];
    }

    static function all(): array
    {
        return [...self::manageUser(), ...self::manageAdsFB(), ...self::manageAdsGG()];
    }
}
