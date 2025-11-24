#!/bin/bash

projects=("main")

cd "$(dirname "${BASH_SOURCE[0]}")"/..

for proj in "${projects[@]}"; do
    sass --watch "$proj/src/resources":"$proj/public/resources" --style=compressed &
    chokidar "$proj/src/resources/*.js" -c "javascript-obfuscator $proj/src/resources --output $proj/public/resources --compact true --self-defending true > /dev/null 2>&1" &
done

wait