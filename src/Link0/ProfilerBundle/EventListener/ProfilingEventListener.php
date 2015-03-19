<?php

/**
 * ProfilingEventListener.php
 *
 * @author Dennis de Greef <github@link0.net>
 */
namespace Link0\ProfilerBundle\EventListener;

use Link0\Profiler\PersistenceHandler;
use Link0\ProfilerBundle\Service\ProfilingService;

/**
 * Class ProfilingEventListener
 *
 * Hooks into the symfony event system, and starts and stops the profiler on certain events
 *
 * You can configure this event listener in your services.yml in the following format
 *
 * services:
 *   kernel.listener.link0profilerlistener:
 *     class: Link0\ProfilerBundle\EventListener\ProfilingEventListener
 *     param: [@profiling_service]
 *     tags:
 *       - { name: kernel.event_listener, event: console.command,   method: start }
 *       - { name: kernel.event_listener, event: kernel.request,    method: start }
 *       - { name: kernel.event_listener, event: console.terminate, method: stop  }
 *       - { name: kernel.event_listener, event: kernel.terminate,  method: stop  }
 *
 * @package Link0\ProfilerBundle\EventListener
 */
final class ProfilingEventListener
{
    /**
     * @var \Link0\Profiler\Profiler
     */
    private $profilingService;

    /**
     * @param ProfilingService $profilingService
     */
    public function __construct(ProfilingService $profilingService)
    {
        $this->profilingService = $profilingService;
    }

    /**
     * @return ProfilingService
     */
    public function getProfilingService()
    {
        return $this->profilingService;
    }

    /**
     * Starts the profiler
     */
    public function start()
    {
        $this->getProfilingService()->start();
    }

    /**
     * Stops the profiler
     *
     * @return \Link0\Profiler\Profile
     */
    public function stop()
    {
        return $this->getProfilingService()->stop();
    }
}