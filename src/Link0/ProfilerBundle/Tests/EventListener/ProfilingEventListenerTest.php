<?php

/**
 * ProfilingEventListenerTest.php
 *
 * @author Dennis de Greef <github@link0.net>
 */
namespace Link0\ProfilerBundle\Tests\EventListener;

use Link0\ProfilerBundle\EventListener\ProfilingEventListener;
use Mockery;

/**
 * Class ProfilingEventListenerTest
 *
 * @package Link0\ProfilerBundle\Tests\EventListener
 */
class ProfilingEventListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ProfilingEventListener
     */
    private $eventListener;

    /**
     * Setup method
     */
    public function setUp()
    {
        $this->eventListener = new ProfilingEventListener();
    }

    /**
     * Test that console commands enable profiling
     */
    public function testConsoleCommandEvent()
    {
        $event = Mockery::mock('Symfony\Component\Console\Event\ConsoleCommandEvent');

        $this->assertFalse($this->eventListener->getProfiler()->isRunning());
        $this->eventListener->onConsoleCommand($event);
        $this->assertTrue($this->eventListener->getProfiler()->isRunning());
    }

    /**
     * Test that master requests are being profiled
     */
    public function testKernelMasterRequestEventDoesProfile()
    {
        $event = Mockery::mock('Symfony\Component\HttpKernel\Event\GetResponseEvent');
        $event->shouldReceive('isMasterRequest')->once()->withNoArgs()->andReturn(true);

        $this->assertFalse($this->eventListener->getProfiler()->isRunning());
        $this->eventListener->onKernelRequest($event);
        $this->assertTrue($this->eventListener->getProfiler()->isRunning());
    }

    /**
     * Test that sub requests are _not_ being profiled
     */
    public function testKernelSubRequestEventDoesntProfile()
    {
        $event = Mockery::mock('Symfony\Component\HttpKernel\Event\GetResponseEvent');
        $event->shouldReceive('isMasterRequest')->once()->withNoArgs()->andReturn(false);

        $this->assertFalse($this->eventListener->getProfiler()->isRunning());
        $this->eventListener->onKernelRequest($event);
        $this->assertFalse($this->eventListener->getProfiler()->isRunning());
    }

    /**
     * Test that console.terminate event stops profiling
     */
    public function testConsoleTerminateStopsProfiling()
    {
        $event = Mockery::mock('Symfony\Component\Console\Event\ConsoleTerminateEvent');

        // Fake running profiler
        $this->eventListener->getProfiler()->start();

        $this->assertTrue($this->eventListener->getProfiler()->isRunning());
        $this->eventListener->onConsoleTerminate($event);
        $this->assertFalse($this->eventListener->getProfiler()->isRunning());
    }

    /**
     * Test that kernel.terminate event stops profiling
     */
    public function testKernelTerminateEventStopsProfiling()
    {
        $event = Mockery::mock('Symfony\Component\HttpKernel\TerminableInterface');

        // Fake running profiler
        $this->eventListener->getProfiler()->start();

        $this->assertTrue($this->eventListener->getProfiler()->isRunning());
        $this->eventListener->onKernelTerminate($event);
        $this->assertFalse($this->eventListener->getProfiler()->isRunning());

    }
}
