<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 29-10-14
 * Time: 22:09
 */

namespace Robth82\Dashboard\Widget;


use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PieChartWidget extends Widget
{
    private $titleLong;
    private $data;

    function __construct(array $options)
    {
        parent::__construct($options);
        $this->setName('piechart');
        $this->titleLong = $this->options['titleLong'];

        $this->setData($options['data']);
        $this->setRefreshInterval(30);
    }

    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setRequired(array('titleLong', 'data'));

    }

    /**
     * @param mixed $titleLong
     */
    public function setTitleLong($titleLong)
    {
        $this->titleLong = $titleLong;
    }

    /**
     * @return mixed
     */
    public function getTitleLong()
    {
        return $this->titleLong;
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