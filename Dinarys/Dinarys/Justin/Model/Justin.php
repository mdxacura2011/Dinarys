<?php
namespace Dinarys\Justin\Model;

class Justin extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init(\Dinarys\Justin\Model\Resourse\Justin::class);
    }

}