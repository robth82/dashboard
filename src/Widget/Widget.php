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
    private $ajaxLoad;
    private $refreshInterval;
    private $userOptions;
    private $refreshAction;
    private $closeAction;

    function __construct(array $options)
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);

        $this->content = $this->options['content'];
        $this->title = $this->options['title'];
        $this->ajaxLoad = $this->options['ajaxLoad'];
        $this->refreshInterval = $this->options['refreshInterval'];
        $this->refreshAction = $this->options['refreshAction'];
        $this->closeAction = $this->options['closeAction'];

        $this->setName('normal');
        $this->setUniqid(uniqid('db_'));
    }

    public function setUserOptions(array $options = array())
    {
        $resolver = new OptionsResolver();
        $this->configureUserOptions($resolver);
        $this->userOptions = $resolver->resolve($options);
    }

    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        // ... configure the resolver, you will learn this
        // in the sections below
        $resolver->setDefaults(array(
            'content' => '',
            'ajaxLoad' => false,
            'refreshInterval' => 0,
            'refreshAction' => false,
            'closeAction' => true
        ));

        $resolver->setRequired(array('title'));
    }

    protected function configureUserOptions(OptionsResolverInterface $resolver)
    {

    }

    public function prepare()
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
        $this->prepare();
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
    public function setUniqid($uniqid)
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

    /**
     * @param mixed $ajaxLoad
     */
    public function setAjaxLoad($ajaxLoad)
    {
        $this->ajaxLoad = $ajaxLoad;
    }

    /**
     * @return mixed
     */
    public function getAjaxLoad()
    {
        return $this->ajaxLoad;
    }

    /**
     * @param mixed $refreshInterval
     */
    public function setRefreshInterval($refreshInterval)
    {
        $this->refreshInterval = $refreshInterval;
    }

    /**
     * @return mixed
     */
    public function getRefreshInterval()
    {
        return $this->refreshInterval;
    }

    /**
     * @return mixed
     */
    public function getCloseAction()
    {
        return $this->closeAction;
    }

    /**
     * @param mixed $closeAction
     */
    public function setCloseAction($closeAction)
    {
        $this->closeAction = $closeAction;
    }

    /**
     * @return mixed
     */
    public function getRefreshAction()
    {
        return $this->refreshAction;
    }

    /**
     * @param mixed $refreshAction
     */
    public function setRefreshAction($refreshAction)
    {
        $this->refreshAction = $refreshAction;
    }




}