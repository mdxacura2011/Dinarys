<?php
namespace Dinarys\Justin\Model\Resourse;

class Justin extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('justin_shipping_branches', 'justin_id');
    }

}