<?php
/**
 * NOTICE OF LICENSE
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author     Mediasur Labs GmbH
 * @license    See LICENSE.txt
 */

/** @var $installer Zookal_GShoppingV2_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

try {
    $collection = Mage::getModel('gshoppingv2/taxonomy')
        ->getCollection()
        ->addFieldToFilter('lang', array('eq' => 'de_De'));

    foreach ($collection as $taxonomy) {
        $taxonomy->delete();
    }

} catch (Exception $e) {
    Mage::log($e->getMessage(), Zend_Log::ERR);
}

$installer->endSetup();
