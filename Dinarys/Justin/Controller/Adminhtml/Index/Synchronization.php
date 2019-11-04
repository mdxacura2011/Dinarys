<?php
namespace Dinarys\Justin\Controller\Adminhtml\Index;

class Synchronization extends \Dinarys\Justin\Controller\Adminhtml\Index
{
    const ADMIN_RESOURCE = 'Dinarys_Justin::justin';
    const JUSTIN_RESOURCE = 'http://openapi.justin.ua/branches?output=compact';

    protected $curl;
    protected $forwardFactory;
    protected $justinFactory;
    protected $resourseJustin;
    protected $collectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory,
        \Dinarys\Justin\Model\JustinFactory $justinFactory,
        \Dinarys\Justin\Model\Resourse\Justin $resourseJustin,
        \Dinarys\Justin\Model\Resourse\Justin\CollectionFactory $collectionFactory
    ) {
        $this->curl = $curl;
        $this->forwardFactory = $forwardFactory;
        $this->justinFactory = $justinFactory;
        $this->resourseJustin = $resourseJustin;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->curl->get(self::JUSTIN_RESOURCE);
        if ($this->curl->getStatus() == 200) {
            $response = json_decode($this->curl->getBody(), true);
            $result = $response['result'];

            switch (true) {
                case $this->getCountItemsJustin() == 0:
                    $this->insertIntable($result);
                    break;
                case $this->getCountItemsJustin() == $this->countCurlItems($result):
                    break;
                case $this->countCurlItems($result)  >= $this->getCountItemsJustin():
                    // place for logic to update table
                    break;
            }
        }
        $resultPage = $this->forwardFactory->create();
        $resultPage->setModule('justin');
        $resultPage->setController('index');
        $resultPage->forward('index');
        return $resultPage;
    }

    private function getCountItemsJustin()
    {
        $collection = $this->collectionFactory->create();
        return $collection->count();
    }

    private function countCurlItems($items)
    {
        return count($items);
    }

    private function insertIntable($result)
    {
        if ($result) {
            foreach ($result as $values) {
                $justinModel = $this->justinFactory->create();
                $justinModel->setDeliveryBranchId($values['delivery_branch_id']);
                $justinModel->setFormat($values['format']);
                $justinModel->setFormat($values['format']);
                $justinModel->setSheduleDescription($values['shedule_description']);
                $justinModel->setDescription($values['description']);
                $justinModel->setadress($values['adress']);
                $this->resourseJustin->save($justinModel);
            }
        }
    }
}
