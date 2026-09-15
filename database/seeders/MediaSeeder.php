<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Reflects the gallery content added in "Fix broken gallery, populate
     * real project media" — 26 photos/videos sourced from the business's
     * Instagram and Facebook, organized under storage/app/public/media.
     * Expects the matching files to already exist on that disk.
     */
    public function run(): void
    {
        $items = [
            // Stone
            ['title' => 'Премахване на графити от фасада', 'description' => 'Лазерно почистване на графити от фасада на сграда, без увреждане на каменната повърхност.', 'file_path' => 'media/images/stone/graffiti-ac-wall.jpg', 'type' => 'image', 'category' => 'stone', 'is_featured' => true, 'display_order' => 0],
            ['title' => 'Почистване на надгробен паметник', 'description' => 'Възстановяване на мраморен паметник — премахване на години наслоена патина и замърсяване.', 'file_path' => 'media/images/stone/gravestone-bust.jpg', 'type' => 'image', 'category' => 'stone', 'is_featured' => true, 'display_order' => 1],
            ['title' => 'Премахване на графити от каменна фасада', 'description' => 'Прецизно почистване на релефна каменна облицовка, засегната от спрей графити.', 'file_path' => 'media/images/stone/graffiti-facade-diagonal.jpg', 'type' => 'image', 'category' => 'stone', 'is_featured' => true, 'display_order' => 2],
            ['title' => 'Възстановяване на надгробен релеф', 'description' => 'Лазерно почистване на скулптуран надгробен паметник с двоен релефен портрет.', 'file_path' => 'media/images/stone/gravestone-double-relief.jpg', 'type' => 'image', 'category' => 'stone', 'is_featured' => false, 'display_order' => 3],
            ['title' => 'Почистване на графити от входна фасада', 'description' => 'Премахване на графити около вход на сграда без химикали и без увреждане на камъка.', 'file_path' => 'media/images/stone/graffiti-entrance-wall.jpg', 'type' => 'image', 'category' => 'stone', 'is_featured' => false, 'display_order' => 4],
            ['title' => 'Премахване на петна от масло от настилка', 'description' => 'Лазерно почистване на упорити маслени петна от бетонни павета.', 'file_path' => 'media/images/stone/pavement-oil-stain.jpg', 'type' => 'image', 'category' => 'stone', 'is_featured' => false, 'display_order' => 5],
            ['title' => 'Почистване на графити от паметна плоча', 'description' => 'Възстановяване на фасада с паметна плоча, засегната от вандализъм.', 'file_path' => 'media/images/stone/graffiti-memorial-wall.jpg', 'type' => 'image', 'category' => 'stone', 'is_featured' => false, 'display_order' => 6],
            ['title' => 'Лазерно почистване на камък в действие', 'description' => 'Видео демонстрация на процеса на лазерно почистване на каменна повърхност.', 'file_path' => 'media/videos/stone/stone-cleaning-process.mp4', 'type' => 'video', 'category' => 'stone', 'is_featured' => true, 'display_order' => 7],
            ['title' => 'Почистване на каменна резба', 'description' => 'Лазерно почистване на замърсена декоративна каменна резба.', 'file_path' => 'media/videos/stone/stone-relief-carving-cleaning.mp4', 'type' => 'video', 'category' => 'stone', 'is_featured' => false, 'display_order' => 8],
            ['title' => 'Премахване на спрей графити от бетон', 'description' => 'Лазерно премахване на спрей боя от бетонна повърхност в реално време.', 'file_path' => 'media/videos/stone/stone-graffiti-spray-removal.mp4', 'type' => 'video', 'category' => 'stone', 'is_featured' => true, 'display_order' => 9],
            ['title' => 'Екипът на LasePro в действие', 'description' => 'Премахване на графити от стена от нашия екип на място.', 'file_path' => 'media/videos/stone/stone-wall-graffiti-technician.mp4', 'type' => 'video', 'category' => 'stone', 'is_featured' => true, 'display_order' => 10],

            // Metal
            ['title' => 'Възстановяване на бронзови крака на маса', 'description' => 'Лазерно почистване на бронзовите крака на антична маса с мраморен плот — извършено на място.', 'file_path' => 'media/images/metal/marble-table-legs-after.jpg', 'type' => 'image', 'category' => 'metal', 'is_featured' => true, 'display_order' => 0],
            ['title' => 'Бронзови крака преди почистване', 'description' => 'Оксидирали бронзови елементи на антична мебел преди лазерна обработка.', 'file_path' => 'media/images/metal/marble-table-legs-before.jpg', 'type' => 'image', 'category' => 'metal', 'is_featured' => false, 'display_order' => 1],
            ['title' => 'Детайл на бронзов крак след почистване', 'description' => 'Оригиналният блясък на бронза, възстановен без абразивно въздействие.', 'file_path' => 'media/images/metal/bronze-legs-after.jpg', 'type' => 'image', 'category' => 'metal', 'is_featured' => true, 'display_order' => 2],
            ['title' => 'Бронзови детайли преди възстановяване', 'description' => 'Потъмнели бронзови мебелни крака преди лазерно почистване.', 'file_path' => 'media/images/metal/bronze-legs-before.jpg', 'type' => 'image', 'category' => 'metal', 'is_featured' => false, 'display_order' => 3],
            ['title' => 'Възстановяване на бронзова брава-лъвска глава', 'description' => 'Лазерно премахване на патина от декоративна бронзова брава във формата на лъв.', 'file_path' => 'media/images/metal/lion-door-knocker.jpg', 'type' => 'image', 'category' => 'metal', 'is_featured' => true, 'display_order' => 4],
            ['title' => 'Детайл на метална повърхност', 'description' => 'Прецизно почистване на метален механичен компонент.', 'file_path' => 'media/images/metal/gear-detail.png', 'type' => 'image', 'category' => 'metal', 'is_featured' => false, 'display_order' => 5],
            ['title' => 'Премахване на ръжда от инструмент', 'description' => 'Лазерно почистване на ръждясал режещ инструмент.', 'file_path' => 'media/videos/metal/metal-rusty-saw-blade.mp4', 'type' => 'video', 'category' => 'metal', 'is_featured' => false, 'display_order' => 6],
            ['title' => 'Възстановяване на бронзова саксия с лъвска глава', 'description' => 'Лазерно почистване на голям бронзов съд с декоративна дръжка във формата на лъв.', 'file_path' => 'media/videos/metal/metal-copper-urn-lion-head.mp4', 'type' => 'video', 'category' => 'metal', 'is_featured' => false, 'display_order' => 7],
            ['title' => 'Премахване на ръжда от арматура', 'description' => 'Лазерно почистване на ръждясала строителна арматура до чист метал.', 'file_path' => 'media/videos/metal/metal-rebar-rust-removal.mp4', 'type' => 'video', 'category' => 'metal', 'is_featured' => true, 'display_order' => 8],

            // Wood
            ['title' => 'Възстановена дървена резба', 'description' => 'Детайл от антична резбована дървена мебел след лазерно почистване — без химикали, без повреди.', 'file_path' => 'media/images/wood/carved-wood-detail.png', 'type' => 'image', 'category' => 'wood', 'is_featured' => true, 'display_order' => 0],
            ['title' => 'Лазерно почистване на дърво в действие', 'description' => 'Видео демонстрация на процеса на лазерно почистване на дървена повърхност.', 'file_path' => 'media/videos/wood/wood-cleaning-process.mp4', 'type' => 'video', 'category' => 'wood', 'is_featured' => true, 'display_order' => 1],
            ['title' => 'Лазерно почистване на дървени дъски', 'description' => 'Прецизно почистване на дървена повърхност без химикали и без повреди.', 'file_path' => 'media/videos/wood/wood-plank-cleaning-intro.mp4', 'type' => 'video', 'category' => 'wood', 'is_featured' => false, 'display_order' => 2],
            ['title' => 'Почистване на дървена тераса', 'description' => 'Лазерно почистване на замърсена дървена терасна дъска.', 'file_path' => 'media/videos/wood/wood-deck-cleaning.mp4', 'type' => 'video', 'category' => 'wood', 'is_featured' => true, 'display_order' => 3],
            ['title' => 'Възстановяване на дървена рамка', 'description' => 'Лазерно почистване на декоративна дървена рамка със златист кант.', 'file_path' => 'media/videos/wood/wood-picture-frame-restoration.mp4', 'type' => 'video', 'category' => 'wood', 'is_featured' => false, 'display_order' => 4],
            ['title' => 'Детайл на резбован дървен сандък', 'description' => 'Лазерно почистване на антична резбована дървена ракла.', 'file_path' => 'media/videos/wood/wood-carved-chest-detail.mp4', 'type' => 'video', 'category' => 'wood', 'is_featured' => false, 'display_order' => 5],
        ];

        foreach ($items as $item) {
            Media::create($item + [
                'is_published' => true,
                'uploaded_by_user_id' => null,
            ]);
        }
    }
}
