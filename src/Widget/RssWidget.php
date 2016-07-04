<?php
/**
 * Created by PhpStorm.
 * User: RobterHaar
 * Date: 28-6-2016
 * Time: 07:20
 */

namespace Robth82\Dashboard\Widget;


use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RssWidget extends Widget {

    private $url;

    function __construct(array $options)
    {
        parent::__construct($options);
        $this->setName('rss');

        $this->setUrl($options['url']);

        $this->setAjaxLoad(true);
    }

    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'refreshInterval' => 300,
        ]);
        $resolver->setRequired(array('url'));
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getContent()
    {
        if($this->isRefresh()) {
            return $this->getRssfeed();
        }
    }

    public function getRssfeed() {
        $feed = new \SimplePie();
        $feed->set_feed_url($this->getUrl());
        $feed->enable_cache(false);

        $feed->init();
        $feed->handle_content_type();

//        var_dump($feed->error());
        $content = '';
        foreach($feed->get_items() as $item) {
//            $content .= '<hr>';
//            var_dump();

            if ($enclosure = $item->get_enclosure(0))
            {
                if ($enclosure->get_thumbnail())
                {
                    $content .= '<div style="float:left"><img height="20" src="' . $enclosure->get_thumbnail() . '" alt="" /></div>';
                }

            }
            $content .= '<div style="float:left">';
            $content .= '<a target="_blank" href="'.$item->get_link(0).'">' . $item->get_title() . '</a>';
//            $content .= '</br>';
//    echo $item->get_description();
//            $content .= $item->get_description(true);
            $content .= '</div>';
            $content .= '<div style="clear: both"></div>';

        }
        return $content;
    }


}