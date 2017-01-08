<?php

namespace App\Jobs;

use App\Soraah;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\DomCrawler\Crawler;

class ImportQuraanJob implements ShouldQueue
{
    /**
     * Execute the job.
     *
     * @return boolean
     */
    public function handle()
    {
        list($title, $contentList) = $this->getSoraaTitleAndContent(getenv('CRAWLER_SITE'));

        /** BAD we should use bulk insert, but we will do that one time for now so whatever */
        foreach ($title as $index => $row) {
            $sora = Soraah::updateOrCreate([
                'name'        => $row,
                'ayaat_count' => count($contentList[$index]),
            ]);

            foreach ($contentList[$index] as $key => $content) {
                $sora->ayaat()->updateOrCreate([
                    'text'    => $content,
                    'number'  => $key + 1,
                ]);
            }
        }

    }


    /**
     * @param $text
     *
     * @return mixed
     */
    private function fetchSoraaTitle($text)
    {
        $text = trim(preg_replace('/( |)|(نص مكتوب ومطبوع)|(قراءه سورة)/', '', $text));
        return str_replace('|', '', $text);
    }

    /**
     * Fetch Soraa Title
     *
     * @param $url
     *
     * @return Crawler $crawler
     */
    private function websiteToImportFrom($url)
    {
        $pageHtml = file_get_contents($url);
        $crawler  = new Crawler($pageHtml);

        return $crawler;
    }

    /**
     * Fetch Soraa Content
     *
     * @param string $quraanAyaat
     *
     * @return array $text
     */
    private function fetchSoraaContent($quraanAyaat)
    {
        foreach ($quraanAyaat as $quraanAyaah) {
            $text[] = $quraanAyaah->textContent;
        }

        return $text;
    }

    /**
     * @param $url
     *
     * @return array
     */
    public function getSoraaTitleAndContent($url)
    {

        $i = 1;

        while($i <= 114) {
            $crawler                = $this->websiteToImportFrom($url . 'read-' . $i . '.html');
            $soraTitle[]            = $this->fetchSoraaTitle($crawler->filter('title')->text());
            $quraanAyaat[]          = $this->fetchSoraaContent($crawler->filter('p[id=read] > a'));
            $i                      = ++$i;
        }

        return [$soraTitle, $quraanAyaat];
    }
}
