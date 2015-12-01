<?php

/**
 * Copyright (c) 2014,TMSolution <krzysiekpiasecki@gmail.com>
 * All rights reserved.
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace TMSolution\CronBundle\Service;

use TMSolution\CronBundle\Entity\CronTask;
use Doctrine\ORM\EntityManager;

/**
 * @author Łukasz Wawrzyniak <lukasz.wawrzyniak@tmsolution.pl>
 * 
 */
class ManageCronTask
{

    const EXEC_CLI = 1;
    const EXEC_SYMFONYCLI = 2;
    const EXEC_REST = 3;
    const EXEC_SYMFONYSERVICE = 4;

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function createCronTask($name, array $commands, $execType, \DateTime $firstRun, $interval = 0, $repeatable = 0)
    {
        $cronTask = new CronTask();
        $cronTask->setName($name);
        $cronTask->setCommands($commands);
        $cronTask->setExecType($execType);
        $cronTask->setFirstRun($firstRun);
        $cronTask->setInterval($interval);
        $cronTask->setRepeatable($repeatable);
        $this->em->persist($cronTask);
        $this->em->flush();

        return $cronTask;
    }

}
