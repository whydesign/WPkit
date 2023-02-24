#!/bin/bash

RED='\033[31m'
REDBG='\033[41m'
GREEN='\033[32m'
GREENBG='\033[30;42m'
BLUE='\033[34m'
CYAN='\033[36m'
CYANBG='\033[46m'
MAGENTABG='\033[45m'
NOCOLOR='\033[0m'

BOLD='\033[1m'
ITALIC='\033[3m'
NOSTYLE='\033[0m'

files () {
    echo_start;
    cp_files;
    echo_stop;
}

install () {
    echo_start;
    run_npm;
    get_config;
    ask_import;
    echo_stop;
}

import () {
    echo_start;
    get_config;
    run_import;
    echo_stop;
}

wpcli_install () {
    echo_start;
    get_config;
    install_wpcli;
    ask_check_wpcli;
    echo_stop;
}

wpcli_info () {
    echo_start;
    get_config;
    check_wpcli;
    echo_stop;
}

wpcli_update () {
    echo_start;
    get_config;
    run_wpcli_update;
    echo_stop;
}

help () {
    echo_start;
    help;
    echo_stop;
}


echo_start() {
    echo -e "${GREENBG}---------------------------------[SETUP START]----------------------------------${NOCOLOR}"
}

echo_stop() {
    echo -e "${GREENBG}---------------------------------[SETUP STOP]-----------------------------------${NOCOLOR}"
}

run_npm() {
    cd ./htdocs/wp-content/themes/wpkit
    npm install
}

ask_import() {
    read -p "Do you want to start SQL import? (y/n) " yn

    case $yn in
        [yY]) import;;
        [nN]) exit;;
        *) exit;;
    esac
}

run_import() {
    DUMP_FILE='.setup/database.sql'
    DUMP_FILE_ZIP=$DUMP_FILE'.tar.gz'

    echo -e ""

    echo -e "${GREEN}Extracting $DUMP_FILE_ZIP${NOCOLOR}"
    tar -xvf "$DUMP_FILE_ZIP" -C .setup &> /dev/null

    echo -e ""
        if [ $DOMAIN ]; then
            echo -e "${CYAN}→ Replacing \"PLACEHOLDER_DOMAIN\" with \"$DOMAIN\" \c${NOCOLOR}"
            sed -i "s|PLACEHOLDER_DOMAIN|$DOMAIN|" $DUMP_FILE
            echo -e "${CYAN} √ ${NOCOLOR}"
        fi

        if [ $MAIL ]; then
            echo -e "${CYAN}→ Replacing \"PLACEHOLDER_EMAIL\" with \"$MAIL\" \c${NOCOLOR}"
            sed -i "s|PLACEHOLDER_EMAIL|$MAIL|" $DUMP_FILE
            echo -e "${CYAN} √ ${NOCOLOR}"
        fi

        #[ "$MYSQL_HAS_VIEWS" -eq 1 ] && info "Replacing \"PLACEHOLDER_MYSQLUSER\" with View Definer \"$MYSQL_USER\"" && perl -pi -w -e "s/PLACEHOLDER_MYSQLUSER/$MYSQL_USER/g;" $DUMP_FILE
    echo -e ""

    echo -e "${GREEN}Importing database \c${NOCOLOR}"
        $MYSQL --defaults-extra-file=.my.cnf -Nse 'SHOW TABLES' $MYSQL_DB | while read table; do $MYSQL --defaults-extra-file=.my.cnf -e "SET FOREIGN_KEY_CHECKS=0; TRUNCATE TABLE $table; SET FOREIGN_KEY_CHECKS=1;" $MYSQL_DB; done  &> /dev/null
        $MYSQL --defaults-extra-file=.my.cnf --default-character-set=utf8 $MYSQL_DB < $DUMP_FILE
    echo -e "${GREENBG} [DONE] ${NOCOLOR}"

    echo -e "${GREEN}Removing extracted SQL dump \c${NOCOLOR}"
        rm -f $DUMP_FILE
    echo -e "${GREENBG} [DONE] ${NOCOLOR}"

    echo -e ""
}

get_config() {
    if [ -f ./setup-cnf.sh ]
    then
        . ./setup-cnf.sh
    else
        echo -e "${REDBG}================================================================================${NOCOLOR}";
        echo -e "${REDBG}                   Config file is missing: create setup-cnf.sh                  ${NOCOLOR}";
        echo -e "${REDBG}================================================================================${NOCOLOR}";
        exit;
    fi
}

