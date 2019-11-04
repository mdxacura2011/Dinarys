<?php
namespace Dinarys\Justin\Model\Provider;

use Magento\Checkout\Model\ConfigProviderInterface;

class JustinConfigProvider implements ConfigProviderInterface
{
    protected $collectionFactory;

    public function __construct(
        \Dinarys\Justin\Model\Resourse\Justin\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getConfig()
    {
        return $this->getJustinCity();
    }

    private function getJustinCity()
    {
        $config = [];
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(['delivery_branch_id', 'adress']);
        $items = $collection->getItems();
        $result = [];
        foreach ($items as $item) {
            $result[] = ['adress' => $item->getAdress(), 'code' => $item->getDeliveryBranchId()];
        }
        $config['cityData'] = $result;
        return $config;
    }
}