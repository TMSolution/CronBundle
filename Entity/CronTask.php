<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TMSolution\CronBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of CronTask
 * 
 *
 * @author Łukasz Wawrzyniak <lukasz.wawrzyniak@tmsolution.pl>
 * 
 * @ORM\Entity(repositoryClass="\TMSolution\CronBundle\Repository\CronTaskRepository")
 */
class CronTask
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options= {"comment":"[PODSTAWOWE ELEMENTY SYSTEMU]Tabela zawierająca informacje na temat zadań automatycznych wykorzystywanych przez system B2B."})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $commands;

    /**
     * @ORM\Column(type="boolean")
     */
    private $repeatable;

    /**
     * @ORM\Column(name="`interval`", type="integer")
     */
    private $interval;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $firstRun;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $runDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $used = 0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $success;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disabled = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $execType;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CronTask
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set commands
     *
     * @param array $commands
     * @return CronTask
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;

        return $this;
    }

    /**
     * Get commands
     *
     * @return array 
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Set repeatable
     *
     * @param boolean $repeatable
     * @return CronTask
     */
    public function setRepeatable($repeatable)
    {
        $this->repeatable = $repeatable;

        return $this;
    }

    /**
     * Get repeatable
     *
     * @return boolean 
     */
    public function getRepeatable()
    {
        return $this->repeatable;
    }

    /**
     * Set interval
     *
     * @param integer $interval
     * @return CronTask
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * Get interval
     *
     * @return integer 
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set firstRun
     *
     * @param \DateTime $firstRun
     * @return CronTask
     */
    public function setFirstRun($firstRun)
    {
        $this->firstRun = $firstRun;

        return $this;
    }

    /**
     * Get firstRun
     *
     * @return \DateTime 
     */
    public function getFirstRun()
    {
        return $this->firstRun;
    }

    /**
     * Set runDate
     *
     * @param \DateTime $runDate
     * @return CronTask
     */
    public function setRunDate($runDate)
    {
        $this->runDate = $runDate;

        return $this;
    }

    /**
     * Get runDate
     *
     * @return \DateTime 
     */
    public function getRunDate()
    {
        return $this->runDate;
    }

    /**
     * Set success
     *
     * @param boolean $success
     * @return CronTask
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Get success
     *
     * @return boolean 
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     * @return CronTask
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean 
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set execType
     *
     * @param integer $execType
     * @return CronTask
     */
    public function setExecType($execType)
    {
        $this->execType = $execType;

        return $this;
    }

    /**
     * Get execType
     *
     * @return integer 
     */
    public function getExecType()
    {
        return $this->execType;
    }

    /**
     * Set used
     *
     * @param boolean $used
     * @return CronTask
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return boolean 
     */
    public function getUsed()
    {
        return $this->used;
    }

}