install_wpcli() {
    cd ./htdocs
    echo -e ""
    echo -e "Downloading the latest wp-cli.phar"
    echo -e ""
        curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    echo -e ""
    echo -e "Make wp-cli.phar executable"
    chmod +x wp-cli.phar
    echo -e ""
    cd ./../
}

ask_check_wpcli() {
    read -p "Do you want to check the wp-cli.phar? (y/n) " yn

    case $yn in
        [yY]) check_wpcli;;
        [nN]) exit;;
        *) exit;;
    esac
}

check_wpcli() {
    cd ./htdocs
    echo -e ""
    $PHP wp-cli.phar --info
    echo -e ""
}

run_wpcli_update() {
    cd ./htdocs
    echo -e ""
    $PHP wp-cli.phar cli update
    echo -e ""
}

cp_files() {
    echo -e ""
    echo -e "${GREEN}Setup all config files for your project${NOCOLOR} \c"

    cp .setup/setup-cnf.sh.example setup-cnf.sh
    cp .setup/.my.cnf.example .my.cnf
    cp .setup/wp-config/wp-config.env.php wp-config/wp-config.env.php
    cp .setup/wp-config/wp-config.local.php wp-config/wp-config.local.php

    echo -e "${GREENBG} [DONE] ${NOCOLOR}"

    echo -e ""
    echo -e "${GREEN}Please edit the following files${NOCOLOR}"
    echo -e ""
    echo -e "  ${CYAN}${BOLD}→ setup-cnf.sh${NOSTYLE}"
    echo -e "  ${CYAN}${BOLD}→ .my.cnf${NOSTYLE}"
    echo -e "  ${CYAN}${BOLD}→ wp-config/wp-config.env.php${NOSTYLE}"
    echo -e "  ${CYAN}${BOLD}→ wp-config/wp-config.local.php${NOSTYLE}"
    echo -e ""
    echo -e "${GREEN}And run${NOCOLOR}"
    echo -e ""
    echo -e "  ${CYAN}${BOLD}./setup.sh ${ITALIC}install${NOSTYLE}"
    echo -e ""
}


help() {
    echo -e "${MAGENTABG}???????????????????????????????????????????${NOCOLOR}"
    echo -e "${MAGENTABG}??              ${BOLD}Setup Help${NOSTYLE}${MAGENTABG}               ??${NOCOLOR}"
    echo -e "${MAGENTABG}???????????????????????????????????????????${NOCOLOR}"
    echo -e ""

    echo -e "${MAGENTABG} ${BOLD}Run: ${NOSTYLE}${NOCOLOR}"
    echo -e "   ${BOLD}./setup.sh ${CYAN}${ITALIC}<command>${NOSTYLE}${NOCOLOR}"
    echo -e ""

    echo -e "${MAGENTABG} ${BOLD}Commands: ${NOSTYLE}${NOCOLOR}"
    echo -e "${CYAN}   ${BOLD}${ITALIC}files${NOSTYLE}          ${GREEN}→ creates all the config files you will need${NOCOLOR}"
    echo -e "${CYAN}   ${BOLD}${ITALIC}install${NOSTYLE}        ${GREEN}→ run a npm install in theme directory htdocs/wp-content/themes/wpkit${NOCOLOR}"
    echo -e "${CYAN}   ${BOLD}${ITALIC}import${NOSTYLE}         ${GREEN}→ run SQL dump import with your e-mail and domain from setup-cnf.sh${NOCOLOR}"
    echo -e ""
    echo -e "${CYAN}   ${BOLD}${ITALIC}wpcli-install${NOSTYLE}  ${GREEN}→ install wp-cli to htdocs${NOCOLOR}"
    echo -e "${CYAN}   ${BOLD}${ITALIC}wpcli-info${NOSTYLE}     ${GREEN}→ run a wp-cli info${NOCOLOR}"
    echo -e "${CYAN}   ${BOLD}${ITALIC}wpcli-update${NOSTYLE}   ${GREEN}→ run a wp-cli update${NOCOLOR}"
    echo -e ""
}

case "$1" in
    files) files; ;;
    install) install; ;;
    import) import; ;;
    wpcli-install) wpcli_install; ;;
    wpcli-info) wpcli_info; ;;
    wpcli-update) wpcli_update; ;;
    *) help; ;;
esac