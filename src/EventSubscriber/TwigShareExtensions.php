<?php
namespace App\EventSubscriber;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use SocialLinks\Page;

class TwigShareExtensions extends AbstractExtension
{
    public function getFilters()
    {
        return [new TwigFilter('share',[$this,'socialsPage'],['is_safe'=>['html']])];
    }

    public function socialsPage($url,$title): string{
        $page = new Page([
            'url' => "https://legermain.tom-lefrere.fr".$url,
            'title' => $title." sur le site de ",
            'text' => 'Incroyable !'
        ]);
        $socials = '<a href="'.$page->facebook->shareUrl.'">Facebook</a>'." ".'<a href="'.$page->twitter->shareUrl.'">Twitter</a>'." ".'<a href="'.$page->pinterest->shareUrl.'">Pinterest</a>';

        return $socials;
}
}