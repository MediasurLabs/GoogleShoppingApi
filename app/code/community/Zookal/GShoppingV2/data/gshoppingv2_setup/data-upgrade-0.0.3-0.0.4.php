<?php
/** @var $installer Zookal_GShoppingV2_Model_Resource_Setup */
$installer = $this;

/** @var Magento_Db_Adapter_Pdo_Mysql $connection */
$connection = $installer->getConnection();

$collection = Mage::getModel('gshoppingv2/taxonomy')
    ->getCollection()
    ->addFieldToFilter('lang', array('eq' => 'de_De'));

foreach ($collection as $taxonomy) {
    $taxonomy->delete();
}
    
foreach ($installer->getTaxonomies2() as $lang => $taxonomies) {
    $data = [];
    foreach ($taxonomies as $taxonomy) {
        $taxonomy = explode(" - ", $taxonomy);
        $i = $taxonomy[0];
        $t = rtrim($taxonomy[1]);
        $data[] = [$i, $lang, $t];
    }

    $connection->insertArray(
        $this->getTable('gshoppingv2/taxonomies'),
        ['lang_idx', 'lang', 'name'],
        $data
    );
}
