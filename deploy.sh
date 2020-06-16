#!/bin/bash
appPath=$1
user=$2

cd $appPath
git pull origin master
yarn prod
#chown -R $user:$user ./*
#chown -R $user:$user ./.*
