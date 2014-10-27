<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 20-10-14
 * Time: 22:28
 */

namespace Robth82\Dashboard\Widget;


use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Widget
{
    private $uniqid;
    private $name;
    private $description;
    private $title;
    private $content;
    protected $options;

    function __construct(array $options)
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);

        $this->content = $this->options['content'];
        $this->title = $this->options['title'];
        $this->setName('normal');
        $this->setUniqid(uniqid('db_'));
    }

    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        // ... configure the resolver, you will learn this
        // in the sections below
        $resolver->setDefaults(array(
            'content' => '',
        ));
        $resolver->setRequired(array('title'));
    }

    public function render()
    {
        // can be implemented
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $uniqid
     */
    private function setUniqid($uniqid)
    {
        $this->uniqid = $uniqid;
    }

    /**
     * @return mixed
     */
    public function getUniqid()
    {
        return $this->uniqid;
    }


}