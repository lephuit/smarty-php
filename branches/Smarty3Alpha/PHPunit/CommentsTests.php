<?php
/**
* Smarty PHPunit tests comments in templates
* 
* @package PHPunit
* @author Uwe Tews 
*/

require_once '../libs/Smarty.class.php';

/**
* class for security test
*/
class CommentsTests extends PHPUnit_Framework_TestCase {
    public function setUp()
    {
        $this->smarty = new Smarty();
        $this->smarty->plugins_dir = array('..' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR);
        $this->smarty->enableSecurity();
        $this->smarty->force_compile = true;
    } 

    public function tearDown()
    {
        unset($this->smarty);
        Smarty::$template_objects = null;
    } 

    /**
    * test simple comments
    */
    public function testSimpleComment1()
    {
        $tpl = $this->smarty->createTemplate("string:{* this is a comment *}");
        $this->assertEquals("", $this->smarty->fetch($tpl));
        $this->assertContains('<?php /* comment placeholder */?>', $tpl->getCompiledTemplate());
    } 
    public function testSimpleComment2()
    {
        $tpl = $this->smarty->createTemplate("string:{* another $foo comment *}");
        $this->assertEquals("", $this->smarty->fetch($tpl));
        $this->assertContains('<?php /* comment placeholder */?>', $tpl->getCompiledTemplate());
    } 
    public function testSimpleComment3()
    {
        $tpl = $this->smarty->createTemplate("string:{* another $foo comment *}{* another <?=$foo?> comment *}");
        $this->assertEquals("", $this->smarty->fetch($tpl));
        $this->assertContains('<?php /* comment placeholder */?>', $tpl->getCompiledTemplate());
    } 
    public function testSimpleComment4()
    {
        $tpl = $this->smarty->createTemplate("string:{* multi line \n comment *}");
        $this->assertEquals("", $this->smarty->fetch($tpl));
        $this->assertContains('<?php /* comment placeholder */?>', $tpl->getCompiledTemplate());
    } 
    public function testSimpleComment5()
    {
        $tpl = $this->smarty->createTemplate("string:{* /* foo */ *}");
        $this->assertEquals("", $this->smarty->fetch($tpl));
        $this->assertContains('<?php /* comment placeholder */?>', $tpl->getCompiledTemplate());
    } 

    /**
    * test comment text combinations
    */
    public function testTextComment1()
    {
        $tpl = $this->smarty->createTemplate("string:A{* comment *}B\nC");
        $this->assertEquals("AB\nC", $this->smarty->fetch($tpl));
    } 
    public function testTextComment2()
    {
        $tpl = $this->smarty->createTemplate("string:D{* comment *}\n{* comment *}E\nF");
        $this->assertEquals("DE\nF", $this->smarty->fetch($tpl));
    } 
    public function testTextComment3()
    {
        $tpl = $this->smarty->createTemplate("string:G{* multi \nline *}H");
        $this->assertEquals("GH", $this->smarty->fetch($tpl));
    } 
    public function testTextComment4()
    {
        $tpl = $this->smarty->createTemplate("string:I{* multi \nline *}\nJ");
        $this->assertEquals("IJ", $this->smarty->fetch($tpl));
    } 
} 

?>
