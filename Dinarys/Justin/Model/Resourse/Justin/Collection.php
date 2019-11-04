<?php
namespace Dinarys\Justin\Model\Resourse\Justin;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Dinarys\Justin\Model\Justin::class,
            \Dinarys\Justin\Model\Resourse\Justin::class
        );
    }
}