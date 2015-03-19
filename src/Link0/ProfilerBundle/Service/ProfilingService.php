<?php

/**
 * ProfilingEventListener.php
 *
 * @author Dennis de Greef <github@link0.net>
 */
namespace Link0\ProfilerBundle\Service;

use Link0\Profiler\PersistenceService;

/**
 * Class ProfilingService
 *
 * @package Link0\ProfilerBundle\Service
 */
final class ProfilingService
{
    /**
     * @var \Link0\Profiler\PersistenceService
     */
    private $persistenceService;

    /**
     * @var \Link0\Profiler\Profiler
     */
    private $profiler;

    /**
     * @param PersistenceService $persistenceService
     */
    public function __construct(PersistenceService $persistenceService = null)
    {
        $this->persistenceService = $persistenceService;
    }

    /**
     * Starts the profiler
     */
    public function start()
    {
        $this->profiler->start();
    }

    /**
     * @return \Link0\Profiler\Profile
     */
    public function stop()
    {
        return $this->profiler->stop();
    }
}
