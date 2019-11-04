<?php

namespace Dinarys\Justin\Controller\Adminhtml;

abstract class Index extends \Magento\Backend\App\Action
{
    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Dinarys_Justin::justin')
            ->addBreadcrumb(__('Justin'), __('Justin'));
        return $resultPage;
    }
}
