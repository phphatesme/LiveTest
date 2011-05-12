@echo off

set RUNNERFILEPATH=src\runner.php

for /f "tokens=*" %%a in (
'pear.bat config-get php_dir'
) do (
set PEARPATH=%%a\LiveTest
)

echo %PEARPATH%

set SEARCHFILEPATH=%PEARPATH%\%RUNNERFILEPATH%
echo %SEARCHFILEPATH% 

IF EXIST "%SEARCHFILEPATH%" (
    set RUNFILEPATH=%SEARCHFILEPATH%
) ELSE (
    set RUNFILEPATH=..\%RUNNERFILEPATH%
)

php "%RUNFILEPATH%" %*
 