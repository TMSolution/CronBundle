<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TMSolution\CronBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\StringInput;

class CronTaskRunCommand extends ContainerAwareCommand
{

    const EXEC_CLI = 1;
    const EXEC_SYMFONYCLI = 2;
    const EXEC_REST = 3;
    const EXEC_SYMFONYSERVICE = 4;

    private $output;
    private $em;

    protected function configure()
    {
        $this
                ->setName('crontasks:run')
                ->setDescription('Runs Cron Tasks if needed')
        ;
    }

    private function getEntityManager()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$output->writeln('<comment>Running Cron Tasks...</comment>');

        $this->output = $output;
        $this->em = $this->getEntityManager();
        // $i = 0;
        while (true) {





            try {
                $crontasks = $this->em->getRepository('TMSolutionCronBundle:CronTask')->getNewTasks(20);

                foreach($crontasks as $crontask) {
                    if ($crontask) {


                        $this->runCronTask($crontask, $output);
                        $this->em->flush();
                    }
                }
                //$i++;
            } catch (\Exception $e) {
                echo "Błąd crona.";
            }
            sleep(10);
        }
        $output->writeln('<comment>Done!</comment>');
    }

    private function runCronTask($crontask, OutputInterface $output)
    {
        $output->writeln(sprintf('Running Cron Task <info>%s</info>', $crontask->getName()));
        $crontask->setRunDate(new \DateTime());
        $commands = $crontask->getCommands();
        $crontask->setUsed(1);
        $this->em->persist($crontask);
        try {
            $this->executeCommands($commands, $crontask->getExecType(), $output);
            $output->writeln('<info>SUCCESS</info>');
            $crontask->setSuccess(1);
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>ERROR</error><comment>%s</comment>', $e->getMessage()));
            $crontask->setSuccess(0);
        }
        $this->em->persist($crontask);
    }

    private function executeCommands($commands, $execType, OutputInterface $output)
    {
        foreach ($commands as $command) {
            $output->writeln(sprintf('Executing command <comment>%s</comment>...', $command));
            if ($execType == self::EXEC_SYMFONYCLI) {
                return $this->runSymfonyCliCommand($command);
            } elseif ($execType == self::EXEC_CLI) {
                return $this->runCliCommand($command);
            } elseif ($execType == self::EXEC_REST) {
                return $this->runRestCommand($command);
            }
        }
    }

    private function runSymfonyCliCommand($string)
    {
        $namespace = explode(' ', $string)[0];
        $command = $this->getApplication()->find($namespace);
        $input = new StringInput($string);
        $returnCode = $command->run($input, $this->output);

        return $returnCode != 0;
    }

    private function runCliCommand($command)
    {
        $command = 'nohup ' . $command . ' > /dev/null 2>&1 & echo $!';
        $op = [];
        exec($command, $op);

        if (!isset($op[0])) {
            throw new \Exception;
        } else {
            return true;
        }
    }

    private function runRestCommand($command)
    {
        //next example will recieve all messages for specific conversation
        $service_url = 'http://localhost/owca/web/app_dev.php/dummy';
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            throw new \Exception('error occured during curl exec. Additinal info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);

        var_dump($decoded);
        exit;

        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            throw new \Exception('error occured: ' . $decoded->response->errormessage);
        }


        return true;
        echo 'response ok!';
        var_export($decoded->response);
    }

}
