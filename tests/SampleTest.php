<?php
class SampleTest extends PHPUnit_Framework_TestCase
{
  private $CI;
  public function setUp()
  {
    $this->CI = &get_instance();
  }
  public function testPushAndPop()
  {
    $stack = array();
    $this->assertEquals(0, count($stack));
    array_push($stack, 'foo');
    $this->assertEquals('foo', $stack[count($stack)-1]);
    $this->assertEquals(1, count($stack));
    $this->assertEquals('foo', array_pop($stack));
    $this->assertEquals(0, count($stack));
  }
  public function testValidEmail(){
    $this->CI->load->helper('string');
    $my_string = random_string('alnum',10);
    $this->assertEquals(strlen($my_string), 8);
  }
}