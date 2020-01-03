<?php

use Symfony\Component\Process\Process;

class Command {
    const INPUT_FILE = '/tmp/mplayer-fifo';
    const MUSIC_PATH = 'music/';
    const START_VOLUME = '10';

    public function start($command) {
        $cmd = "mplayer -volume ".self::START_VOLUME." -really-quiet -noconsolecontrols -fs -slave -input file=".self::INPUT_FILE." ".$command." </dev/null >/dev/null 2>&1 &";
        shell_exec($cmd);
    }

    public function killProcesses() {
        shell_exec("killall mplayer");
    }

    public function createControlFile() {
        shell_exec("mkfifo /tmp/mplayer-fifo");
    }

    public function control($command) {
        shell_exec("echo \"".$command."\" > /tmp/mplayer-fifo");
    }
}