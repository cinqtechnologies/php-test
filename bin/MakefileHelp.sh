#!/bin/bash

make_help_generator() {
    local pattern='(?<=@# ).*'

    echo ""
    cat Makefile | grep -oP "$pattern" | awk -F' - ' '{print sprintf(" %-18s - %s", $1, $2);}'
    echo ""
}

make_help_generator
