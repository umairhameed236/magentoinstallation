<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Adminhtml
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_ConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * @magentoAppIsolation enabled
     */
    public function testGetGridJsObject()
    {
        Mage::register('current_product', new Varien_Object);
        /** @var $layout Mage_Core_Model_Layout */
        $layout = Mage::getModel('Mage_Core_Model_Layout');
        /** @var $block Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config */
        $block = $layout->createBlock('Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config', 'block');
        $this->assertEquals('super_product_linksJsObject', $block->getGridJsObject());
    }

    /**
     * @magentoAppIsolation enabled
     */
    public function testGetSelectedAttributes()
    {
        $productType = $this->getMock('stdClass', array('getUsedProductAttributes'));
        $product = $this->getMock('Varien_Object', array('getTypeInstance'));

        $product->expects($this->once())->method('getTypeInstance')->will($this->returnValue($productType));
        $productType->expects($this->once())->method('getUsedProductAttributes')->with($this->equalTo($product))
            ->will($this->returnValue(array('', 'a')));

        Mage::register('current_product', $product);
        $layout = Mage::getModel('Mage_Core_Model_Layout');
        $block = $layout->createBlock('Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config', 'block');
        $this->assertEquals(array(1 => 'a'), $block->getSelectedAttributes());
    }
}
