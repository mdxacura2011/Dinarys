<?php
namespace Dinarys\Justin\Block\Checkout;

class SomeProcessor
{

    protected $collectionFactory;

    public function __construct(
        \Dinarys\Justin\Model\Resourse\Justin\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }


    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $processor, $jsLayout)
    {
        $city = &$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['city'];

        if (isset($city)) {
            $city['component'] = 'Dinarys_Justin/js/form/element/abstract';
            $city['options'] = $this->getJustinCity();
        }

        return $jsLayout;
    }

    private function getJustinCity()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(['delivery_branch_id', 'adress']);
        $items = $collection->getItems();
        $result = [];
        foreach ($items as $item) {
            $result[] = ['name' => $item->getAdress(), 'code' => $item->getDeliveryBranchId()];
        }
        return json_encode($result);
    }
}