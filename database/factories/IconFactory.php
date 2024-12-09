<?php

namespace Database\Factories;

use App\Models\Icon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Icon>
 */
class IconFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Icon::class;
    public function definition(): array
    {

        return [ ];

    }
    public function insertAll()
    {
        $fontAwesomeIcons = [
            'fa-house' => 'Home',
            'fa-user' => 'User',
            'fa-gear' => 'Settings',
            'fa-envelope' => 'Envelope',
            'fa-star' => 'Star',
            'fa-heart' => 'Heart',
            'fa-camera' => 'Camera',
            'fa-bell' => 'Bell',
            'fa-cart-shopping' => 'Shopping Cart',
            'fa-book' => 'Book',
            'fa-cloud' => 'Cloud',
            'fa-tools' => 'Tools',
            'fa-smile' => 'Smile',
            'fa-link' => 'Link',
            'fa-bicycle' => 'Bicycle',
            'fa-plane' => 'Plane',
            'fa-key' => 'Key',
            'fa-comments' => 'Comments',
            'fa-trash' => 'Trash',
            'fa-database' => 'Database',
            'fa-lock' => 'Lock',
            'fa-arrow-up-from-bracket' => 'Arrow Up',
            'fa-arrow-right' => 'Arrow Right',
            'fa-arrow-left' => 'Arrow Left',
            'fa-arrow-down' => 'Arrow Down',
            'fa-flag' => 'Flag',
            'fa-file' => 'File',
            'fa-user-group' => 'User Group',
            'fa-chart-line' => 'Chart',
            'fa-cloud-showers' => 'Cloud Showers',
            'fa-bullseye' => 'Bullseye',
            'fa-handshake' => 'Handshake',
            'fa-shield' => 'Shield',
            'fa-paintbrush' => 'Paintbrush',
            'fa-battery-three-quarters' => 'Battery',
            'fa-globe' => 'Globe',
            'fa-phone' => 'Phone',
            'fa-heart-circle-check' => 'Heart Check',
            'fa-lightbulb' => 'Lightbulb',
            'fa-pencil' => 'Pencil',
            'fa-anchor' => 'Anchor',
            'fa-hammer' => 'Hammer',
            'fa-chart-bar' => 'Bar Chart',
            'fa-chart-pie' => 'Pie Chart',
            'fa-chart-simple' => 'Simple Chart',
            'fa-bullhorn' => 'Bullhorn',
            'fa-broom' => 'Broom',
            'fa-building' => 'Building',
            'fa-bus' => 'Bus',
            'fa-calendar' => 'Calendar',
            'fa-camera-retro' => 'Retro Camera',
            'fa-caret-down' => 'Caret Down',
            'fa-caret-up' => 'Caret Up',
            'fa-caret-left' => 'Caret Left',
            'fa-caret-right' => 'Caret Right',
            'fa-clipboard' => 'Clipboard',
            'fa-cloud-upload' => 'Cloud Upload',
            'fa-cloud-download' => 'Cloud Download',
            'fa-comments-dollar' => 'Dollar Comments',
            'fa-crown' => 'Crown',
            'fa-dog' => 'Dog',
            'fa-dove' => 'Dove',
            'fa-ellipsis' => 'Ellipsis',
            'fa-envelope-open' => 'Envelope Open',
            'fa-eraser' => 'Eraser',
            'fa-exclamation' => 'Exclamation',
            'fa-external-link' => 'External Link',
            'fa-flag-checkered' => 'Flag Checkered',
            'fa-gamepad' => 'Gamepad',
            'fa-gift' => 'Gift',
            'fa-glasses' => 'Glasses',
            'fa-hand-point-up' => 'Hand Point Up',
            'fa-hand-point-down' => 'Hand Point Down',
            'fa-hand-point-left' => 'Hand Point Left',
            'fa-hand-point-right' => 'Hand Point Right',
            'fa-headset' => 'Headset',
            'fa-hourglass' => 'Hourglass',
            'fa-keyboard' => 'Keyboard',
            'fa-lightbulb-on' => 'Lightbulb On',
            'fa-map' => 'Map',
            'fa-map-marker' => 'Map Marker',
            'fa-plane-departure' => 'Plane Departure',
            'fa-random' => 'Random',
            'fa-smile-beam' => 'Smile Beam',
            'fa-trailer' => 'Trailer',
            'fa-trash-arrow-up' => 'Trash Arrow Up',
            'fa-trailer' => 'Trailer',
            'fa-umbrella' => 'Umbrella',
            'fa-university' => 'University',
            'fa-vehicle' => 'Vehicle',
            'fa-volume-high' => 'Volume High',
            'fa-volume-mute' => 'Volume Mute',
        ];


        foreach ($fontAwesomeIcons as $iconCode => $iconName) {
            Icon::create([
                'name' => $iconCode,
                'icon' => $iconName,
            ]);
        }
    }
}
