<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 20-4-2015
 * Time: 20:35
 */

namespace Robth82\Dashboard\Widget;


use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DataWidget extends Widget {

    private $data;

    function __construct(array $options)
    {
        parent::__construct($options);
        $this->setName('dataWidget');

        $this->setData($options['data']);
        $this->setRefreshInterval(30);
    }

    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setRequired(array('data'));
    }

    protected function configureUserOptions(OptionsResolverInterface $resolver)
    {
        parent::configureUserOptions($resolver);

        $resolver->setAllowedValues(['mode' => ['table', 'graph', 'pie', 'bar']]);

        $resolver->setDefaults([
            'mode' => 'table'
        ]);
    }


    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


}