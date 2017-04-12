<?php

namespace Dephpug\Command;

class EvalCommand extends \Dephpug\Command
{
    public $level = 2;

    public function getName()
    {
        return 'eval';
    }

    public function getShortDescription()
    {
        return 'If command does not match in any case, run eval.';
    }

    public function getDescription()
    {
        return join(PHP_EOL, [
            'This command make the debugger run again until find a next breakpoint or finish the script (request or cli script).',
            'The command is `run -i 1` in dbgp protocol.'
        ]);
    }

    public function getAlias()
    {
        return '*';
    }

    public function getRegexp()
    {
        return '/(.+)/i';
    }

    public function exec()
    {
        $eval = base64_encode($this->match[1]);
        $this->core->dbgpServer->sendCommand('eval -i 1 -- '.$eval);
    }
}
