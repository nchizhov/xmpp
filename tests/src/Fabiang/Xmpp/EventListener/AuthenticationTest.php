<?php

namespace Fabiang\Xmpp\EventListener;

use Fabiang\Xmpp\Event\EventManager;
use Fabiang\Xmpp\Event\XMLEvent;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-01-11 at 18:29:57.
 */
class AuthenticationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Authentication
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Authentication;
    }

    /**
     * Test what events are attached.
     *
     * @covers Fabiang\Xmpp\EventListener\Authentication::attachEvents
     * @return void
     */
    public function testAttachEvents()
    {
        $input = new EventManager;
        $this->object->setInputEventListener($input);
        $this->object->attachEvents();

        $this->assertArrayHasKey('{urn:ietf:params:xml:ns:xmpp-sasl}mechanisms', $input->getEventList());
        $this->assertArrayHasKey('{urn:ietf:params:xml:ns:xmpp-sasl}mechanism', $input->getEventList());
    }

    /**
     * Test collecting machanisms from event.
     *
     * @covers Fabiang\Xmpp\EventListener\Authentication::collectMechanisms
     * @covers Fabiang\Xmpp\EventListener\Authentication::getMechanisms
     * @covers Fabiang\Xmpp\EventListener\Authentication::isBlocking
     * @return void
     */
    public function testCollectMechanisms()
    {
        $element = new \DOMElement('machanism', 'PLAIN');
        $event   = new XMLEvent;
        $event->setParameters(array($element));
        $this->object->collectMechanisms($event);
        $this->assertSame(array('plain'), $this->object->getMechanisms());
        
        $element = new \DOMElement('machanism', 'DIGEST-MD5');
        $event->setParameters(array($element));
        $this->object->collectMechanisms($event);
        $this->assertSame(array('plain', 'digest-md5'), $this->object->getMechanisms());
        
        $this->assertTrue($this->object->isBlocking());
    }

    /**
     * @covers Fabiang\Xmpp\EventListener\Authentication::authenticate
     * @todo   Implement testAuthenticate().
     */
    public function testAuthenticate()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Fabiang\Xmpp\EventListener\Authentication::getAuthenticationClasses
     * @covers Fabiang\Xmpp\EventListener\Authentication::setAuthenticationClasses
     * @return void
     */
    public function testSetAndGetAuthenticationClasses()
    {
        $classes = array('plain' => '\stdClass');
        $this->assertSame($classes, $this->object->setAuthenticationClasses($classes)->getAuthenticationClasses());
    }

}
