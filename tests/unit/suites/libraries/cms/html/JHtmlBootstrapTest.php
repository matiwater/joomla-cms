<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once __DIR__ . '/stubs/JHtmlBootstrapInspector.php';
require_once __DIR__ . '/stubs/JHtmlJqueryInspector.php';

/**
 * Test class for JHtmlBootstrap.
 * Generated by PHPUnit on 2012-08-16 at 17:39:35.
 */
class JHtmlBootstrapTest extends TestCase
{
	/**
	 * Backup of the SERVER superglobal
	 *
	 * @var    array
	 * @since  3.1
	 */
	protected $backupServer;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	protected function setUp()
	{
		// Ensure the loaded states are reset
		JHtmlBootstrapInspector::resetLoaded();
		JHtmlJqueryInspector::resetLoaded();

		parent::setUp();

		$this->saveFactoryState();

		JFactory::$application = $this->getMockCmsApp();
		JFactory::$document = $this->getMockDocument();

		$this->backupServer = $_SERVER;

		$_SERVER['HTTP_HOST'] = 'example.com';
		$_SERVER['SCRIPT_NAME'] = '';
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	protected function tearDown()
	{
		$_SERVER = $this->backupServer;

		$this->restoreFactoryState();

		parent::tearDown();
	}

	/**
	 * Tests the alert method.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testAlert()
	{
		// Initialise the alert script
		JHtmlBootstrap::alert();

		// Get the document instance
		$document = JFactory::getDocument();

		$this->assertArrayHasKey(
			'/media/jui/js/bootstrap.min.js',
			$document->_scripts,
			'Verify that the alert method initialises Bootstrap as well'
		);

		$this->assertEquals(
			$document->_script['text/javascript'],
			"(function($){" . PHP_EOL . "\t\t\t\t$('.alert').alert();" . PHP_EOL . "\t\t\t\t})(jQuery);",
			'Verify that the alert script is initialised'
		);
	}

	/**
	 * Tests the button method.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testButton()
	{
		// Initialise the alert script
		JHtmlBootstrap::button();

		// Get the document instance
		$document = JFactory::getDocument();

		$this->assertArrayHasKey(
			'/media/jui/js/bootstrap.min.js',
			$document->_scripts,
			'Verify that the button method initialises Bootstrap as well'
		);

		$this->assertEquals(
			$document->_script['text/javascript'],
			"(function($){" . PHP_EOL . "\t\t\t\t$('.button').button();" . PHP_EOL . "\t\t\t\t})(jQuery);",
			'Verify that the button script is initialised'
		);
	}

	/**
	 * Tests the dropdown method.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testDropdown()
	{
		// Initialise the dropdown script
		JHtmlBootstrap::dropdown();

		// Get the document instance
		$document = JFactory::getDocument();

		$this->assertArrayHasKey(
			'/media/jui/js/bootstrap.min.js',
			$document->_scripts,
			'Verify that the dropdown method initialises Bootstrap as well'
		);

		$this->assertEquals(
			$document->_script['text/javascript'],
			"(function($){" . PHP_EOL . "\t\t\t\t$('.dropdown-toggle').dropdown();" . PHP_EOL . "\t\t\t\t})(jQuery);",
			'Verify that the dropdown script is initialised'
		);
	}

	/**
	 * Tests the framework method.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testFramework()
	{
		// Initialise the Bootstrap JS framework
		JHtmlBootstrap::framework();

		// Get the document instance
		$document = JFactory::getDocument();

		$this->assertArrayHasKey(
			'/media/jui/js/jquery.min.js',
			$document->_scripts,
			'Verify that Bootstrap initializes jQuery as well'
		);

		$this->assertArrayHasKey(
			'/media/jui/js/bootstrap.min.js',
			$document->_scripts,
			'Verify that Bootstrap initializes Bootstrap'
		);
	}

	/**
	 * Tests the endAccordion method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testEndAccordion()
	{
		$this->assertThat(
			JHtml::_('bootstrap.endAccordion'),
			$this->equalTo('</div>')
		);
	}

	/**
	 * Tests the endSlide method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testEndSlide()
	{
		$this->assertThat(
			JHtml::_('bootstrap.endSlide'),
			$this->equalTo('</div></div></div>')
		);
	}

	/**
	 * Tests the endTabSet method
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testEndTabSet()
	{
		$this->assertEquals(
			JHtml::_('bootstrap.endTabSet'),
			PHP_EOL . "</div>"
		);
	}

	/**
	 * Tests the endTab method
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testEndTab()
	{
		$this->assertEquals(
			JHtml::_('bootstrap.endTab'),
			PHP_EOL . "</div>"
		);
	}

	/**
	 * Tests the endPane method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testEndPane()
	{
		$this->assertEquals(
			JHtml::_('bootstrap.endTabSet'),
			PHP_EOL . "</div>"
		);
	}

	/**
	 * Tests the endPanel method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testEndPanel()
	{
		$this->assertEquals(
			JHtml::_('bootstrap.endTab'),
			PHP_EOL . "</div>"
		);
	}

	/**
	 * Tests the loadCss method.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testLoadCss()
	{
		// Initialise the Bootstrap JS framework
		JHtmlBootstrap::loadCss(true, 'rtl');

		// Get the document instance
		$document = JFactory::getDocument();

		$this->assertArrayHasKey(
			'/media/jui/css/bootstrap.min.css',
			$document->_styleSheets,
			'Verify that the base Bootstrap CSS is loaded'
		);

		$this->assertArrayHasKey(
			'/media/jui/css/bootstrap-rtl.css',
			$document->_styleSheets,
			'Verify that the RTL Bootstrap CSS is loaded'
		);
	}
}
