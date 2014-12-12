<?php
header("Content-type: text/plain"); // be explicit to avoid accidental XSS

$gitpath = '/usr/local/bin/git';
$composerpath = '/private/composer.phar';
$phppath = '/usr/bin/php';

system("/usr/bin/env -i {$gitpath} pull 2>&1"); // main repo (current branch)
system("/usr/bin/env -i COMPOSER_HOME=./.composer {$phppath} {$composerpath} install 2>&1"); // composer
