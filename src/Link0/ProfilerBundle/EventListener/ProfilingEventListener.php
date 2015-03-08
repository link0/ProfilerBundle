<?php

/**
 * ProfilingEventListener.php
 *
 * @author Dennis de Greef <github@link0.net>
 */
namespace Link0\ProfilerBundle\EventListener;

use Link0\Profiler\PersistenceHandler;
use Link0\Profiler\Profiler;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\HttpKernel\TerminableInterface;

/**
 * Class ProfilingEventListener
 *
 * Hooks into the symfony event system, and starts and stops the profiler on certain events
 *
 * Start:
 *  - console.command
 *  - kernel.request
 * Stop:
 *  - console.terminate
 *  - kernel.terminate
 *
 * @package Link0\ProfilerBundle\EventListener
 */
class ProfilingEventListener
{
    /**
     * A persistence handler should be fed, since null will disable persisting profiles
     *
     * @param PersistenceHandler $handler
     */
    public function __construct(PersistenceHandler $handler = null)
    {
        $this->profiler = new Profiler($handler);
    }

    /**
     * @return Profiler
     */
    public function getProfiler()
    {
        return $this->profiler;
    }

    /**
     * @event console.command
     * @param ConsoleCommandEvent $event
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        $this->getProfiler()->start();
    }

    /**
     * @event kernel.request
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $this->getProfiler()->start();
    }

    /**
     * @event console.terminate
     * @param ConsoleTerminateEvent $event
     */
    public function onConsoleTerminate(ConsoleTerminateEvent $event)
    {
        $this->getProfiler()->stop();
    }

    /**
     * @event kernel.terminate
     * @param TerminableInterface $event
     */
    public function onKernelTerminate(TerminableInterface $event)
    {
        $this->getProfiler()->stop();
    }

}