<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/pricing')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/blog')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/impressum')->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/datenschutz')->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap generated: public/sitemap.xml');
    }
}
